<?php
namespace app\controllers\Admin;
use app\models\UserModel;

class UsersController {

    private $userModel;

    public function __construct($db) {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: /coffee/login");
            exit();
        }
        $this->userModel = new UserModel($db);
    }

    public function index() {
        $users = $this->userModel->getAllCustomers();
        require_once ROOT_PATH . '/app/views/admin/users/index.php';
    }

    public function detail($id_user) {
        $user = $this->userModel->getById($id_user);
        if (!$user) {
            echo "Khách hàng không tồn tại";
            exit;
        }
        require_once ROOT_PATH . '/app/views/admin/users/detail.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'] ?? null;
            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;
            $loai_nguoi_dung = $_POST['loai_nguoi_dung'] ?? null;
            if ($id_user && $username && $email && $loai_nguoi_dung) {
                $this->userModel->update($id_user, $username, $email, $loai_nguoi_dung);
            }
            header("Location: /coffee/admin/users/index");
            exit();
        }
    }

    public function delete($id_user) {
        $this->userModel->delete($id_user);
        header("Location: /coffee/admin/users/index");
        exit();
    }
}
