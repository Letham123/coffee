<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Thêm Sản phẩm mới</title>
</head>
<body>
<h2>Thêm Sản phẩm mới</h2>

<form method="post" action="/admin/products/create">
    <p>
        <label for="name">Tên sản phẩm:</label><br>
        <input type="text" id="name" name="name" required>
    </p>
    <p>
        <label for="price">Giá :</label><br>
        <input type="number" id="price" name="price" required>
    </p>
    <p>
        <label for="image">URL ảnh:</label><br>
        <input type="file" id="image" name="image" required>
    </p>
     <p>
        <label for="id_category">Danh mục:</label><br>
        <select id="id_category" name="id_category" required>
            <option value="">-- Chọn danh mục --</option>
            <?php foreach($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['ten_danhmuc']) ?>">
                    <?= htmlspecialchars($category['ten_danhmuc']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" rows="4"></textarea>
    </p>
    <button type="submit">Thêm sản phẩm</button>
</form>

<p><a href="/coffee/admin/products/index">Quay lại danh sách sản phẩm</a></p>
</body>
</html>
