<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Chỉnh sửa người dùng #<?= $user['id_user'] ?></title>
</head>
<body>
<h2>Chỉnh sửa người dùng #<?= $user['id_user'] ?></h2>

<form method="post" action="/jewelry/admin/users/update">
    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
    <p>
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    </p>
    <p>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </p>
    <p>
        <label for="loai_nguoi_dung">Loại người dùng:</label><br>
        <select id="loai_nguoi_dung" name="loai_nguoi_dung" required>
            <option value="khachhang" <?= $user['loai_nguoi_dung'] == 'Khách hàng' ? 'selected' : '' ?>>Khách hàng</option>
            <option value="admin" <?= $user['loai_nguoi_dung'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
        </select>
    </p>
    <button type="submit">Cập nhật</button>
</form>

<p><a href="/jewelry/admin/users/index">Quay lại danh sách người dùng</a></p>
</body>
</html>
