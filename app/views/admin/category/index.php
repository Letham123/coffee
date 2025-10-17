
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Danh Mục Sản Phẩm</title>
    <style>
        h2 { text-align: center; } 
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #eee; }
        a.button { padding: 5px 10px; background: #070707ff; color: white; text-decoration: none; border-radius: 4px; }
        a.button.delete { background: #dc3545; }
    </style>
</head>
<body>
    
<h2>Quản Lý Danh Mục Sản Phẩm</h2>

<p><a href="/jewelry/admin/category/create" class="button">Thêm danh mục mới</a></p>
<p><a href="/jewelry/admin/admindashboard" class="button">Quay lại</a></p>
<table>
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach($categories as $category): ?>
    <tr>
        <td><?= $category['id_category'] ?></td>
        <td><?= htmlspecialchars($category['name_category']) ?></td>
        <td>
            <a href="/jewelry/admin/category/edit/<?= $category['id_category'] ?>" class="button">Sửa</a> |
            <a href="/jewelry/admin/category/delete/<?= $category['id_category'] ?>" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')" class="button delete">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
