<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Sửa mã giảm giá #<?= htmlspecialchars($voucher['id']) ?></title>
    <style>
        body {font-family: Arial, sans-serif; padding: 20px;}
        label {font-weight: bold;}
        input[type="text"], input[type="number"], input[type="date"] {
            width: 300px; padding: 8px; margin-top: 5px;
            border: 1px solid #ccc; border-radius: 4px;
        }
        p {margin-bottom: 15px;}
        button {
            padding: 10px 15px; background-color: #28a745; color: white;
            border: none; border-radius: 4px; cursor: pointer;
        }
        button:hover {background-color: #218838;}
    </style>
</head>
<body>
<h2>Sửa mã giảm giá #<?= htmlspecialchars($voucher['id']) ?></h2>

<form method="post" action="/coffee/admin/voucher/edit/<?= $voucher['id'] ?>">
    <p>
        <label for="ma">Mã giảm giá:</label><br>
        <input type="text" id="ma" name="ma" value="<?= htmlspecialchars($voucher['ma']) ?>" required>
    </p>
    <p>
        <label for="phan_tram_giam">Phần trăm giảm:</label><br>
        <input type="number" step="0.01" id="phan_tram_giam" name="phan_tram_giam" value="<?= htmlspecialchars($voucher['phan_tram_giam']) ?>" required min="0" max="100">
    </p>
    <p>
        <label for="ngay_bat_dau">Ngày bắt đầu:</label><br>
        <input type="date" id="ngay_bat_dau" name="ngay_bat_dau" value="<?= htmlspecialchars($voucher['ngay_bat_dau']) ?>" required>
    </p>
    <p>
        <label for="ngay_ket_thuc">Ngày kết thúc:</label><br>
        <input type="date" id="ngay_ket_thuc" name="ngay_ket_thuc" value="<?= htmlspecialchars($voucher['ngay_ket_thuc']) ?>" required>
    </p>
    <p>
    <label for="dieukien">Điều kiện áp dụng:</label><br>
    <input type="text" id="dieukien" name="dieukien"
           value="<?= isset($voucher['dieukien']) ? htmlspecialchars($voucher['dieukien']) : '' ?>">
    </p>
    <p>
        <button type="submit">Cập nhật</button>
        <a href="/coffee/admin/voucher/index" style="margin-left: 15px;">Hủy</a>
    </p>
</form>

</body>
</html>
