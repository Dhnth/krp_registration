<?php
class View {
    public static function render($view, $data = []) {
        extract($data);
        $viewFile = 'app/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die('View tidak ditemukan: ' . $view);
        }
    }

    public static function component($component, $data = []) {
        extract($data);
        $componentFile = 'app/views/partials/' . $component . '.php';
        if (file_exists($componentFile)) {
            require_once $componentFile;
        }
    }
}