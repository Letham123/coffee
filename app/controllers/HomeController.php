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
        $coffee = $this->productModel->searchProductsByCategory('coffee', $search);
        $tea    = $this->productModel->searchProductsByCategory('tea', $search);
        $cake   = $this->productModel->searchProductsByCategory('cake', $search);
    } else {
        $coffee = $this->productModel->getProductsByCategory('coffee');
        $tea    = $this->productModel->getProductsByCategory('tea');
        $cake   = $this->productModel->getProductsByCategory('cake');
    }

    $this->view('home/index', [
        'coffee' => $coffee,
        'tea'    => $tea,
        'cake'   => $cake,
        'search' => $search
    ]);
    }

}
    public function searchResult() {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    if ($search === '') {
        // Nếu không có từ khóa, redirect về trang chính
        header("Location: /coffee/");
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
        // Đường dẫn giờ sẽ đúng: C:\xampp\htdocs\coffee\app\views/home/index.php
        require_once __DIR__ . "/../views/{$view}.php";
    }
}
