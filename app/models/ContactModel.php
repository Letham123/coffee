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
        $sql = "INSERT INTO lienhe (name, email, sdt, noidung, ngaygui) 
                VALUES (:name, :email, :sdt, :noidung, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':sdt' => $data['phone'],
            ':noidung' => $data['message']
        ]);
    }
    public function getAll() {
    $sql = "SELECT * FROM lienhe ORDER BY ngaygui DESC";
    $result = $this->db->query($sql);

    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}


}
