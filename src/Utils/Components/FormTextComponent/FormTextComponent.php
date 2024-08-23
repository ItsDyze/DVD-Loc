<?php
namespace Utils\Components\FormTextComponent;
class FormTextComponent
{
    public string $name;
    public string $label;
    public string $value;
    public string $placeholder;

    public function __construct(string $name, string $label, string $value = "", string $placeholder = "")
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    public function getRenderedComponent()
    {
        ob_start();
        include "FormTextComponent.template.php";
        return ob_get_clean();
    }
}
