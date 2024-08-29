<?php
namespace Utils\Components\FormToggleComponent;
class FormToggleComponent
{
    public string $name;
    public string $label;
    public ?string $value;
    public ?string $placeholder;
    public bool $required;
    public bool $readOnly;

    public function __construct(string $name, string $label, ?string $value = "", bool $required = true, bool $readOnly = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->required = $required;
        $this->readOnly = $readOnly;
    }

    public function getRenderedComponent()
    {
        ob_start();
        include "FormToggleComponent.template.php";
        return ob_get_clean();
    }
}
