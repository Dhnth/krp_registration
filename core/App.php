<?php
class App {
    protected $controller = 'PendaftaranController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        // Cek controller
        if (isset($url[0]) && !empty($url[0])) {
            $controllerName = ucfirst(strtolower($url[0])) . 'Controller';
            $controllerFile = 'app/controllers/' . $controllerName . '.php';
            
            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                // Jika controller tidak ditemukan, tampilkan 404
                http_response_code(404);
                echo "<h1>404 - Controller Not Found</h1>";
                echo "<p>Controller: " . htmlspecialchars($controllerName) . "</p>";
                echo "<p>File: " . htmlspecialchars($controllerFile) . "</p>";
                exit;
            }
        }

        // Require controller
        $controllerFile = 'app/controllers/' . $this->controller . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $this->controller = new $this->controller;
        } else {
            die("Controller file not found: " . $controllerFile);
        }

        // Cek method
        if (isset($url[1]) && !empty($url[1])) {
            $methodName = $url[1];
            if (method_exists($this->controller, $methodName)) {
                $this->method = $methodName;
                unset($url[1]);
            }
        }

        // Params
        $this->params = $url ? array_values($url) : [];

        // Jalankan controller dan method dengan params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        $url = [];
        if (isset($_GET['url']) && !empty($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
        }
        return $url;
    }
}