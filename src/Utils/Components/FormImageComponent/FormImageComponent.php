<?php

namespace Utils\Components\FormImageComponent;

class FormImageComponent
{
    public string $name;
    public string $label;
    public ?string $value;
    public ?string $base64Value;
    public ?string $imgType;
    public bool $required;
    public bool $readOnly;

    public function __construct(string $name, string $label, ?string $base64Value, bool $required = true, bool $readOnly = true)
    {
        $this->name = $name;
        $this->label = $label;
        $this->base64Value = $base64Value;
        $this->required = $required;
        $this->readOnly = $readOnly;
    }

    public function getRenderedComponent()
    {
        ob_start();
        include "FormImageComponent.template.php";
        return ob_get_clean();
    }
}