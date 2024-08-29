<?php

namespace Utils\Components\FormNumberComponent;

class FormNumberComponent
{
    public string $name;
    public string $label;
    public ?string $value;
    public ?int $min;
    public ?int $max;
    public ?float $step;
    public bool $required;
    public bool $readOnly;

    public function __construct(string $name,
                                string $label,
                                ?string $value = "",
                                int $min = null,
                                int $max = null,
                                float $step = null,
                                bool $required = true,
                                bool $readOnly = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
        $this->required = $required;
        $this->readOnly = $readOnly;
    }

    public function getRenderedComponent()
    {
        ob_start();
        include "FormNumberComponent.template.php";
        return ob_get_clean();
    }
}