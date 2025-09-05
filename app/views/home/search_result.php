<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/coffee/public/css/style.css" />

    <style>
        .coffee {
            padding: 40px 20px;
        }
        .coffee .heading {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
        }
        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .box {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            width: 260px;
            text-align: center;
            transition: 0.3s;
        }
        .box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .box h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .price {
            font-size: 16px;
            color: #0c0c0cff;
        }
        .price span {
            text-decoration: line-through;
            font-size: 14px;
            color: #fcfbfbff;
            margin-left: 5px;
        }
        .btn {
            margin-top: 10px;
            background: #050505ff;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn:hover {
            background: #0f0e0eff;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Kết quả tìm kiếm</h1>

<?php if (!empty($products)): ?>
    <div class="box-container">
        <?php foreach ($products as $row): ?>
            <div class="box">
                <img src="/coffee/public/images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                <h3><?= htmlspecialchars($row['name']) ?></h3>
                <div class="price">
                    <?= number_format($row['price']) ?> VND 
                </div>
                <form method="POST" action="/coffee/cart/add">
                    <input type="hidden" name="id" value="<?= $row['id_product'] ?>">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']) ?>">
                     <input type="hidden" name="price" value="<?= $product['price'] ?>">
                    <input type="hidden" name="image" value="<?= htmlspecialchars($row['image']) ?>">
                    <button type="submit" class="btn">Thêm vào giỏ hàng</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Không tìm thấy sản phẩm nào phù hợp.</p>
<?php endif; ?>

</body>
</html>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
