<?php
class Controller {
    public function view($view, $data = []) {
        // Extract data agar bisa diakses di view
        extract($data);
        
        $viewFile = 'app/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die('View tidak ditemukan: ' . $view);
        }
    }

    public function model($model) {
        if (file_exists('app/models/' . $model . '.php')) {
            require_once 'app/models/' . $model . '.php';
            return new $model;
        } else {
            die('Model tidak ditemukan: ' . $model);
        }
    }

    public function redirect($url) {
        header('Location: ' . BASE_URL . '/' . $url);
        exit;
    }

    public function isLoggedIn() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }

    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('admin/login');
        }
    }
}