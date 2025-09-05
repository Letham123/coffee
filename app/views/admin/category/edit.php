
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Danh Mục</title>
    <style>
        label { display: block; margin-top: 10px; }
        input[type="text"] { width: 300px; padding: 5px; }
        button { padding: 5px 10px; margin-top: 10px; }
    </style>
</head>
<body>
<h2>Sửa Danh Mục #<?= $category['id_category'] ?></h2>
<p><a href="/coffee/admin/category/index">← Quay lại danh sách danh mục</a></p>

<form method="post" action="/coffee/admin/category/edit/<?= $category['id_category'] ?>">
    <label for="ten_danhmuc">Tên danh mục:</label>
    <input type="text" id="ten_danhmuc" name="ten_danhmuc" value="<?= htmlspecialchars($category['ten_danhmuc']) ?>" required>

    <button type="submit">Cập nhật danh mục</button>
</form>
</body>
</html>
