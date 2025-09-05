<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Quản Lý Người Dùng</title>
    <style>
        h2{text-align:center;}
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #eee; }
        a.button { padding: 5px 10px; background: #0c0c0cff; color: white; text-decoration: none; border-radius: 4px; }
        a.button.delete { background: #dc3545; }
    </style>
</head>
<body>
<h2>Quản Lý Người Dùng</h2>
<p><a href="/coffee/admin/admindashboard" class="button">Quay lại</a></p>
<table>
    <tr>
        <th>ID</th>
        <th>Tên đăng nhập</th>
        <th>Email</th>
        <th>Loại người dùng</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach($users as $user): ?>
    <tr>
        <td><?= htmlspecialchars($user['id_user']) ?></td>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= htmlspecialchars($user['loai_nguoi_dung']) ?></td>
        <td>
            <a href="/coffee/admin/users/detail/<?= $user['id_user'] ?>" class="button">Sửa</a>
            <a href="/coffee/admin/users/delete/<?= $user['id_user'] ?>" onclick="return confirm('Bạn có chắc muốn xóa khách hàng này?')" class="button delete">Xóa</a>
        </td>
    </tr>
    
    <?php endforeach; ?>
</table>
</body>
</html>
