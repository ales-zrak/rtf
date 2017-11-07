<?php

namespace Basnik\Rtf;

use Nette\DI\CompilerExtension;
use Nette\Utils\Html;

/**
 *
 */
class Extension extends CompilerExtension {


    public function beforeCompile(){
        $builder = $this->getContainerBuilder();
        if ($builder->hasDefinition('nette.latteFactory')) {
            $builder->getDefinition('nette.latteFactory')
                ->addSetup('addFilter', ['markdown', 'Basnik\Rtf\Extension::markdownFilter']);
        }
    }


    public function afterCompile(\Nette\PhpGenerator\ClassType $class){
        $initialize = $class->getMethod('initialize');
        $initialize->addBody('\Nette\Forms\Container::extensionMethod("addRtf", function (\Nette\Forms\Container $form, $name, $label = NULL, $jsOptionCallback = NULL) {
            $component = new \Basnik\Rtf\FormComponent($label, $jsOptionCallback);
            $form->addComponent($component, $name);
            return $component;
        });');
    }

    public static function markdownFilter($text){
        $parsedown = new \Parsedown();
        $container = Html::el("div");
        $container->addHtml($parsedown->text($text));
        return $container;
    }
}