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
        $sql = "SELECT * FROM discouny ORDER BY iddiscount DESC";
        $result = mysqli_query($this->conn, $sql);
        $list = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $list[] = $row;
        }
        return $list;
    }

    public function getById($iddiscount) {
        $iddiscount = intval($iddiscount);
        $sql = "SELECT * FROM discount WHERE iddiscount = $iddiscount LIMIT 1";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function create($iddiscount, $discountpercentage, $Max_discount, $Create_at, $End_date, $Quantity, $Used_times, $Status, $Condition) {
        $stmt = $this->conn->prepare("
            INSERT INTO discount (iddiscount, discountpercentage, Max_discount, Create_at, End_date, Quantity, Used_times, Status, Condition)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("sddssiiis", $iddiscount, $discountpercentage, $Max_discount, $Create_at, $End_date, $Quantity, $Used_times, $Status, $Condition);
        return $stmt->execute();
    }

    public function update($iddiscount, $id, $discountpercentage, $Max_discount, $Create_at, $End_date, $Quantity, $Used_times, $Status, $Condition) {
    $stmt = $this->conn->prepare("
        UPDATE discount SET 
            iddiscount = ?, 
            discountpercentage = ?, 
            Max_discount = ?, 
            Create_at = ?, 
            End_date = ?, 
            Quantity = ?, 
            Used_times = ?, 
            Status = ?, 
            Condition = ?
        WHERE iddiscount = ?
    ");

    if (!$stmt) {
        die("Prepare failed: " . $this->conn->error); // sẽ hiển thị lỗi SQL nếu prepare thất bại
    }

    $stmt->bind_param(
        "sddssiiisi", 
        $ma, 
        $discountpercentage, 
        $Max_discount, 
        $Create_at, 
        $End_date, 
        $Quantity, 
        $Used_times, 
        $Status, 
        $dieukien, 
        $iddiscount
    );

    return $stmt->execute();
}


    public function delete($iddiscount) {
        $iddiscount = intval($iddiscount);
        $sql = "DELETE FROM discount WHERE iddiscount = $iddiscount";
        return mysqli_query($this->conn, $sql);
    }
}
