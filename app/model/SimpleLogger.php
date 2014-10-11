<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

use Nette\Object;
use App\Model\Validator\ITypeValidatorLogger;

/**
 * Description of SimpleLogger
 *
 * @author Azathoth
 */
class SimpleLogger extends Object implements ITypeValidatorLogger {
    
    public function logValidator($string) {
        $soubor = fopen(__DIR__."../../types.log", "a+"); 
        fwrite($soubor, $string."\n"); 
        fclose($soubor);
    }

}
