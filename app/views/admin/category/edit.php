
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
<p><a href="/jewelry/admin/category/index">← Quay lại danh sách danh mục</a></p>

<form method="post" action="/jewelry/admin/category/edit/<?= $category['id_category'] ?>">
    <label for="name_category">Tên danh mục:</label>
    <input type="text" id="name_category" name="name_category" value="<?= htmlspecialchars($category['name_category']) ?>" required>

    <button type="submit">Cập nhật danh mục</button>
</form>
</body>
</html>
