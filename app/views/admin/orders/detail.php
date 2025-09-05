<h1>Chi tiết đơn hàng #<?= htmlspecialchars($order['id_order']) ?></h1>
<p><strong>Người dùng:</strong> <?= htmlspecialchars($order['id_user']) ?></p>
<p><strong>Tổng tiền:</strong> <?= number_format($order['tongtien']) ?> VNĐ</p>
<p><strong>Phí vận chuyển:</strong> <?= number_format($order['phivanchuyen']) ?> VNĐ</p>
<p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['diachi']) ?></p>
<p><strong>Thanh toán:</strong> <?= htmlspecialchars($order['thanhtoan']) ?></p>
<p><strong>Ngày đặt:</strong> <?= htmlspecialchars($order['ngaydat']) ?></p>
<p><strong>Trạng thái:</strong> <?= htmlspecialchars($order['trangthai']) ?></p>

<h3>Cập nhật trạng thái đơn hàng</h3>
<form method="post" action="/admin/order/updateStatus/<?= $order['id_order'] ?>">
    <select name="status">
        <option value="Chờ xử lý" <?= $order['trangthai'] == 'Chờ xử lý' ? 'selected' : '' ?>>Chờ xử lý</option>
        <option value="Đang giao" <?= $order['trangthai'] == 'Đang giao' ? 'selected' : '' ?>>Đang giao</option>
        <option value="Đã giao" <?= $order['trangthai'] == 'Đã giao' ? 'selected' : '' ?>>Đã giao</option>
        <option value="Đã hủy" <?= $order['trangthai'] == 'Đã hủy' ? 'selected' : '' ?>>Đã hủy</option>
    </select>
    <button type="submit">Cập nhật</button>
</form>
