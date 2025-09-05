<?php
define('ROOT_PATH', __DIR__);
require_once ROOT_PATH . '/config/database.php';
require_once __DIR__ . '/vendor/autoload.php';

// Autoload theo PSR-4
spl_autoload_register(function ($class) {
    $class_path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = ROOT_PATH . '/app/' . $class_path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];
$base_path = str_replace('index.php', '', $script_name);

$path = parse_url($request_uri, PHP_URL_PATH);
$path = substr($path, strlen($base_path));
$parts = explode('/', trim($path, '/'));

$params = [];

if (isset($parts[0]) && strtolower($parts[0]) === 'admin') {
    $controller_name = !empty($parts[1]) ? ucfirst($parts[1]) : 'Home';
    $action_name = !empty($parts[2]) ? $parts[2] : 'index';
    $params = array_slice($parts, 3);

    $controller_class = "app\\controllers\\Admin\\{$controller_name}Controller";
    $controller_file = ROOT_PATH . "/app/controllers/Admin/{$controller_name}Controller.php";
} else {
    $controller_name = !empty($parts[0]) ? ucfirst($parts[0]) : 'Home';
    $action_name = !empty($parts[1]) ? $parts[1] : 'index';
    $params = array_slice($parts, 2);

    $controller_class = "app\\controllers\\{$controller_name}Controller";
    $controller_file = ROOT_PATH . "/app/controllers/{$controller_name}Controller.php";
}

if (file_exists($controller_file)) {
    if (class_exists($controller_class)) {
        $controller = new $controller_class($conn);

    if (class_exists($controller_class)) {
        $controller = new $controller_class($conn);

        if (method_exists($controller, $action_name)) {
            call_user_func_array([$controller, $action_name], $params);
        } else {
            http_response_code(404);
            echo "404 Not Found: Action '$action_name' không tồn tại.";
        }
    } else {
        http_response_code(404);
        echo "404 Not Found: Controller class '$controller_class' không tồn tại.";
    }
} else {
    http_response_code(404);
    echo "404 Not Found: Controller file '$controller_file' không tồn tại.";
}
}
