<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <style>
        .product-list { display: flex; flex-wrap: wrap; gap: 15px; }
        .product { border: 1px solid #ccc; padding: 15px; width: 200px; }
        .product img { width: 100%; height: auto; }
        .product h3 { margin: 10px 0; }
        .product p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>
    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <a href="/product/detail/<?= $product['id'] ?>">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                </a>
                <p>Giá: <?= number_format($product['price']) ?> VND</p>
                <form action="/cart/addToCart" method="post">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
                    <input type="hidden" name="price" value="<?= $product['price'] ?>">
                    <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']) ?>">
                    <input type="text" name="note" placeholder="Ghi chú (nếu có)">
                    <button class="add-to-cart" 
                        data-id="<?= $product['id'] ?>" 
                        data-name="<?= $product['name'] ?>" 
                        data-price="<?= $product['price'] ?>" 
                        data-image="<?= $product['image'] ?>">
                        Thêm vào giỏ
                    </button>

                </form>
            </div>
        <?php endforeach; ?>
    </div>
<script src="/jewelry/public/js/cart.js"></script>
</body>
</html>
