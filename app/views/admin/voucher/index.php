<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Quản lý mã giảm giá</title>
    <style>
        table {width: 100%; border-collapse: collapse;}
        th, td {border: 1px solid #ccc; padding: 8px; text-align: center;}
        th {background: #eee;}
        a.button {
            padding: 5px 10px; background: #090909ff; color: white;
            text-decoration: none; border-radius: 4px; text-align:right;
        }
        a.button.delete {background: #dc3545;}
        .status-active {color: green; font-weight: bold;}
        .status-inactive {color: red; font-weight: bold;}
        h2 {text-align: center;}
    </style>
</head>
<body>
<h2>Quản Lý Mã Giảm Giá</h2>
<p><a href="/jewelry/admin/voucher/create" class="button">Thêm mã giảm giá mới</a></p>
 <a href="/jewelry/admin/admindashboard" class="button">Quay về</a>
<table>
    <tr>
        <th>ID</th>
        <th>Mã</th>
        <th>Phần trăm giảm</th>
        <th>Giảm tối đa</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Số lượng</th>
        <th>Đã sử dụng</th>
        <th>Điều kiện</th>
        <th>Trạng thái</th>
        <th>Thao tác</th>
    </tr>
    <?php if (!empty($list)): ?>
        <?php foreach ($list as $item): ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= htmlspecialchars($item['ma']) ?></td>
            <td><?= $item['phan_tram_giam'] ?>%</td>
            <td><?= number_format($item['giam_toi_da'], 0, ',', '.') ?> đ</td>
            <td><?= $item['ngay_bat_dau'] ?></td>
            <td><?= $item['ngay_ket_thuc'] ?></td>
            <td><?= $item['so_luong'] ?></td>
            <td><?= $item['da_su_dung'] ?></td>
            <td><?= number_format($item['dieukien'], 0, ',', '.') ?> đ</td>
            <td>
                <?php if ($item['trang_thai'] == 1): ?>
                    <span class="status-active">Hoạt động</span>
                <?php else: ?>
                    <span class="status-inactive">Ngừng</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="/jewelry/admin/voucher/edit/<?= $item['id'] ?>" class="button">Sửa</a>
                <a href="/jewelry/admin/voucher/delete/<?= $item['id'] ?>" 
                   onclick="return confirm('Bạn có chắc muốn xóa mã giảm giá này?')" 
                   class="button delete">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="11">Chưa có voucher nào.</td></tr>
    <?php endif; ?>
</table>
</body>
</html>