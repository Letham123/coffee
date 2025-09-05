<?php
namespace app\controllers\Admin;

use app\models\Order;
use app\models\UserModel;
use app\models\ProductModel;
use app\models\Voucher;

class AdminDashboardController {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function index() {
        $orderModel = new Order($this->conn);
        $userModel = new UserModel($this->conn);
        $productModel = new ProductModel($this->conn);
        $voucherModel = new Voucher($this->conn);

        // Lấy dữ liệu từ model
        $orders = $orderModel->getAll();
        $customers = $userModel->getAllCustomers();
        $products = $productModel->getAll();
        $vouchers = $voucherModel->getAll();

        // Lấy số lượng đơn hàng
        $orderCountResult = $this->conn->query("SELECT COUNT(*) as total FROM donhang");
        if (!$orderCountResult) die("SQL Error (donhang): " . $this->conn->error);
        $orderCount = $orderCountResult->fetch_assoc()['total'];

        // Lấy số lượng khách hàng
        $customerCountResult = $this->conn->query("SELECT COUNT(*) as total FROM nguoidung WHERE loai_nguoi_dung='Khách hàng'");
        if (!$customerCountResult) die("SQL Error (nguoidung): " . $this->conn->error);
        $customerCount = $customerCountResult->fetch_assoc()['total'];

        // Lấy số lượng sản phẩm
        $productCountResult = $this->conn->query("SELECT COUNT(*) as total FROM sanpham");
        if (!$productCountResult) die("SQL Error (sanpham): " . $this->conn->error);
        $productCount = $productCountResult->fetch_assoc()['total'];

        // Lấy số lượng voucher còn hạn
        $voucherCountResult = $this->conn->query("SELECT COUNT(*) as total FROM magiamgia WHERE ngay_ket_thuc >= CURDATE()");
        if (!$voucherCountResult) die("SQL Error (magiamgia): " . $this->conn->error);
        $voucherCount = $voucherCountResult->fetch_assoc()['total'];

        // Lấy 5 đơn hàng mới nhất
        $latestOrdersResult = $this->conn->query("
            SELECT dh.id_order, nd.username, dh.tongtien, dh.trangthai, dh.ngaydat
            FROM donhang dh
            JOIN nguoidung nd ON dh.id_user = nd.id_user
            ORDER BY dh.ngaydat DESC
            LIMIT 5
        ");
        if (!$latestOrdersResult) die("SQL Error (latest orders): " . $this->conn->error);

        $latestOrders = [];
        while ($row = $latestOrdersResult->fetch_assoc()) {
            $latestOrders[] = $row;
        }
        require_once ROOT_PATH . '/app/views/admin/dashboard.php';
    }
}
