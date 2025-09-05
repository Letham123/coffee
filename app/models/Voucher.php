<?php
namespace app\models;
class Voucher {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function index() {
        $voucherModel = new Voucher($this->conn);
    }
    public function getAll() {
        $sql = "SELECT * FROM magiamgia ORDER BY id DESC";
        $result = mysqli_query($this->conn, $sql);
        $list = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $list[] = $row;
        }
        return $list;
    }

    public function getById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM magiamgia WHERE id = $id LIMIT 1";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function create($ma, $phan_tram_giam, $giam_toi_da, $ngay_bat_dau, $ngay_ket_thuc, $so_luong, $da_su_dung, $trang_thai, $dieukien) {
        $stmt = $this->conn->prepare("
            INSERT INTO magiamgia (ma, phan_tram_giam, giam_toi_da, ngay_bat_dau, ngay_ket_thuc, so_luong, da_su_dung, trang_thai, dieukien)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("sddssiiis", $ma, $phan_tram_giam, $giam_toi_da, $ngay_bat_dau, $ngay_ket_thuc, $so_luong, $da_su_dung, $trang_thai, $dieukien);
        return $stmt->execute();
    }

    public function update($id, $ma, $phan_tram_giam, $giam_toi_da, $ngay_bat_dau, $ngay_ket_thuc, $so_luong, $da_su_dung, $trang_thai, $dieukien) {
    $stmt = $this->conn->prepare("
        UPDATE magiamgia SET 
            ma = ?, 
            phan_tram_giam = ?, 
            giam_toi_da = ?, 
            ngay_bat_dau = ?, 
            ngay_ket_thuc = ?, 
            so_luong = ?, 
            da_su_dung = ?, 
            trang_thai = ?, 
            dieukien = ?
        WHERE id = ?
    ");

    if (!$stmt) {
        die("Prepare failed: " . $this->conn->error); // sẽ hiển thị lỗi SQL nếu prepare thất bại
    }

    $stmt->bind_param(
        "sddssiiisi", 
        $ma, 
        $phan_tram_giam, 
        $giam_toi_da, 
        $ngay_bat_dau, 
        $ngay_ket_thuc, 
        $so_luong, 
        $da_su_dung, 
        $trang_thai, 
        $dieukien, 
        $id
    );

    return $stmt->execute();
}


    public function delete($id) {
        $id = intval($id);
        $sql = "DELETE FROM magiamgia WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }
}
