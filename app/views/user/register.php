<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Đăng ký</title>
    <link rel="stylesheet" href="/jewelry/public/css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        body {
    background: url("/jewelry/public/images/home.png") no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
        .message { padding: 10px; margin-bottom: 10px; border-radius: 5px; }
        .error { background-color: #f8d7da; color: #721c24; }
        .success { background-color: #d4edda; color: #155724; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>ĐĂNG KÍ</h2>

        <?php if (!empty($error)) : ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div class="message success"><?= htmlspecialchars($success) ?></div>
            <script>
                setTimeout(() => {
                    window.location.href = '/jewelry/user/login';
                }, 2000);
            </script>
        <?php endif; ?>

        <form action="/jewelry/user/register" method="POST">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="fullname" placeholder="Họ tên" required />
            </div>
            <div class="input-container">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required />
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Mật khẩu" required />
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="repassword" placeholder="Nhập lại mật khẩu" required />
            </div>
            <button type="submit">ĐĂNG KÍ</button>
        </form>

        <p>Đã có tài khoản? <a href="/jewelry/user/login">Đăng nhập</a></p>
    </div>
</body>
</html>
