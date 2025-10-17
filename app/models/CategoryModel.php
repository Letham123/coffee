<?php
namespace app\models;

class CategoryModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM category");
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function create($name_category) {
        $stmt = $this->conn->prepare("INSERT INTO category (name_category) VALUES (?)");
        $stmt->bind_param("s", $name_category);
        return $stmt->execute();
    }

    public function getById($id_category) {
        $stmt = $this->conn->prepare("SELECT * FROM category WHERE id_category=?");
        $stmt->bind_param("i", $id_category);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id_category, $name_category) {
        $stmt = $this->conn->prepare("UPDATE category SET name_category=? WHERE id_category=?");
        $stmt->bind_param("si", $name_category, $id_category);
        return $stmt->execute();
    }

    public function delete($id_category) {
        $stmt = $this->conn->prepare("DELETE FROM category WHERE id_category=?");
        $stmt->bind_param("i", $id_category);
        return $stmt->execute();
    }
}
