<?php
namespace app\controllers\Admin;
use app\models\ProductModel;
class ProductsController {
    private $productModel;
    private $db;
    public function __construct($db) {
        $this->db = $db; 
         if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: /coffee/login");
            exit();
        }
        $this->productModel = new ProductModel($db);
    }

    public function index() {
        $products = $this->productModel->getAll();
        require_once ROOT_PATH . '/app/views/admin/products/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $image = $_POST['image'] ?? '';
            $id_category = $_POST['id_category'] ?? null;
            $description = $_POST['description'] ?? '';

            $this->productModel->create($name, $price, $image, $id_category, $description);
            header("Location: /coffee/admin/products/index");
            exit();
        }
        $categoryModel = new \app\models\CategoryModel($this->db); // nếu $db private thì truyền vào constructor
        $categories = $categoryModel->getAll();
        require_once ROOT_PATH . '/app/views/admin/products/create.php';
    }

    public function edit($id) {
        $product = $this->productModel->getById($id);
        if (!$product) {
            echo "Sản phẩm không tồn tại";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $id_category = $_POST['id_category'] ?? null;
            $description = $_POST['description'] ?? '';

            // Xử lý upload ảnh
            $image = $product['image']; // Giữ ảnh cũ nếu không upload mới
            if (!empty($_FILES['image']['name'])) {
                $targetDir = ROOT_PATH . "/public/uploads/";
                $fileName = time() . "_" . basename($_FILES['image']['name']);
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $image = "/coffee/public/uploads/" . $fileName;
                }
            }

            // Cập nhật vào DB
            $this->productModel->update($id, $name, $price, $image, $id_category, $description);

            header("Location: /coffee/admin/products/index");
            exit();
        }
         $categoryModel = new \app\models\CategoryModel($this->db);
        $categories = $categoryModel->getAll();
        require_once ROOT_PATH . '/app/views/admin/products/edit.php';
    }
    public function delete($id) {
        $this->productModel->delete($id);
        header("Location: /coffee/admin/products/index");
        exit();
    }
}
