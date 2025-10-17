<?php
namespace App\Models;

use PDO;

class ContactModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Lưu dữ liệu liên hệ vào bảng lienhe
    public function save($data) {
        $sql = "INSERT INTO contact (name, email, phone, descr, create_at) 
                VALUES (:name, :email, :phone, :descr, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':descr' => $data['message']
        ]);
    }
    public function getAll() {
    $sql = "SELECT * FROM contact ORDER BY create_at DESC";
    $result = $this->db->query($sql);

    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}


}
