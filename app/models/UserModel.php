<?php
namespace app\models;
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn; 
    }
     public function index() {
        $userModel = new UserModel($this->conn);
    }
    public function getByUsername($username) {
        $sql = "SELECT * FROM nguoidung WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getByEmail($email) {
        $sql = "SELECT * FROM nguoidung WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function register($username, $email, $password) {
        $sql = "INSERT INTO nguoidung (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);
        return $stmt->execute();
    }

    public function getUserInfo($id_user) {
        $sql = "SELECT * FROM nguoidung WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getOrders($id_user) {
        $sql = "SELECT * FROM donhang WHERE id_user = ? ORDER BY id_order DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllCustomers() {
        $sql = "SELECT * FROM nguoidung ORDER BY id_user DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id_user) {
        $sql = "SELECT * FROM nguoidung WHERE id_user = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function delete($id_user) {
        $sql = "DELETE FROM nguoidung WHERE id_user = ? AND loai_nguoi_dung = 'Khách hàng'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        return $stmt->execute();
    }

    public function update($id_user, $username, $email, $loai_nguoi_dung) {
    $sql = "UPDATE nguoidung 
            SET username = ?, email = ?, loai_nguoi_dung = ? 
            WHERE id_user = ?";
    $stmt = $this->conn->prepare($sql);
    if ($stmt === false) {
        die("Lỗi prepare: " . $this->conn->error);
    }
    $stmt->bind_param("sssi", $username, $email, $loai_nguoi_dung, $id_user);
    return $stmt->execute();
}
      public function updatePassword($userId, $hashedPassword) {
        $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
        return $stmt->execute(['password'=>$hashedPassword, 'id'=>$userId]);
    }
}
