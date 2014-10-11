<?php

/*
 * Copyright © 2014, Matěj Račinský. Všechna práva vyhrazena.
 */

namespace App\Model\Validator;

use Nette\Object;
use Nette\Utils\Validators;
use Nette\Reflection\Method;
use App\Utils\Strings;

/**
 * Description of TypeValidator
 *
 * @author Matěj Račinský
 */
class TypeValidator extends Object {
    
    /**
     *
     * @var ITypeValidatorLogger
     */
    private $logger;
    
    function __construct(ITypeValidatorLogger $serverLogger) {
        $this->logger = $serverLogger;
    }

    /**
     * Object classess must start with big letter.
     * @param string $variable
     * @param string $type
     * @return boolean
     */
    public function isValid($variable, $type) {
        if ($this->isKnownPrimitiveType($type)) {
            return Validators::is($variable, $type);
        } else if (Strings::endsWith($type, "[]")) {
            return $this->isValidArray($variable, $type);
        } else if (Strings::contains($type, "|")) {
            return Validators::is($variable, $type);
        } else if (Strings::startsWith($type, "\\")) {                          //bere to pouze celé názvy, včetně namespace
            return Validators::is($variable, $type);
        }
        return false;
    }
    
    public function isValidArray($variable, $type) {
        if (!Validators::isList($variable)) {
            return false;
        }
        $length = Strings::length($type);
        $typeOfOneValue = Strings::substring($type, 0, $length-2);              //odstraní závorky na konci a poté se rekurzí ověří všechny prvky pole
        foreach ($variable as $value) {
            if (!$this->isValid($value, $typeOfOneValue)) {
                return false;
            }
        }
        return true;
    }
    
    public function isKnownType($type) {
        if (Strings::contains($type, "|")) {
            $types = explode('|',trim($type));
            foreach ($types as $iter) {
                if (!$this->isKnownType($iter)) {
                    return false;
                }
            }
            return true;
        } else if (Strings::startsWith($type, "\\")) {
            return true;
        } else if (Strings::endsWith($type, "[]")) {
            return $this->isKnownArrayType($type);
        } else {
            $return = $this->isKnownPrimitiveType($type);
            return $return;
        }
    }
    
    public function isKnownArrayType($type) {
        $length = Strings::length($type);
        $typeOfOneValue = Strings::substring($type, 0, $length-2);              //odstraní závorky na konci a poté se rekurzí ověří všechny prvky pole
        return $this->isKnownType($typeOfOneValue);
    }
    
    public function hasAnnotations(Method $reflection) {
        $annotations = $reflection->getAnnotations();
        $numberOfAnnotations = count($annotations);
        return $numberOfAnnotations > 0;
    }
    
    public function splitToTypeAndVaribleName($parameter) {
        $type = Strings::getWordNumber($parameter, 0);
        $variableName = Strings::getWordNumber($parameter, 1);
        if (Strings::startsWith($variableName, "$")) {
            $variableName = Strings::substring($variableName, 1);
        }
        return array($type, $variableName);        
    }
    
    /**
     * 
     * @param Nette\Reflection\Method $reflection
     * @return \Nette\Reflection\Parameter[]
     */
    public function getAnnotationParametersFromReflection(Method $reflection) {
        $annotations = $reflection->getAnnotations();
        return $annotations["param"];
    }
    
    public function hasArgumentsAnnotation(Method $reflection) {
        if (!$this->hasAnnotations($reflection)) {
            return false;
        }
        $annotations = $reflection->getAnnotations();
        if (isset($annotations["param"])) {
            return true;
        }
        return false;
    }
    
    /**
     * 
     * @param \App\Model\Validator\Nette\Reflection\Method $reflection
     * @return boolean
     */
    public function hasReturn(Method $reflection) {
        if (!$this->hasAnnotations($reflection)) {
            return false;
        }
        $annotations = $reflection->getAnnotations();
        if (isset($annotations["return"])) {
            return true;
        }
        return false;
    }
    
    /**
     * 
     * @param \App\Model\Validator\Nette\Reflection\Method $reflection
     * @return boolean
     */
    public function hasReturnAnnotation(Method $reflection) {
        if (!$this->hasAnnotations($reflection)) {
            return false;
        }
        $annotations = $reflection->getAnnotations();
        if (isset($annotations["return"])) {
            return true;
        }
        return false;
    }
    
    /**
     * 
     * @param Nette\Reflection\Method $reflection
     * @return \Nette\Reflection\Parameter
     */
    public function getAnnotationReturnFromReflection(Method $reflection) {
        $annotations = $reflection->getAnnotations();
        $returnAnnotation = $annotations["return"];
        if (Validators::isList($returnAnnotation)) {
            $returnAnnotation = $returnAnnotation[0];
        }
        return $returnAnnotation;
    }
    
    /**
     * 
     * @param string $type
     * @return boolean
     */
    public function isKnownPrimitiveType($type) {
        $types = array("integer", "int", "string", "array", "float", "bool", "boolean", "callable");
        foreach ($types as $iter) {
            if ($iter == $type) {
                return true;
            }
        }
        return false;
    }
    
