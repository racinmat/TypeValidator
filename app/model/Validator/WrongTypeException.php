<?php

/*
 * Copyright © 2014, Matěj Račinský. Všechna práva vyhrazena.
 */

namespace App\Model\Validator;

use \InvalidArgumentException;

/**
 * Description of WrongTypeException
 *
 * @author Matěj Račinský
 */
class WrongTypeException extends InvalidArgumentException {
    
    const
        NAME_IN_ANNOTATION_DIFFERS = "different name",
        UNKNOWN_TYPE = "unknown type", 
        WRONG_TYPE = "wrong type"
    ;
    
}
