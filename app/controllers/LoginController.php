<?php
namespace app\controllers;

class LoginController {
    public function index() {
        require_once __DIR__ . '/../views/user/login.php';
    }
}
