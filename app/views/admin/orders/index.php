<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Quản Lý Người Dùng</title>
    <style>
        h2{text-align: center;}
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #eee; }
        a.button { padding: 5px 10px; background: #060606ff; color: white; text-decoration: none; border-radius: 4px; }
        a.button.delete { background: #dc3545; }
    </style>
</head>
<body>
<h2>Quản Lý Đơn hàng</h2>
<p><a href="/coffee/admin/admindashboard" class="button">Quay lại</a></p>
<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Phí vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Thanh toán</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id_order'] ?></td>
            <td><?= htmlspecialchars($order['id_user'])?></td>
            <td><?= number_format($order['tongtien']) ?> đ</td>
            <td><?= number_format($order['phivanchuyen']) ?> đ</td>
            <td><?= htmlspecialchars($order['diachi']) ?></td>
            <td><?= htmlspecialchars($order['thanhtoan']) ?></td>
            <td><?= htmlspecialchars($order['ngaydat']) ?></td>
            <td><?= htmlspecialchars($order['trangthai']) ?></td>
            <td>
                  <a href="/coffee/admin/orders/view/<?= $order['id_order'] ?>" class="button">Xem</a> |
                <a href="/coffee/admin/orders/delete/<?= $order['id_order'] ?>" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')" class="button delete">Xóa</a>
        </td>    
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="9">Chưa có đơn hàng nào.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
