<?php
namespace App\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;

require_once ROOT_PATH . '/app/models/Order.php';
require_once ROOT_PATH . '/app/models/OrderDetail.php';
class PaymentReportController {
    private $orderModel;
    private $orderDetailModel;

    public function __construct($conn) {
         if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: /jewelry/login");
            exit();
        }
        $this->orderModel = new Order($conn);
        $this->orderDetailModel = new OrderDetail($conn);
    }

    public function index() {
        require_once ROOT_PATH . '/app/views/admin/payment_report/index.php';
    }

    public function revenueByDate() {
    $date = $_GET['date'] ?? date('Y-m-d');
    $revenue = $this->orderModel->getRevenueByDate($date);

    // Lấy doanh thu theo phương thức thanh toán (dùng cho biểu đồ)
    $dailyPayments = $this->orderModel->getRevenueByPaymentMethod($date);

    // Gửi dữ liệu sang view
    require_once ROOT_PATH . '/app/views/admin/payment_report/revenue_by_date.php';
}


    public function revenueByMonth() {
        $month = $_GET['month'] ?? date('Y-m');
        $revenue = $this->orderModel->getRevenueByMonth($month);
        require_once ROOT_PATH . '/app/views/admin/payment_report/revenue_by_month.php';
    }

    public function revenueByYear() {
        $year = $_GET['year'] ?? date('Y');
        $revenue = $this->orderModel->getRevenueByYear($year);
        require_once ROOT_PATH . '/app/views/admin/payment_report/revenue_by_year.php';
    }

    public function topProducts() {
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        if ($limit < 1) $limit = 10;
        $topProducts = $this->orderDetailModel->getTopSellingProducts($limit);
        require_once ROOT_PATH . '/app/views/admin/payment_report/top_products.php';
    }
}
