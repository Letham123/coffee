<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Đặt hàng thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: #f0fff5;
            border: 1px solid #c8e6c9;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .icon-success {
            font-size: 50px;
            color: green;
            margin-bottom: 15px;
        }
        a.button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background: black;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="icon-success">&#10004;</div>
    <h2 style="color:green;">Đặt hàng thành công!</h2>
    <p>Cảm ơn bạn đã mua hàng tại Lara Jewelry.</p>
<button onclick="window.location.href='/jewelry/'" 
    style="padding:10px 20px; background:#000; color:#fff; border:none; border-radius:5px; cursor:pointer;">
    Về trang chủ
</button>
</body>
</html>
