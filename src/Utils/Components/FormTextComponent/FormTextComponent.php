<?php
namespace Utils\Components\FormTextComponent;
class FormTextComponent
{
    public string $name;
    public string $label;
    public ?string $value;
    public ?string $placeholder;
    public bool $required;
    public bool $readOnly;

    public function __construct(string $name, string $label, ?string $placeholder = null, ?string $value = "", bool $required = true, bool $readOnly = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->readOnly = $readOnly;
    }

    public function getRenderedComponent()
    {
        ob_start();
        include "FormTextComponent.template.php";
        return ob_get_clean();
    }
}
