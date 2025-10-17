<?php
namespace app\controllers;

use app\models\ProductModel;

class HomeController {
    private $productModel;

    public function __construct($conn) {
        $this->productModel = new ProductModel($conn);
    }

    public function index() {
{
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Lấy dữ liệu theo danh mục
    if ($search !== '') {
        $nhan = $this->productModel->searchProductsByCategory('nhẫn', $search);
        $daychuyen    = $this->productModel->searchProductsByCategory('Dâychuyền', $search);
        $vongtay   = $this->productModel->searchProductsByCategory('Vòngtay', $search);
    } else {
        $nhan = $this->productModel->getProductsByCategory('nhẫn');
        $daychuyen = $this->productModel->getProductsByCategory('Dâychuyền');
        $vongtay= $this->productModel->getProductsByCategory('Vòngtay');
    }

    $this->view('home/index', [
        'nhan' => $nhan,
        'daychuyen'    => $daychuyen,
        'vongtay'   => $vongtay,
        'search' => $search
    ]);
    }

}
    public function searchResult() {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    if ($search === '') {
        // Nếu không có từ khóa, redirect về trang chính
        header("Location: /jewelery/");
        exit;
    }

    // Tìm tất cả sản phẩm khớp search, không phân category
    $products = $this->productModel->searchProducts($search);

    // Load view riêng cho kết quả search
    $this->view('home/search_result', [
        'products' => $products,
        'search' => $search
    ]);
}

    // Hàm load view
    private function view($view, $data = []) {
        extract($data);
        // Đường dẫn giờ sẽ đúng: C:\xampp\htdocs\jewelery\app\views/home/index.php
        require_once __DIR__ . "/../views/{$view}.php";
    }
}
