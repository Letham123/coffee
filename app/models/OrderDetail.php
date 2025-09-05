<?php
namespace App\Models;

class OrderDetail {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    // Lấy chi tiết đơn hàng
    public function getByOrderId($orderId) {
        $sql = "SELECT od.*, p.name, p.price, p.image 
                FROM chitietdonhang od 
                JOIN sanpham p ON od.id_sp = p.id 
                WHERE od.id_order = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $orderDetails = [];
        while ($row = $result->fetch_assoc()) {
            $orderDetails[] = $row;
        }
        return $orderDetails;
    }

    // Lấy top sản phẩm bán chạy
    public function getTopSellingProducts($limit = 10) {
    $limit = intval($limit);
    if ($limit < 1) $limit = 10;

    $sql = "SELECT sp.id_product, sp.name, SUM(ct.soluong) as total_sold
            FROM chitietdonhang ct
            JOIN sanpham sp ON ct.id_product = sp.id_product
            GROUP BY sp.id_product, sp.name
            ORDER BY total_sold DESC
            LIMIT $limit";
    
    $result = $this->conn->query($sql);
    if (!$result) {
        die("Lỗi SQL: " . $this->conn->error);
    }

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}

}
