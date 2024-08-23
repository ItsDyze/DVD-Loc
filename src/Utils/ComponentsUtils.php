<?php

namespace Utils
{

    use Utils\Components\ComponentsEnum;
    use Utils\Components\FormTextComponent\FormTextComponent;

    class ComponentsUtils
    {
        public static function getComponent(ComponentsEnum $componentType, string $name, string $label, ?string $placeholder = null, ?string $value = "", bool $required = true, bool $readOnly = false)
        {
            switch ($componentType) {
                case ComponentsEnum::FormText:
                    $textComponent = new FormTextComponent($name, $label, $placeholder, $value, $required, $readOnly);
                    return $textComponent->getRenderedComponent();
                default:
                    return "";
            }
        }
    }
}

