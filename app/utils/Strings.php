<?php

namespace App\Utils;

use Nette\Utils\Strings as NetteStrings;
use Nette;
use Kdyby\Doctrine\Entities\BaseEntity;

/**
 * Description of Strings
 *
 * @author Matěj Račinský
 */
class Strings extends NetteStrings {
    
    public static function tryToString($input) {
        if ($input === null) {
            return "null";
        }
        if (is_string($input)) {
            $output = "string: ".$input;
            return $output;
        }
        if (is_bool($input)) {
            if ($input) {
                $output = "boolean: true";
            } else {
                $output = "boolean: false";
            }
            return $output;
        }
        if (is_scalar($input)) {
            $output = "scalar: ".$input;
            return $output;
        }
        if (is_array($input)) {
            $isFirst = true;
            if (count($input) == 0) {
                $output = "empty array";
            }
            foreach ($input as $element) {
                if ($isFirst) {
                    $output = "array: ".self::tryToString($element);
                    $isFirst = false;
                } else {
                    $output = $output.", ".self::tryToString($element);
                }
            }
            return $output;
        }
        if ($input instanceof Nette\Object) {
            $properties = array();
            $iter = $input->getReflection();
            while(($iter->getName() != Nette\Object::getReflection()->getName()) && ($iter->getName() != BaseEntity::getReflection()->getName())) {
                $temp = $iter->getProperties();
                $properties = Arrays::mergeArrays($properties, $temp);
                $iter = $iter->getParentClass();
            }
            $isFirst = true;
            foreach ($properties as $property) {
                $property->setAccessible(true);
                if ($isFirst) {
                    $output = "Object:".$input->getReflection()->getName()." with following properties: Property: ".$property->getName()." with value: ".self::tryToString($property->getValue($input));
                    $isFirst = false;
                } else {
                    $output = $output.", Property: ".$property->getName()." with value: ".self::tryToString($property->getValue($input));
                }
            }
            return $output;
        }
        if ($input instanceof \Exception) {
            if ($input instanceof \App\Exceptions\ExceptionForUser) {
                $output = "Exception for user:";
            } else {
                $output = "Exception:";
            }
            $output = $output." code: ".$input->getCode();
            $output = $output." file: ".$input->getFile();
            $output = $output." line: ".$input->getLine();
            $output = $output." message: ".$input->getMessage();
            $output = $output." previous: ".$input->getPrevious();
            $output = $output." trace: ".$input->getTraceAsString();
            return $output;
        }
        
    }
    
    /**
     * Returns word from sentence, where words are seperated by space ( ). Numbered from zero.
     * @param string $string
     * @param integer $number
     */
    public static function getWordNumber($string, $number) {
        $words = explode(' ',trim($string));
        if (count($words) < $number) {
            throw new \InvalidArgumentException("Too big number, ".$string." does not have ".$number." words.");
        }
        return $words[$number];
    }
    
}
