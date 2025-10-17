<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Thêm mã giảm giá mới</title>
    <style>
        body {font-family: Arial, sans-serif; padding: 20px;}
        label {font-weight: bold;}
        input[type="text"], input[type="number"], input[type="date"], select {
            width: 300px; padding: 8px; margin-top: 5px;
            border: 1px solid #ccc; border-radius: 4px;
        }
        p {margin-bottom: 15px;}
        button {
            padding: 10px 15px; background-color: #007bff; color: white;
            border: none; border-radius: 4px; cursor: pointer;
        }
        button:hover {background-color: #0056b3;}
        a.cancel-btn {
            padding: 9px 14px; background-color: #ccc; color: black;
            text-decoration: none; border-radius: 4px;
        }
        a.cancel-btn:hover {background-color: #999;}
    </style>
</head>
<body>
<h2>Thêm mã giảm giá mới</h2>

<form method="post" action="/jewelry/admin/voucher/create">
    <p>
        <label for="ma">Mã giảm giá:</label><br>
        <input type="text" id="ma" name="ma" placeholder="VD: jewelry20" required>
    </p>
    <p>
        <label for="phan_tram_giam">Phần trăm giảm (%):</label><br>
        <input type="number" step="0.01" id="phan_tram_giam" name="phan_tram_giam" 
               placeholder="VD: 20" required min="0" max="100">
    </p>
    <p>
        <label for="giam_toi_da">Giảm tối đa (VND):</label><br>
        <input type="number" step="1000" id="giam_toi_da" name="giam_toi_da" 
               placeholder="VD: 50000" required min="0">
    </p>
    <p>
        <label for="ngay_bat_dau">Ngày bắt đầu:</label><br>
        <input type="date" id="ngay_bat_dau" name="ngay_bat_dau" required 
               min="<?= date('Y-m-d'); ?>">
    </p>
    <p>
        <label for="ngay_ket_thuc">Ngày kết thúc:</label><br>
        <input type="date" id="ngay_ket_thuc" name="ngay_ket_thuc" required>
    </p>
    <p>
        <label for="so_luong">Số lượng mã:</label><br>
        <input type="number" id="so_luong" name="so_luong" placeholder="VD: 100" required min="1">
    </p>
    <p>
        <label for="dieukien">Điều kiện áp dụng (đơn hàng tối thiểu VND):</label><br>
        <input type="number" step="1000" id="dieukien" name="dieukien" placeholder="VD: 200000" min="0">
    </p>
    <p>
        <label for="trang_thai">Trạng thái:</label><br>
        <select id="trang_thai" name="trang_thai">
            <option value="1" selected>Hoạt động</option>
            <option value="0">Ngừng hoạt động</option>
        </select>
    </p>
    <p>
        <button type="submit">Thêm mới</button>
        <a href="/jewelry/admin/voucher/index" class="cancel-btn">Hủy</a>
    </p>
</form>

<script>
    const ngayBatDau = document.getElementById('ngay_bat_dau');
    const ngayKetThuc = document.getElementById('ngay_ket_thuc');
    ngayBatDau.addEventListener('change', function () {
        ngayKetThuc.min = this.value;
    });
</script>

</body>
</html>