    public function validateArgumentsAgainstAnnotation(Method $reflection, array $argumentsArray) {
        $classReflection = $reflection->getDeclaringClass()->getParentClass();
        $functionParameters = $reflection->getParameters();
        $annotationParameters = $this->getAnnotationParametersFromReflection($reflection);
        foreach ($annotationParameters as $key => $annotationParameter) {
            $functionParameterName = $functionParameters[$key]->getName();
            $value = $argumentsArray[$key];
            list($type, $variableName) = $this->splitToTypeAndVaribleName($annotationParameter);
            try {
                $this->validateArgumentAgainstAnnotation($type, $variableName, $functionParameterName, $value);
            } catch (WrongTypeException $e) {
                switch ($e->getMessage()) {
                    case WrongTypeException::NAME_IN_ANNOTATION_DIFFERS:
                        $this->logger->logValidator("Variable name in annotation does not match variable name in function: ".$reflection->getName()." in class: ".$classReflection->getName().". In annotation is name $variableName, in function is $functionParameterName.");
                        break;
                    case WrongTypeException::UNKNOWN_TYPE:
                        $this->logger->logValidator("Type: $type in function: ".$reflection->getName()." in class: ".$classReflection->getName()." is unknown.");
                        break;
                    case WrongTypeException::WRONG_TYPE:
                        throw new WrongTypeException("Variable with name ".$variableName." in function ".$reflection->getName()." in class ".$classReflection->getName().
                                " has not same type as in annotation. Type in annotation is: ".$type.", value of variable is ".Strings::tryToString($value).".");
                }
            }
        }
    }
    
    public function validateArgumentAgainstAnnotation($type, $variableName, $functionParameterName, $value) {
        if ($variableName != $functionParameterName) {
            throw new WrongTypeException(WrongTypeException::NAME_IN_ANNOTATION_DIFFERS);
        }
        $this->validateVariableAgainstAnnotation($type, $value);
    }
    
    public function validateVariableAgainstAnnotation($type, $value) {
        if ($this->isKnownType($type)) {
            $this->validateKnownArgument($type, $value);
        } else {
            throw new WrongTypeException(WrongTypeException::UNKNOWN_TYPE);
        }
    }
    
    public function validateReturnAgainstAnnotation(Method $reflection, $returnVariable) {
        $classReflection = $reflection->getDeclaringClass()->getParentClass();
        $type = $this->getAnnotationReturnFromReflection($reflection);
        try {
            $this->validateVariableAgainstAnnotation($type, $returnVariable);
        } catch (WrongTypeException $e) {
            switch ($e->getMessage()) {
                case WrongTypeException::UNKNOWN_TYPE:
                    $this->logger->logValidator("Type: $type in function: ".$reflection->getName()." in class: ".$classReflection->getName()." is unknown.");
                case WrongTypeException::WRONG_TYPE:
                    throw new WrongTypeException("Return of function ".$reflection->getName()." in class ".$classReflection->getName().
                            " has not same type as in annotation. Type in annotation is: ".$type.", value of variable is ".Strings::tryToString($returnVariable).".");
            }
        }
    }
    
    public function validateKnownArgument($type, $value) {
        if (!$this->isValid($value, $type)) {
            throw new WrongTypeException(WrongTypeException::WRONG_TYPE);
        }
    }
    
    public function validateArguments(Method $reflection, array $argumentsArray) {
        $classReflection = $reflection->getDeclaringClass()->getParentClass();
        $arguments = (count($argumentsArray) > 0);
        $annotations = $this->hasArgumentsAnnotation($reflection);
        if ($arguments && $annotations) {
            $this->validateArgumentsAgainstAnnotation($reflection, $argumentsArray);
        } else {
            if (!$arguments && $annotations) {
                $this->logger->logValidator("Function: ".$reflection->getName()." in class: ".$classReflection->getName()." has arguments in annotation, but has no arguments.");
            } else if ($arguments && !$annotations) {
                $this->logger->logValidator("Function: ".$reflection->getName()." in class: ".$classReflection->getName()." has no arguments in annotation, but has arguments.");
            }
        }
    }
    
    public function validateReturn(Method $reflection, $returnVariable) {
        $classReflection = $reflection->getDeclaringClass()->getParentClass();
        $return = ($returnVariable != null);
        $annotations = $this->hasReturnAnnotation($reflection);
        if ($return && $annotations) {
            $this->validateReturnAgainstAnnotation($reflection, $returnVariable);
        } else {
            if (!$return && $annotations) {
                $this->logger->logValidator("Function: ".$reflection->getName()." in class: ".$classReflection->getName()." has return in annotation, but has no return.");
            } else if ($return && !$annotations) {
                $this->logger->logValidator("Function: ".$reflection->getName()." in class: ".$classReflection->getName()." has no return in annotation, but has return.");
            }
        }
    }
    
}
