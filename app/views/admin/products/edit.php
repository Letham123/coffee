<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Sửa Sản phẩm #<?= $product['id_product'] ?></title>
</head>
<body>
<h2>Sửa Sản phẩm #<?= $product['id_product'] ?></h2>

<form method="post" action="/jewelry/admin/products/edit/<?= $product['id_product'] ?>">
    <p>
        <label for="name">Tên sản phẩm:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    </p>
    <p>
    <label for="price">Giá :</label><br>
    <input type="number" id="price" name="price" 
           value="<?= htmlspecialchars($product['price']) ?>" required>
    </p>
    <p>
        <label for="image">Chọn ảnh:</label><br>
        <input type="file" id="image" name="image" accept="image/*">
    </p>
    <p>
    <label for="id_category">Danh mục:</label>
    <select id="id_category" name="id_category">
        <option value="">-- Chọn danh mục --</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id_category'] ?>" 
                <?= (isset($product['id_category']) && $product['id_category'] == $category['id_category']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($category['ten_danhmuc']) ?>
            </option>
        <?php endforeach; ?>
        </select>
        </p>
    <p>
        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
    </p>
    <button type="submit">Cập nhật sản phẩm</button>
</form>

<p><a href="/jewelry/admin/products/index">Quay lại danh sách sản phẩm</a></p>
</body>
</html>
