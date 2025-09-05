<?php
namespace app\controllers;

use mysqli;

class ProductController {
    protected $conn;

    public function __construct() {
        $this->conn = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            die("Kết nối DB lỗi: " . $this->conn->connect_error);
        }
    }

    public function index() {
        $result = $this->conn->query("SELECT * FROM products");
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        require_once ROOT_PATH . '/app/views/product/index.php';
    }

    public function detail($id = null) {
        if (!$id) {
            echo "Sản phẩm không tồn tại";
            return;
        }
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if (!$product) {
            echo "Sản phẩm không tồn tại";
            return;
        }
        require_once ROOT_PATH . '/app/views/product/detail.php';
    }
}
