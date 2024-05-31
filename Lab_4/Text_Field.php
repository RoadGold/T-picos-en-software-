<?php
class TextField {
    private $name;
    private $label;
    private $value;

    public function __construct($name, $label, $value = '') {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    public function render() {
        return "
        <div class='form-group'>
            <label for='{$this->name}'>{$this->label}</label>
            <input type='text' id='{$this->name}' name='{$this->name}' value='{$this->value}' class='form-control'>
        </div>
        ";
    }
}
?>