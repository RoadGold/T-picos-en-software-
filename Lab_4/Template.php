<?php
class Template {
    private $vars = array();

    public function set($key, $value) {
        $this->vars[$key] = $value;
    }

    public function render($template) {
        $path = $template . '.php';
        if (file_exists($path)) {
            extract($this->vars);
            ob_start();
            include($path);
            $content = ob_get_clean();
            return $content;
        }
        return false;
    }
}
?>