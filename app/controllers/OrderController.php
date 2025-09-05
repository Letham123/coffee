<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;

class OrderController {

    // Hiển thị form nhập thông tin giao hàng
    public function placeOrder() {
        session_start();
        if (!isset($_SESSION['id_user']) || !isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
            header('Location: /coffee/cart/index');
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
            header("Location: /coffee/user/login");
            exit;
        }

        $diachi = $_POST['diachi'] ?? '';
        $sdt = $_POST['sdt'] ?? '';
        $thanhtoan = $_POST['thanhtoan'] ?? 'COD';
        $ghichu_donhang = $_POST['ghichu_donhang'] ?? '';
        $cart = $_SESSION['cart'] ?? [];
        $appliedCode = $_SESSION['applied_code'] ?? '';
        $discountAmount = $_SESSION['applied_discount'] ?? 0;

        if (empty($diachi) || empty($sdt) || empty($cart)) {
            $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin và có sản phẩm trong giỏ hàng.";
            header("Location: /coffee/order/placeOrder");
            exit;
        }

        $phivanchuyen = 30000;
        $tongtien_sp = 0;
        foreach ($cart as $item) {
            $tongtien_sp += $item['price'] * $item['quantity'];
        }

        $tongtien = $tongtien_sp + $phivanchuyen - $discountAmount;
        $trangthai = 1;
        $ngaydat = date("Y-m-d H:i:s");

        // --- Thêm vào donhang ---
        $stmt = $conn->prepare("
            INSERT INTO donhang 
            (id_user, ngaydat, tongtien, trangthai, diachi, sdt, phivanchuyen, thanhtoan, ghichu, magiamgia, giamgia) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        if(!$stmt) die("Lỗi prepare donhang: " . $conn->error);
        $stmt->bind_param(
            "isdisdssssd", 
            $id_user, $ngaydat, $tongtien, $trangthai, $diachi, $sdt, $phivanchuyen, $thanhtoan, $ghichu_donhang, $appliedCode, $discountAmount
        );
        if (!$stmt->execute()) die("Lỗi execute donhang: " . $stmt->error);
        $id_order = $stmt->insert_id;
        $stmt->close();

        // --- Thêm chi tiết đơn hàng ---
        $stmt_detail = $conn->prepare("
            INSERT INTO chitietdonhang 
            (id_order, id_product, gia, soluong, tongtien, ghichu) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        if(!$stmt_detail) die("Lỗi prepare chitietdonhang: " . $conn->error);

        foreach ($cart as $item) {
            $id_product = $item['id'];
            $gia = $item['price'];
            $soluong = $item['quantity'];
            $tongtien_ct = $gia * $soluong;
            $ghichu_ct = $ghichu_donhang;
            $stmt_detail->bind_param("iiidis", $id_order, $id_product, $gia, $soluong, $tongtien_ct, $ghichu_ct);
            $stmt_detail->execute();
        }
        $stmt_detail->close();

        // --- Cập nhật số lần đã sử dụng mã giảm giá ---
        if ($appliedCode) {
            $stmt_update = $conn->prepare("UPDATE magiamgia SET da_su_dung = da_su_dung + 1 WHERE ma = ?");
            $stmt_update->bind_param("s", $appliedCode);
            $stmt_update->execute();
            $stmt_update->close();
        }

        // --- Xóa giỏ hàng và giảm giá khỏi session ---
        unset($_SESSION['cart'], $_SESSION['applied_discount'], $_SESSION['applied_code']);

        $_SESSION['success'] = "Đặt hàng thành công!";
        header("Location: /coffee/order/success");
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
            header('Location: /coffee/user/login');
            exit;
        }

        $id_user = $_SESSION['id_user'];
        $orders = Order::getByUserId($id_user);

        require_once ROOT_PATH . '/app/views/order/history.php';
    }
}
