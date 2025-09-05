<?php
namespace app\models;
class ProductModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
     public function index() {
        $productModel = new ProductModel($this->conn);
    }
   public function getAll() {
    $sql = "SELECT p.*, c.ten_danhmuc 
            FROM sanpham p 
            LEFT JOIN danhmuc c ON p.id_category = c.id_category
            ORDER BY p.id_product DESC";
    $result = $this->conn->query($sql);
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}


    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM sanpham WHERE id_product = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($name, $price, $image, $description) {
        $stmt = $this->conn->prepare("INSERT INTO sanpham (name, price, image, description, id_category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdssi", $name, $price, $image, $description, $id_category);
        return $stmt->execute();
    }

    public function update($id, $name, $price , $image, $description) {
        $stmt = $this->conn->prepare("UPDATE sanpham SET name=?, price=?, image=?, description=? WHERE id_product=?");
        $stmt->bind_param("sdssii", $name, $price,$image, $description, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM sanpham WHERE id_product=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getProductsByCategory($category) {
        $stmt = $this->conn->prepare(" SELECT p.* 
    FROM sanpham p
    JOIN danhmuc c ON p.id_category = c.id_category
    WHERE c.ten_danhmuc = ?
    ");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function updateImage($id, $imagePath) {
    $stmt = $this->conn->prepare("UPDATE sanpham SET image = ? WHERE id = ?");
    $stmt->bind_param("si", $imagePath, $id);
    $stmt->execute();
    }
    public function searchProducts($search) {
    $stmt = $this->conn->prepare("SELECT * FROM sanpham WHERE name LIKE ?");
    $likeSearch = "%$search%";
    $stmt->bind_param("s", $likeSearch); // bind_param đúng cách
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
    }
}
