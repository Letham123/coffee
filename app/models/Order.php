<?php
namespace App\Models;

class Order {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function index() {
        $orderModel = new Order($this->conn);
    }
    public function create($id_user, $total, $fee_ship, $adress, $payment) {
        $sql = "INSERT INTO orders (id_user, total, fee_ship, adress, payment, order_date, status)
                VALUES (?, ?, ?, ?, ?, NOW(), 'Chờ xử lý')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iidss", $id_user, $total, $fee_ship, $adress, $payment);
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function getByUserId($id_user) {
        $sql = "SELECT * FROM orders WHERE id_user = ? ORDER BY id_order DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        return $orders;
    }

    public function getAll() {
        $sql = "SELECT * FROM orders ORDER BY id_order DESC";
        $result = $this->conn->query($sql);
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        return $orders;
    }

    public function getById($id_order) {
        $sql = "SELECT * FROM orders WHERE id_order = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_order);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateStatus($id_order, $status) {
        $sql = "UPDATE orders SET status = ? WHERE id_order = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $id_order);
        return $stmt->execute();
    }

    public function delete($id_order) {
        $sql = "DELETE FROM orders WHERE id_order = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_order);
        return $stmt->execute();
    }
    // Thống kê doanh thu theo ngày
    public function getRevenueByDate($date) {
        $date = mysqli_real_escape_string($this->conn, $date);
        $sql = "SELECT SUM(total) as total FROM orders WHERE DATE(create_at) = '$date' AND status = 'Đã giao'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    // Thống kê doanh thu theo tháng
    public function getRevenueByMonth($month) {
        $month = mysqli_real_escape_string($this->conn, $month);
        $sql = "SELECT SUM(total) as total FROM orders WHERE DATE_FORMAT(create_at, '%Y-%m') = '$month' AND status = 'Đã giao'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    // Thống kê doanh thu theo năm
    public function getRevenueByYear($year) {
        $year = mysqli_real_escape_string($this->conn, $year);
        $sql = "SELECT SUM(total) as total FROM orders WHERE YEAR(create_at) = '$year' AND status = 'Đã giao'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }
    public function getRevenueByPaymentMethod($date){
    $date = mysqli_real_escape_string($this->conn, $date);
    $sql = "SELECT payment, SUM(total) as tongtien
            FROM orders
            WHERE DATE(create_at) = '$date' AND status='Đã giao'
            GROUP BY payment";
    $result = mysqli_query($this->conn, $sql);
    $payments = [];
    while($row = mysqli_fetch_assoc($result)){
        $payments[] = $row;
    }
    return $payments;
}

}
