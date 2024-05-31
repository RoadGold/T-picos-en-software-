<?php
class SubmitButton {
    private $label;

    public function __construct($label) {
        $this->label = $label;
    }

    public function render() {
        return "
        <div class='form-group'>
            <button type='submit' class='btn btn-primary'>{$this->label}</button>
        </div>
        ";
    }
}
?>