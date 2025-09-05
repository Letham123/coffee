<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tài khoản của tôi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; padding: 80px 20px 20px 20px; }
        .container { display: flex; flex-wrap: wrap; justify-content: center; gap: 50px; margin-top: 20px; }
        .box, .box-cart { border: 1px solid #ccc; padding: 20px; border-radius: 10px; font-size: 15px; }
        .box { flex: 0 0 400px; margin-left: 10px; }
        .box-cart { flex: 1; min-width: 500px; margin-right: 10px; }
        .box h2, .box h3, .box-cart h2, .box-cart h3 { text-align: center; margin-bottom: 15px; }
        .box p { font-size: 16px; }
        .btn { display: inline-block; padding: 10px 20px; background: black; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 10px; }
        .btn-update { background: black; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background: #f5f5f5; }
        .profile-header { display: flex; justify-content: center; align-items: center; font-size: 28px; font-weight: bold; margin: 120px 0 30px 0; }
        .profile-header i { margin-right: 10px; color: #333; }
        hr { border: none; height: 2px; background: #ddd; margin: 15px 0; }
        label { display: block; margin: 10px 0 5px; }
        input[type="password"] { width: 100%; padding: 8px 10px; font-size: 14px; border-radius: 4px; border: 1px solid #ccc; }
        .error { color: red; font-size: 14px; }
        .success { color: green; font-size: 14px; }
    </style>
</head>
<body>

<div class="container">
    <div class="box">
        <h3>Đổi mật khẩu</h3>
        <?php if(isset($changePasswordMessage)): ?>
            <p class="<?= $changePasswordMessage['type'] ?>"><?= htmlspecialchars($changePasswordMessage['text']) ?></p>
        <?php endif; ?>
        <form action="/coffee/account/changePassword" method="post">
            <label for="current_password">Mật khẩu hiện tại</label>
            <input type="password" name="current_password" id="current_password" required>

            <label for="new_password">Mật khẩu mới</label>
            <input type="password" name="new_password" id="new_password" required>

            <label for="confirm_password">Xác nhận mật khẩu mới</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <button type="submit" class="btn btn-update">Cập nhật mật khẩu</button>
        </form>
        </div>
    <div class="box">
        <h3><i class="fas fa-user"></i> Thông tin cá nhân</h3>
        <hr>
        <p><b>Tên:</b> <?= htmlspecialchars($userInfo['username']) ?></p>
        <p><b>Email:</b> <?= htmlspecialchars($userInfo['email']) ?></p>
        <p><b>Mã khách hàng:</b> <?= htmlspecialchars($userInfo['id_user']) ?></p>
        <a href="/coffee/home/index" class="btn">Đăng xuất</a>
    </div>
    <div class="box-cart">
        <h3><i class="fas fa-cart-shopping" style="color: black;"></i> Đơn hàng đã mua</h3>
        <hr>
        <?php if (!empty($orders)): ?>
            <table>
                <tr>
                    <th>Mã đơn</th>
                    <th>Ngày đặt</th>
                    <th>Địa chỉ</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['id_order']) ?></td>
                    <td><?= htmlspecialchars($order['ngaydat']) ?></td>
                    <td><?= htmlspecialchars($order['diachi']) ?></td>
                    <td><?= number_format($order['tongtien']) ?> VND</td>
                    <td><?= htmlspecialchars($order['trangthai']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Bạn chưa có đơn hàng nào.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
