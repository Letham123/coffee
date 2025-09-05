<h2 style="text-align: center;">Danh Sách Phản Hồi Khách Hàng</h2>
<p>
    <a href="/coffee/admin/admindashboard" style="background-color: black; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px;">Quay lại</a>
</p>
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">

    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Nội dung</th>
            <th>Ngày gửi</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($contacts)): ?>
            <?php foreach($contacts as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= $c['name'] ?></td>
                    <td><?= $c['email'] ?></td>
                    <td><?= $c['sdt'] ?></td>
                    <td><?= $c['noidung'] ?></td>
                    <td><?= $c['ngaygui'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Chưa có phản hồi nào</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<style>
    th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #eee; }
    </style>