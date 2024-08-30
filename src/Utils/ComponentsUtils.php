<?php

namespace Utils
{

    use Utils\Components\ComponentsEnum;
    use Utils\Components\FormAreaComponent\FormAreaComponent;
    use Utils\Components\FormImageComponent\FormImageComponent;
    use Utils\Components\FormNumberComponent\FormNumberComponent;
    use Utils\Components\FormTextComponent\FormTextComponent;
    use Utils\Components\FormToggleComponent\FormToggleComponent;

    class ComponentsUtils
    {

        public static function getTextComponent($name, $label, $placeholder, $value, $required, $readOnly):string
        {
            $comp = new FormTextComponent($name, $label, $placeholder, $value, $required, $readOnly);
            return $comp->getRenderedComponent();
        }
        public static function getAreaComponent($name, $label, $placeholder, $value, $required, $readOnly):string
        {
            $comp = new FormAreaComponent($name, $label, $placeholder, $value, $required, $readOnly);
            return $comp->getRenderedComponent();
        }
        public static function getToggleComponent($name, $label, $value, $required, $readOnly):string
        {
            $comp = new FormToggleComponent($name, $label, $value, $required, $readOnly);
            return $comp->getRenderedComponent();
        }
        public static function getNumberComponent($name, $label, $value, $min, $max, $step, $required, $readOnly):string
        {
            $comp = new FormNumberComponent($name, $label, $value, $min, $max, $step, $required, $readOnly);
            return $comp->getRenderedComponent();
        }
        public static function getImageComponent($name, $label, $valueBase64, $required, $readOnly):string
        {
            $comp = new FormImageComponent($name, $label, $valueBase64, $required, $readOnly);
            return $comp->getRenderedComponent();
        }

    }
}

