<?php

class Controller {
   protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function model($modelName) {
        $modelClass = "app\\models\\" . ucfirst($modelName) . 'Model';
        $file = ROOT_PATH . '/app/models/' . ucfirst($modelName) . 'Model.php';
        
        if (file_exists($file)) {
            require_once $file;
            if (class_exists($modelClass)) {
                return new $modelClass($this->conn);
            }
        }
        
        throw new Exception("Model $modelName not found.");
    }


    public function view($view, $data = []) {
        $file = ROOT_PATH . '/app/views/' . $view . '.php';
        if (file_exists($file)) {
            extract($data);
            require $file;
        } else {
            echo "View $view not found.";
        }
    }
}