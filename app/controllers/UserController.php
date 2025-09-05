<?php
namespace app\controllers;
use \Controller;
class UserController extends Controller {
    public function __construct($conn) {
        parent::__construct($conn);
    }
    public function login() {
    session_start();
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = $this->model('User');
        $user = $userModel->getByUsername($username);

        if ($user) {
            // Kiểm tra mật khẩu
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['loai_nguoi_dung'] = $user['loai_nguoi_dung'];
                
                // Kiểm tra vai trò và điều hướng
                if ($user['loai_nguoi_dung'] === 'Admin') {
                    $_SESSION['is_admin'] = true;
                    header("Location: /coffee/admin/admindashboard");
                } else {
                     $_SESSION['is_admin'] = false;
                    header("Location: /coffee/"); 
                }
                exit();
            } else {
                $error = "Mật khẩu không đúng.";
            }
        } else {
            $error = "Tài khoản không tồn tại.";
        }
    }

    // Hiển thị view đăng nhập với thông báo lỗi (nếu có)
    $this->view('user/login', ['error' => $error]);
}
    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $repassword = $_POST['repassword'] ?? '';

            if ($password !== $repassword) {
                $error = "Mật khẩu không khớp!";
            } else {
                $userModel = $this->model('User');

                if ($userModel->getByEmail($email)) {
                    $error = "Email đã tồn tại!";
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);

                    if ($userModel->register($fullname, $email, $hash)) {
                        $success = "Đăng ký thành công!";
                    } else {
                        $error = "Đăng ký thất bại, vui lòng thử lại.";
                    }
                }
            }
        }

        $this->view('user/register', ['error' => $error, 'success' => $success]);
    }
    public function logout() {
    session_start();
    session_destroy();
    header("Location: /coffee/home/index");
    exit();
}
}
