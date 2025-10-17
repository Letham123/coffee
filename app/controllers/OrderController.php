<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;

class OrderController {

    // Hiển thị form nhập thông tin giao hàng
    public function placeOrder() {
        session_start();
        if (!isset($_SESSION['id_user']) || !isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
            header('Location: /jewelry/cart/index');
            exit;
        }
        require_once ROOT_PATH . '/app/views/order/form.php';
    }

    // Xử lý submit form
    public function submit() {
        session_start();
        require_once ROOT_PATH . '/config/database.php';
        global $conn;

        $id_user = $_SESSION['id_user'] ?? null;
        if (!$id_user) {
            $_SESSION['error'] = "Bạn cần đăng nhập để đặt hàng.";
            header("Location: /jewelry/user/login");
            exit;
        }

        $adress = $_POST['adress'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $payment = $_POST['payment'] ?? 'COD';
        $note = $_POST['note'] ?? '';
        $cart = $_SESSION['cart'] ?? [];
        $appliedCode = $_SESSION['applied_code'] ?? '';
        $discountAmount = $_SESSION['applied_discount'] ?? 0;

        if (empty($adress) || empty($sdt) || empty($cart)) {
            $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin và có sản phẩm trong giỏ hàng.";
            header("Location: /jewelry/order/placeOrder");
            exit;
        }

        $fee_ship = 30000;
        $tongtien_sp = 0;
        foreach ($cart as $item) {
            $tongtien_sp += $item['price'] * $item['quantity'];
        }

        $total = $tongtien_sp + $fee_ship - $discountAmount;
        $trangthai = 1;
        $order_date = date("Y-m-d H:i:s");

        // --- Thêm vào donhang ---
        $stmt = $conn->prepare("
            INSERT INTO orders 
            (id_user, order_date, total, status, adress, phone, fee_ship, payment, note, iddiscount, discount) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        if(!$stmt) die("Lỗi prepare donhang: " . $conn->error);
        $stmt->bind_param(
            "isdisdssssd", 
            $id_user, $order_date, $total, $status, $adress, $phone, $fee_ship, $payment, $note, $appliedCode, $discountAmount
        );
        if (!$stmt->execute()) die("Lỗi execute donhang: " . $stmt->error);
        $id_order = $stmt->insert_id;
        $stmt->close();

        // --- Thêm chi tiết đơn hàng ---
        $stmt_detail = $conn->prepare("
            INSERT INTO order_detail 
            (id_order, id_product, price, quantity, total, note) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        if(!$stmt_detail) die("Lỗi prepare order_detail: " . $conn->error);

        foreach ($cart as $item) {
            $id_product = $item['id'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            $total = $price * $quantity;
            $note = $note;
            $stmt_detail->bind_param("iiidis", $id_order, $id_product, $price, $quantity, $total, $note);
            $stmt_detail->execute();
        }
        $stmt_detail->close();

        // --- Cập nhật số lần đã sử dụng mã giảm giá ---
        if ($appliedCode) {
            $stmt_update = $conn->prepare("UPDATE discount SET Used_times = Used_times + 1 WHERE id = ?");
            $stmt_update->bind_param("s", $appliedCode);
            $stmt_update->execute();
            $stmt_update->close();
        }

        // --- Xóa giỏ hàng và giảm giá khỏi session ---
        unset($_SESSION['cart'], $_SESSION['applied_discount'], $_SESSION['applied_code']);

        $_SESSION['success'] = "Đặt hàng thành công!";
        header("Location: /jewelry/order/success");
        exit;
    }

    // Hiển thị trang thành công
    public function success() {
        require_once ROOT_PATH . '/app/views/order/success.php';
    }

    // Lịch sử đơn hàng
    public function history() {
        session_start();
        if (!isset($_SESSION['id_user'])) {
            header('Location: /jewelry/user/login');
            exit;
        }

        $id_user = $_SESSION['id_user'];
        $orders = Order::getByUserId($id_user);

        require_once ROOT_PATH . '/app/views/order/history.php';
    }
}
