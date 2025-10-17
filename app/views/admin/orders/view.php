<h2>Chi tiết đơn hàng #<?= $order['id_order'] ?></h2>

<p><b>Khách hàng:</b> <?= htmlspecialchars($order['id_user']) ?></p>
<p><b>Địa chỉ giao hàng:</b> <?= htmlspecialchars($order['adress']) ?></p>
<p><b>Phương thức thanh toán:</b> <?= htmlspecialchars($order['thanhtoan']) ?></p>
<p><b>Ngày đặt:</b> <?= htmlspecialchars($order['order_date']) ?></p>
<p><b>Trạng thái:</b> <?= htmlspecialchars($order['status']) ?></p>

<h3>Cập nhật trạng thái</h3>
<form method="post" action="/jewelry/admin/orders/updateStatus/<?= $order['id_order'] ?>">
    <select name="status" required>
        <?php 
            $statusOptions = ['Chờ xử lý', 'Đang giao', 'Đã giao', 'Đã hủy'];
            foreach ($statusOptions as $st) {
                $selected = $order['status'] === $st ? 'selected' : '';
                echo "<option value=\"$st\" $selected>$st</option>";
            }
        ?>
    </select>
    <button type="submit">Cập nhật</button>
    <a href="/jewelry/admin/orders/index" class="btn-back">Quay lại</a>
</form>
