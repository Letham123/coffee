
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Danh Mục Mới</title>
    <style>
        label { display: block; margin-top: 10px; }
        input[type="text"] { width: 300px; padding: 5px; }
        button { padding: 5px 10px; margin-top: 10px; }
    </style>
</head>
<body>
<h2>Thêm Danh Mục Mới</h2>
<p><a href="/jewelry/admin/category/index">← Quay lại danh sách danh mục</a></p>

<form method="post" action="/jewelry/admin/category/create">
    <label for="name_category">Tên danh mục:</label>
    <input type="text" id="name_category" name="name_category" required>

    <button type="submit">Thêm danh mục</button>
</form>
</body>
</html>
