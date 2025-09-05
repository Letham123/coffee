<?php
namespace app\controllers;

class CartController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        if (!isset($_SESSION)) session_start();
        //unset($_SESSION['cart']);
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    }

    // Hiển thị giỏ hàng
    public function index() {
        $cart = $_SESSION['cart'];
        $discountAmount = $_SESSION['applied_discount'] ?? 0;
        $appliedCode = $_SESSION['applied_code'] ?? '';

        require_once ROOT_PATH . '/app/views/cart/index.php';
    }

    // Thêm sản phẩm vào giỏ
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $image = $_POST['image'] ?? '';
            $quantity = 1;

            if (!$id) exit('Không có ID sản phẩm');

            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$id] = [
                    'id' => $id,
                    'name' => $name,
                    'price' => $price,
                    'image' => $image,
                    'quantity' => $quantity
                ];
            }

            $_SESSION['flash_message'] = "Đã thêm vào giỏ hàng!";
            header("Location: /coffee/cart/index");
            exit;
        }
    }

    // Cập nhật số lượng
    public function updateQuantity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $action = $_POST['action'] ?? '';
            if ($id && isset($_SESSION['cart'][$id])) {
                if ($action === 'increase') $_SESSION['cart'][$id]['quantity']++;
                if ($action === 'decrease' && $_SESSION['cart'][$id]['quantity'] > 1) $_SESSION['cart'][$id]['quantity']--;
            }
        }
        header("Location: /coffee/cart/index");
        exit;
    }

    // Xóa sản phẩm hoặc xóa toàn bộ
    public function remove() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['all'])) {
                $_SESSION['cart'] = [];
                unset($_SESSION['applied_discount'], $_SESSION['applied_code']);
                $_SESSION['flash_message'] = "Đã xóa toàn bộ giỏ hàng!";
            } else {
                $id = $_POST['id'] ?? null;
                if ($id && isset($_SESSION['cart'][$id])) {
                    unset($_SESSION['cart'][$id]);
                    $_SESSION['flash_message'] = "Đã xóa sản phẩm!";
                }
            }
        }
        header("Location: /coffee/cart/index");
        exit;
    }

    // Áp dụng mã giảm giá
    public function applyDiscount() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $code = trim($_POST['discount_code'] ?? '');
            $discount = 0;

            if ($code === '') {
                $_SESSION['flash_message'] = "Vui lòng nhập mã giảm giá!";
                header("Location: /coffee/cart/index");
                exit;
            }

            $stmt = $this->conn->prepare("
    SELECT ma, phan_tram_giam, giam_toi_da 
    FROM magiamgia 
    WHERE ma = ? 
      AND trang_thai = 1 
      AND ngay_bat_dau <= CURDATE() 
      AND ngay_ket_thuc >= CURDATE() 
      AND (so_luong - da_su_dung) > 0
    LIMIT 1
    ");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($ma, $phan_tram_giam, $giam_toi_da);
        $stmt->fetch();

        // Tính tổng tiền
        $cartTotal = 0;
        foreach($_SESSION['cart'] as $item){
            $cartTotal += $item['price'] * $item['quantity'];
        }

        if(!empty($phan_tram_giam)){
            $discount = $cartTotal * ($phan_tram_giam/100);
            if(!empty($giam_toi_da) && $discount > $giam_toi_da){
                $discount = $giam_toi_da;
            }
        } elseif(!empty($giam_toi_da)){
            $discount = $giam_toi_da;
        }

        $_SESSION['applied_discount'] = $discount;
        $_SESSION['applied_code'] = $ma;
        $_SESSION['flash_message'] = "Áp dụng mã giảm giá thành công!";
    } else {
        $_SESSION['flash_message'] = "Mã giảm giá không hợp lệ hoặc đã hết hạn!";
        unset($_SESSION['applied_discount'], $_SESSION['applied_code']);
    }

            }

            header("Location: /coffee/cart/index");
            exit;
        }
}
