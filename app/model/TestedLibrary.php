<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

use Nette\Object;
use App\Model\Validator\IValidated;

/**
 * Description of MathLibrary
 *
 * @author Azathoth
 */
class TestedLibrary extends Object implements IValidated {
    
    /**
     * 
     * @param integer $number1
     * @param integer $number2
     * @return integer
     */
    public function multiply($number1, $number2) {
        return $number1*$number2;
    }
    
    public function multiplyWithNoAnnotation($number1, $number2) {
        return $number1*$number2;
    }
    
    /**
     * 
     * @param integer $number1
     * @param integer $number2
     */
    public function multiplyWithMissingReturnAnnotation($number1, $number2) {
        return $number1*$number2;
    }
    
    /**
     * 
     * @return integer
     */
    public function multiplyWithMissingParametersAnnotation($number1, $number2) {
        return $number1*$number2;
    }
    
}
