<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lara Jewelry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/jewelry/public/css/style.css">
    <style>
    .fas.fa-shopping-cart, .fas.fa-user-circle {
        font-size: 24px; 
        color: black; 
        margin: 0 10px;
        position: relative;
    }
    .cart-count {
        position: absolute;
        top: -8px;
        right: -10px;
        background: red;
        color: white;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 50%;
    }
    </style>
</head>
<body>
<header class="header">
    <a href="/jewelry/" class="logo">
        <img src="/jewelry/public/images/logo.jpg" alt="">
    </a>

    <nav class="navbar">
        <a href="/jewelry#home">home</a>
        <a href="/jewelry#about">about</a>
        <a href="/jewelry#nhẫn">nhẫn</a>
        <a href="/jewelry#dây chuyền">dây chuyền</a>
        <a href="/jewelry#vòng tay">vòng tay</a>
        <a href="/jewelry#feedback">feedback</a>
        <a href="/jewelry#contact">contact</a>

        <?php if (!isset($_SESSION['username'])): ?>
            <a href="/jewelry/user/login">Login</a>
            <a href="/jewelry/user/register">Register</a>
        <?php else: ?>
            <a href="#">Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?></a>
            <a href="/jewelry/user/logout">Logout</a>
        <?php endif; ?>
    </nav>

   
  <div class="search-container">
    <form action="/jewelry/home/searchResult" method="get" style="display: flex;">
      <input type="text" name="search" placeholder="Bạn muốn mua gì...." required>
      <button type="submit"><i class="fas fa-search"></i></button>
    </form>
 

  
</form>

  </div>
</div>

</div>

        <a href="/jewelry/cart/index">
            <i class="fas fa-shopping-cart">
                <span class="cart-count">
                    <?php 
                        $count = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $item) {
                                $count += $item['quantity'];
                            }
                        }
                        echo $count;
                    ?>
                </span>
            </i>
        </a>

        <div class="user-menu">
            <a href="/jewelry/account/index"><i class="fas fa-user-circle"></i></a>
        </div>

    </div>
</header>
<script src="/jewelry/public/js/filter.js"></script>
</body>
</html>
