<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin giao hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px 20px;
        }
        form {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            font-size: 16px;
        }
        form h3 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="tel"], textarea {
            width: 100%;
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }
        textarea {
            height: 90px;
            resize: vertical;
        }
        .flex-row {
            display: flex;
            gap: 5px;
        }
        .flex-row input {
            flex: 1;
        }
        .flex-row button {
            padding: 12px;
            border-radius: 0 6px 6px 0;
            border: none;
            background: black;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 5px;
        }
        .payment-options label {
            font-weight: normal;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        button[type="submit"] {
            width: 100%;
            margin-top: 25px;
            background: black;
            color: #fff;
            font-size: 18px;
            padding: 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form action="/coffee/order/submit" method="post">
    <h3><i class="fas fa-truck"></i> Thông tin giao hàng</h3>

    <label for="diachi"><i class="fas fa-location-dot" style="color:red;"></i> Địa chỉ giao hàng:</label>
    <div class="flex-row">
        <input type="text" name="diachi" id="diachi" placeholder="Nhập địa chỉ" required>
        <button type="button" onclick="getLocation()">📍 Địa chỉ hiện tại</button>
    </div>

    <label for="sdt"><i class="fas fa-phone" style="color:green;"></i> Số điện thoại:</label>
    <input type="tel" name="sdt" id="sdt" placeholder="Nhập số điện thoại" required pattern="[0-9]{9,12}" title="Nhập số điện thoại hợp lệ">

    <label>Phương thức thanh toán:</label>
    <div class="payment-options">
        <label><input type="radio" name="thanhtoan" value="COD" required> Thanh toán khi nhận hàng (COD)</label>
        <label><input type="radio" name="thanhtoan" value="Chuyển khoản"> Chuyển khoản ngân hàng</label>
    </div>

    <label for="ghichu_donhang"><i class="fas fa-comment-dots" style="color:#007BFF;"></i> Ghi chú cho người bán:</label>
    <textarea name="ghichu_donhang" id="ghichu_donhang" placeholder="Lưu ý cho người bán..."></textarea>

    <button type="submit">Đặt hàng</button>
</form>

<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Trình duyệt của bạn không hỗ trợ định vị.");
    }
}

function showPosition(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;

    fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`)
    .then(response => response.json())
    .then(data => {
        document.getElementById('diachi').value = data.display_name;
    })
    .catch(() => alert("Không lấy được địa chỉ."));
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("Bạn đã từ chối chia sẻ vị trí.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Không thể xác định vị trí.");
            break;
        case error.TIMEOUT:
            alert("Yêu cầu định vị quá lâu.");
            break;
        default:
            alert("Lỗi không xác định.");
            break;
    }
}
</script>

</body>
</html>
