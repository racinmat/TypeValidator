<?php

/*
 * Copyright © 2014, Matěj Račinský. Všechna práva vyhrazena.
 */

namespace App\Model\Validator;

use Nette;
use Kdyby\Aop;
use App\Utils\Strings;
use Nette\Reflection\IAnnotation;
use Nette\Utils\Validators;
use \App\Utils\Arrays;
use App\Model\Logging\ServerLogger;

/**
 * Description of ValidatorAspect
 *
 * @author Matěj Račinský
 */
class ValidatorAspect extends Nette\Object {
    
    /**
     *
     * @var TypeValidator
     */
    private $typeValidator;
    
    /**
     *
     * @var boolean
     */
    private $validateTypes;
    
    /**
     *
     * @var boolean
     */
    private $validateUsedRam;
    
    /**
     *
     * @var integer
     */
    private $maxRam;
    
    /**
     * 
     * @param \App\Model\Logging\ServerLogger $serverLogger
     * @param boolean $validateTypes
     * @param boolean $validateUsedRam
     * @param integer $maxRam
     */
    function __construct($validateTypes, $validateUsedRam, $maxRam, \App\Model\Validator\TypeValidator $typeValidator) {
        $this->typeValidator = $typeValidator;
        $this->validateTypes = $validateTypes;
        $this->validateUsedRam = $validateUsedRam;
        $this->maxRam = $maxRam;
    }

    /**
     * @Aop\Before("method(\App\Model\Validator\IValidated->*)")
     */
    public function validateBefore(Aop\JoinPoint\BeforeMethod $before) {
        if ($this->validateTypes && $this->isNotContructor($before)) {
            $this->typeValidator->validateArguments($before->getTargetReflection(), $before->getArguments());
        }
        if ($this->validateUsedRam) {
            $this->validateUsedRamSpace();
        }
    }
    
    /**
     * @Aop\After("method(\App\Model\Validator\IValidated->*)")
     */
    public function validateAfter(Aop\JoinPoint\AfterMethod $after) {
        if ($this->validateTypes && $this->isNotContructor($after)) {
            $this->typeValidator->validateReturn($after->getTargetReflection(), $after->getResult());
        }
    }
    
    public function validateUsedRamSpace() {
        $size = memory_get_usage(true);
        if ($size > $this->maxRam) {
            throw new \Exception("Too deep recursion, $size bytes of ram consumed.");
        }
    }
    private function isNotContructor(Aop\JoinPoint\MethodInvocation $method) {
        if ($method->getTargetReflection()->getName() == "__construct") {
            return false;
        }
        return true;
    }
    
}
