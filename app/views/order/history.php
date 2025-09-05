<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lịch sử đơn hàng</title>
    <style>
        body {font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto;}
        h2 {color: #333;}
        .order-item {padding: 10px; border-bottom: 1px solid #ccc;}
        .order-item:last-child {border-bottom: none;}
    </style>
</head>
<body>

<h2>Đơn hàng đã mua</h2>

<?php if(empty($orders)): ?>
    <p>Bạn chưa có đơn hàng nào.</p>
<?php else: ?>
    <?php foreach($orders as $order): ?>
        <div class="order-item">
            Mã đơn: <?= htmlspecialchars($order['id_order']) ?> |
            Tổng tiền: <?= number_format($order['tongtien']) ?> VND |
            Trạng thái: <?= htmlspecialchars($order['trangthai']) ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<br>
<a href="/home/index">Quay về trang chủ</a>

</body>
</html>
