<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
</head>
<body>
    <h1><?= htmlspecialchars($product['name']) ?></h1>
    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="max-width:300px;">
    <p>Giá: <?= number_format($product['price']) ?> VND</p>
    <p>Mô tả: <?= nl2br(htmlspecialchars($product['description'] ?? 'Chưa có mô tả')) ?></p>

    <form action="/cart/add" method="post">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
        <input type="hidden" name="price" value="<?= $product['price'] ?>">
        <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']) ?>">
        <input type="text" name="note" placeholder="Ghi chú (nếu có)">
        <button type="submit">Thêm vào giỏ</button>
    </form>

    <p><a href="/product/index">Quay lại danh sách sản phẩm</a></p>
</body>
</html>
