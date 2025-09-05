<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/coffee/public/css/styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .message { padding: 10px; margin-bottom: 10px; border-radius: 5px; }
        .error { background-color: #f8d7da; color: #721c24; }
        body {
    background: url("/coffee/public/images/home.png") no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
    </style>
</head>
<body>
    <div class="login-container"> 
        <h2>ĐĂNG NHẬP</h2>

            <?php if (!empty($error)) { ?>
                <div class="message error"><?php echo $error; ?></div>
            <?php } ?>
        <form action="" method="POST">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Họ tên" autocomplete="off" required>
            </div>

            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Mật khẩu" autocomplete="off" required>
            </div>

            <div class="register-link">
                <a href="/coffee/user/register">Chưa có tài khoản?</a>
            </div>
     

            <button type="submit">ĐĂNG NHẬP</button>
        </form>
    </div>
</body>
</html>