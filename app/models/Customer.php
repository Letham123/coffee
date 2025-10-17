<?php
namespace App\Models;

class Customer {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getAll() {
        $sql = "SELECT * FROM user ORDER BY id DESC";
        $result = $this->conn->query($sql);
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        return $customers;
    }

    public function getById($id) {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $fullname, $phone, $email) {
        $sql = "UPDATE user SET fullname = ?, phone = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $fullname, $phone, $email, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
