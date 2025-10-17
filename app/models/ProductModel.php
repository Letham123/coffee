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
    $sql = "SELECT p.*, c.name_category
            FROM product p 
            LEFT JOIN category c ON p.id_category = c.id_category
            ORDER BY p.id_product DESC";
    $result = $this->conn->query($sql);
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}


    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM product WHERE id_product = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($name, $price, $image, $descr) {
        $stmt = $this->conn->prepare("INSERT INTO product (name, price, image, descr, id_category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdssi", $name, $price, $image, $descr, $id_category);
        return $stmt->execute();
    }

    public function update($id, $name, $price , $image, $descr) {
        $stmt = $this->conn->prepare("UPDATE product SET name=?, price=?, image=?, descr=? WHERE id_product=?");
        $stmt->bind_param("sdssii", $name, $price,$image, $descr, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM product WHERE id_product=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getProductsByCategory($category) {
        $stmt = $this->conn->prepare(" SELECT p.* 
    FROM product p
    JOIN category c ON p.id_category = c.id_category
    WHERE c.name_category = ?
    ");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function updateImage($id, $imagePath) {
    $stmt = $this->conn->prepare("UPDATE product SET image = ? WHERE id = ?");
    $stmt->bind_param("si", $imagePath, $id);
    $stmt->execute();
    }
    public function searchProducts($search) {
    $stmt = $this->conn->prepare("SELECT * FROM product WHERE name LIKE ?");
    $likeSearch = "%$search%";
    $stmt->bind_param("s", $likeSearch); 
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
    }
}
