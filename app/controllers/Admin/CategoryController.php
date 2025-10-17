<?php
namespace app\controllers\Admin;

use app\models\CategoryModel;

class CategoryController {
    private $categoryModel;

    public function __construct($conn) {
        $this->categoryModel = new CategoryModel($conn);
    }

    // Trang danh sách danh mục
    public function index() {
        $categories = $this->categoryModel->getAll();
        require_once __DIR__ . '/../../views/admin/category/index.php';
    }

    // Thêm danh mục mới
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_danhmuc = $_POST['ten_danhmuc'] ?? '';
            if ($ten_danhmuc) {
                $this->categoryModel->create($ten_danhmuc);
            }
            header("Location: /jewelry/admin/category/index");
            exit();
        }
        require_once __DIR__ . '/../../views/admin/category/create.php';
    }

    // Sửa danh mục
    public function edit($id_category) {
        $category = $this->categoryModel->getById($id_category);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_danhmuc = $_POST['ten_danhmuc'] ?? '';
            if ($ten_danhmuc) {
                $this->categoryModel->update($id_category, $ten_danhmuc);
            }
            header("Location: /jewelry/admin/category/index");
            exit();
        }
        require_once __DIR__ . '/../../views/admin/category/edit.php';
    }

    // Xóa danh mục
    public function delete($id_category) {
        $this->categoryModel->delete($id_category);
        header("Location: /jewelry/admin/category/index");
        exit();
    }
}
?>
