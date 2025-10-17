<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php
$cart = $_SESSION['cart'] ?? [];
$discountAmount = $_SESSION['applied_discount'] ?? 0;
$appliedCode = $_SESSION['applied_code'] ?? '';
$fee_ship = 30000;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="/jewelry/public/css/style.css">
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; font-size: 32px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 16px; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
        img { width: 60px; }
        .quantity-btn { padding: 6px 12px; font-size: 16px; border-radius: 4px; border: 1px solid #ccc; background: #f0f0f0; cursor: pointer; }
        .quantity-display { padding: 0 10px; font-size: 16px; }
        .discount-section { margin-bottom: 25px; text-align: right; }
        .cart-actions { text-align: right; margin-top: 20px; }
        a.button, button.button { padding: 12px 25px; font-size: 18px; font-weight: bold; border-radius: 5px; text-decoration: none; display: inline-block; cursor: pointer; margin: 5px; }
        a.button.black, button.button.black { background: black; color: white; border: none; }
        a.button.red, button.button.red { background: red; color: white; border: none; }
        .summary-table { width: 350px; margin: 20px 0 30px auto; border: none; font-size: 18px; font-weight: bold; }
        .summary-table td { border: none; padding: 6px 10px; }
        .summary-table td:first-child { text-align: left; }
        .summary-table td:last-child { text-align: right; }
        .discount-line { color: green; }
    </style>
</head>
<body>

<h1>Giỏ hàng</h1>

<?php if (empty($cart)): ?>
    <p style="text-align:center; font-size:18px;">Chưa có sản phẩm nào.</p>
    <div style="text-align:center;">
        <a href="/jewelry" class="button black">Quay về trang chủ</a>
    </div>
<?php else: ?>
    <?php $tongtien = 0; ?>
    <table>
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($cart as $item): ?>
            <?php 
                $price = (float)$item['price'];
                $quantity = (int)$item['quantity'];
                $thanhtien = $price * $quantity;
                $tongtien += $thanhtien;
            ?>
            <tr>
                <td><img src="/jewelry/public/images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= number_format($price) ?> VND</td>
                <td>
                    <form action="/jewelry/cart/updateQuantity" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" name="action" value="decrease" class="quantity-btn">-</button>
                    </form>
                    <span class="quantity-display"><?= $quantity ?></span>
                    <form action="/jewelry/cart/updateQuantity" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" name="action" value="increase" class="quantity-btn">+</button>
                    </form>
                </td>
                <td><?= number_format($thanhtien) ?> VND</td>
                <td>
                    <a href="#" class="delete-item" data-id="<?= $item['id'] ?>" style="color:red; font-weight:bold;">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Mã giảm giá -->
    <div class="discount-section">
        <form action="/jewelry/cart/applyDiscount" method="post" style="display:inline-block;">
            <input type="text" name="discount_code" id="discount_code" placeholder="Nhập mã giảm giá..." value="<?= htmlspecialchars($appliedCode) ?>">
            <button type="submit" class="button black">Áp dụng</button>
        </form>
    </div>

    <?php $tongthanhtoan = $tongtien + $fee_ship - $discountAmount; ?>
    <table class="summary-table">
        <tr>
            <td>Tổng tiền:</td>
            <td><?= number_format($tongtien) ?> VND</td>
        </tr>
        <tr>
            <td>Phí vận chuyển:</td>
            <td><?= number_format($fee_ship) ?> VND</td>
        </tr>
        <?php if($discountAmount > 0): ?>
        <tr class="discount-line">
            <td>Giảm giá (<?= htmlspecialchars($appliedCode) ?>):</td>
            <td>-<?= number_format($discountAmount) ?> VND</td>
        </tr>
        <?php endif; ?>
        <tr>
            <td><strong>Thanh toán:</strong></td>
            <td><strong><?= number_format($tongthanhtoan) ?> VND</strong></td>
        </tr>
    </table>

    <div class="cart-actions">
        <a href="#" id="clear-cart" class="button red">Xóa toàn bộ giỏ hàng</a>
        <a href="/jewelry/order/placeOrder" class="button black">Đặt hàng</a>
    </div>
<?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Xóa từng sản phẩm
    document.querySelectorAll('.delete-item').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            if(confirm('Bạn có chắc muốn xóa sản phẩm này không?')) {
                fetch('/jewelry/cart/remove', {
                    method: 'POST',
                    headers: {'Content-Type':'application/x-www-form-urlencoded'},
                    body: 'id=' + encodeURIComponent(id)
                })
                .then(res => res.text())
                .then(data => location.reload())
                .catch(err => console.error(err));
            }
        });
    });

    // Xóa toàn bộ giỏ hàng
    const clearCartBtn = document.getElementById('clear-cart');
    if(clearCartBtn) {
        clearCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if(confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng không?')) {
                fetch('/jewelry/cart/remove', {
                    method: 'POST',
                    headers: {'Content-Type':'application/x-www-form-urlencoded'},
                    body: 'all=1'
                })
                .then(res => res.text())
                .then(data => location.reload())
                .catch(err => console.error(err));
            }
        });
    }
});
</script>

</body>
</html>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
