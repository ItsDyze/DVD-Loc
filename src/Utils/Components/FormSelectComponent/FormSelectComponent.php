<?php
namespace Utils\Components\FormSelectComponent;
class FormSelectComponent
{
    public string $name;
    public string $label;
    public ?string $value;
    public bool $required;
    public bool $readOnly;
    public array $availableValues;

    public function __construct(string $name, string $label, ?int $value, array $availableValues = [], bool $required = true, bool $readOnly = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->availableValues = $availableValues;
        $this->required = $required;
        $this->readOnly = $readOnly;
    }

    public function getRenderedComponent()
    {
        ob_start();
        include "FormSelectComponent.template.php";
        return ob_get_clean();
    }
}
