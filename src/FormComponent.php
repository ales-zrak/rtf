<?php
/**
 * Created by IntelliJ IDEA.
 * User: zrak
 * Date: 04/11/17
 * Time: 11:35
 */

namespace Basnik\Rtf;

class FormComponent extends \Nette\Forms\Controls\TextArea {

    protected $jsOptionCallback;

    public function __construct($label = null, $jsOptionCallback = NULL){
        parent::__construct($label);

        $this->jsOptionCallback = $jsOptionCallback;
    }

    public function getControl(){
        $control = parent::getControl();
        $control->class('js-basnikRtf', TRUE);
        $control->setAttribute("data-js-option-callback", $this->jsOptionCallback);
        return  $control;
    }

}