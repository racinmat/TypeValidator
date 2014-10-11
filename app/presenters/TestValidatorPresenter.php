<?php

namespace App\Presenters;

use Nette;
use App\Model\TestedLibrary;


/**
 * Sign in/out presenters.
 */
class TestValidatorPresenter extends BasePresenter {

    /**
     *
     * @var TestedLibrary
     * @inject
     */
    public $testedLibrary;
    
    public function actionValidateCorrect() {
        $this->testedLibrary->multiply(1, 2);
        $this->testedLibrary->multiplyWithMissingParametersAnnotation(1, 2);
        $this->testedLibrary->multiplyWithMissingReturnAnnotation(1, 2);
        $this->testedLibrary->multiplyWithNoAnnotation(1, 2);
    }
    
    public function actionValidateWrong() {
        $this->testedLibrary->multiply("1", "2");
        $this->testedLibrary->multiplyWithMissingParametersAnnotation("1", "2");
        $this->testedLibrary->multiplyWithMissingReturnAnnotation("1", "2");
        $this->testedLibrary->multiplyWithNoAnnotation("1", "2");
    }

    public function renderShowLog() {
        \Tracy\Debugger::barDump($this->readLog());
        $this->template->logs = $this->readLog();
    }
    
    public function readLog() {
        $soubor = fopen(__DIR__."/../types.log", "a+"); 
        $logs = array();
        while ($string = fgets($soubor)) {
            $logs[] = $string;
        }
        return $logs;
    }
}
