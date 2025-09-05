<?php
namespace app\controllers\Admin;

use app\models\Order;
use app\models\OrderDetail;

class OrdersController {
    protected $orderModel;
    protected $orderDetailModel;

    public function __construct($db) {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: /coffee/login"); 
            exit();
        }

        $this->orderModel = new Order($db);
        $this->orderDetailModel = new OrderDetail($db);
    }

    public function index() {
        $orders = $this->orderModel->getAll();
        require_once __DIR__ . '/../../views/admin/orders/index.php';
    }

    public function detail($id) {
        $order = $this->orderModel->getById($id);
        if (!$order) {
            echo "Đơn hàng không tồn tại";
            exit();
        }
        $orderDetails = $this->orderDetailModel->getByOrderId($id);
        require_once __DIR__ . '/../../views/admin/orders/detail.php';
    }

    public function view($id) {
        $order = $this->orderModel->getById($id);
        if (!$order) {
            echo "Đơn hàng không tồn tại";
            exit();
        }
        require_once __DIR__ . '/../../views/admin/orders/view.php';
    }

    public function updateStatus($id_order) {
    session_start();
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
        header("Location: /coffee/login");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $status = $_POST['status'] ?? '';
        if (!empty($status)) {
            $this->orderModel->updateStatus($id_order, $status);
        }
    }

    header("Location: /coffee/admin/orders/view/$id_order");
    exit();
}

    

    public function delete($id_order) {
        $this->orderModel->delete($id_order);
        header("Location: /coffee/admin/orders/index");
        exit();
    }
}
