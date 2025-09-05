<?php
namespace app\models;

class CategoryModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM danhmuc");
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function create($ten_danhmuc) {
        $stmt = $this->conn->prepare("INSERT INTO danhmuc (ten_danhmuc) VALUES (?)");
        $stmt->bind_param("s", $ten_danhmuc);
        return $stmt->execute();
    }

    public function getById($id_category) {
        $stmt = $this->conn->prepare("SELECT * FROM danhmuc WHERE id_category=?");
        $stmt->bind_param("i", $id_category);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id_category, $ten_danhmuc) {
        $stmt = $this->conn->prepare("UPDATE danhmuc SET ten_danhmuc=? WHERE id_category=?");
        $stmt->bind_param("si", $ten_danhmuc, $id_category);
        return $stmt->execute();
    }

    public function delete($id_category) {
        $stmt = $this->conn->prepare("DELETE FROM danhmuc WHERE id_category=?");
        $stmt->bind_param("i", $id_category);
        return $stmt->execute();
    }
}
