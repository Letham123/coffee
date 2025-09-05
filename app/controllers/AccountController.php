<?php
namespace app\controllers;

use app\models\UserModel;

class AccountController {

    private $userModel;

    public function __construct($conn) {
        if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
        $this->userModel = new UserModel($conn);
    }

    public function index() {
        if (!isset($_SESSION['username']) || !isset($_SESSION['id_user'])) {
            header('Location: /login');
            exit;
        }

        $id_user = $_SESSION['id_user'];
        $userInfo = $this->userModel->getUserInfo($id_user);
        $orders = $this->userModel->getOrders($id_user);

        require_once ROOT_PATH . '/app/views/account/index.php';
    }
    // Xử lý đổi mật khẩu
    public function changePassword() {
        $userId = $_SESSION['user_id'] ?? null;
        if(!$userId) {
            header("Location: /coffee/home/index");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            $userModel = new User();
            $user = $userModel->getUserById($userId);

            if(!$user) {
                $_SESSION['changePasswordMessage'] = ['type'=>'error','text'=>'Người dùng không tồn tại.'];
                header("Location: /coffee/account/index");
                exit;
            }

            // Kiểm tra mật khẩu hiện tại
            if(!password_verify($currentPassword, $user['password'])) {
                $_SESSION['changePasswordMessage'] = ['type'=>'error','text'=>'Mật khẩu hiện tại không đúng.'];
                header("Location: /coffee/account/index");
                exit;
            }

            // Kiểm tra mật khẩu mới và xác nhận
            if($newPassword !== $confirmPassword) {
                $_SESSION['changePasswordMessage'] = ['type'=>'error','text'=>'Xác nhận mật khẩu mới không khớp.'];
                header("Location: /coffee/account/index");
                exit;
            }

            // Hash mật khẩu mới và cập nhật
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updated = $userModel->updatePassword($userId, $hashedPassword);

            if($updated) {
                $_SESSION['changePasswordMessage'] = ['type'=>'success','text'=>'Đổi mật khẩu thành công.'];
            } else {
                $_SESSION['changePasswordMessage'] = ['type'=>'error','text'=>'Đổi mật khẩu thất bại, thử lại sau.'];
            }

            header("Location: /coffee/account/index");
            exit;
        }

        // Nếu không phải POST, chuyển về trang hồ sơ
        header("Location: /coffee/account/index");
        exit;
    }
}
