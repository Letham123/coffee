<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Quản lý Sản phẩm</title>
    <style>
        h2{text-align:center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #eee; }
        a.button { padding: 5px 10px; background: #030303ff; color: white; text-decoration: none; border-radius: 4px; gap:5px }
        a.button.delete { background: #dc3545; }
        img { max-width: 100px; }
    </style>
</head>
<body>
<h2>Quản Lý Sản Phẩm</h2>
<p><a href="/jewelry/admin/products/create" class="button">Thêm sản phẩm mới</a></p>
<a href="/jewelry/admin/admindashboard" class="button">Quay lại</a>
<table>
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Ảnh</th>
        <th>Giá</th>
        <th>Loại sản phẩm</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= htmlspecialchars($product['id_product']) ?></td>
        <td><?= htmlspecialchars($product['name']) ?></td>
        <td><img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"></td>
        <td><?= number_format($product['price']) ?> VND</td>
        <td><?= htmlspecialchars($product['ten_danhmuc']) ?></td>
        <td>
            <a href="/jewelry/admin/products/edit/<?= $product['id_product'] ?>" class="button">Sửa</a>
            <a href="/jewelry/admin/products/delete/<?= $product['id_product'] ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="button delete">Xóa</a>
        </td>
        
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
