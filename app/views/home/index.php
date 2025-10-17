<?php require_once ROOT_PATH . '/app/views/layouts/header.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LARA JEWELRY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="/jewelry/public/css/style.css">
    <style>
    .carousel-inner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }
     .banner img {
            width: 100%;
            heigh:500px;
            background-image: url('home.jpg');
            background-size:cover;
            background-position:center;
        }
        </style>
</head>
<body>
    <?php if (!empty($_SESSION['flash_message'])): ?>
    <div id="flash-box">
        <div class="flash-content">
            <span class="flash-icon">✔</span>
            <span class="flash-text"><?php echo $_SESSION['flash_message']; ?></span>
        </div>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
        <style>
        #flash-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(250, 248, 248, 0.8);
            color: white !important;
            padding: 20px 35px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            font-size: 20px;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        }
        .flash-icon {
            font-size: 28px;
            margin-right: 10px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, -60%); }
            to { opacity: 1; transform: translate(-50%, -50%); }
        }
       
    </style>
    
    <script>
        setTimeout(function() {
            var box = document.getElementById("flash-box");
            if (box) {
                box.style.transition = "opacity 0.5s ease";
                box.style.opacity = "0";
                setTimeout(function() {
                    box.remove();
                }, 500);
            }
        }, 3000);
    </script>
<?php endif; ?>
    <div class ="banner">
        <img src = "/jewelry/public/images/home.png" alt="Banner">
    </div>
   
    <section class="about" id="about"> 
    <h1 class="heading"> about<span> us</span> </h1>
   </section>
   <div class="about-section">
    <img src="/jewelry/public/images/2.png" alt="About jewelry">
    <div class = "about-text">
    <h3>Lara Jewelry – Tinh tế trong từng khoảnh khắc.</h3>
    <p>Lara Jewelry không chỉ là thương hiệu trang sức, mà là nơi tôn vinh vẻ đẹp và phong cách riêng của bạn.Chúng tôi mang đến những thiết kế tinh tế, được chế tác từ chất liệu cao cấp và tỉ mỉ trong từng chi tiết.Với phong cách hiện đại nhưng vẫn giữ nét thanh lịch, Lara Jewelry hy vọng mỗi món trang sức bạn chọn đều mang đến cảm giác tự tin, rạng ngời và ý nghĩa đặc biệt trong từng khoảnh khắc.</p>
    </div>
    </div>
    <section class="nhan" id="nhan">
        <h1 class="heading"> our <span>ring</span> </h1>
        <div class="box-container">
        <?php foreach ($nhan as $row): ?>
            <div class="box">
                <img src="/jewelry/public/images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name_product']); ?>">
                <h3><?php echo htmlspecialchars($row['name_product']); ?></h3>
                <div class="price"><?php echo number_format($row['price']); ?>VND
                </div>
                <form method="POST" action="/jewelry/cart/add">
                    <input type="hidden" name="id" value="<?php echo $row['id_product']; ?>">
                    <input type="hidden" name="name_product" value="<?php echo htmlspecialchars($row['name_product']); ?>">
                    <input type="hidden" name="price" value="<?= $row['price'] ?>">
                    <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
                    <button type="submit" class="btn">Thêm vào giỏ hàng</button>
                </form>
            </div>
        <?php endforeach; ?>
        </div>
    </section>

    <section class="daychuyen" id="daychuyen">
        <h1 class="heading"> our <span>necklace</span> </h1>
        <div class="box-container">
        <?php foreach ($daychuyen as $row): ?>
            <div class="box">
            <img src="/jewelry/public/images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name_product']); ?>">
                <h3><?php echo htmlspecialchars($row['name_product']); ?></h3>
                <div class="price"><?php echo number_format($row['price']); ?>VND</span>
                </div>
                <form method="POST" action="/jewelry/cart/add">
                    <input type="hidden" name="id" value="<?php echo $row['id_product']; ?>">
                    <input type="hidden" name="name_product" value="<?php echo htmlspecialchars($row['name_product']); ?>">
                    <input type="hidden" name="price" value="<?= $row['price'] ?>">
                    <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
                    <button type="submit" class="btn">Thêm vào giỏ hàng</button>
                </form>
            </div>
        <?php endforeach; ?>
        </div>
    </section>

    <section class="vongtay" id="vongtay">
        <h1 class="heading"> our <span>bracelet</span> </h1>
        <div class="box-container">
        <?php foreach ($vongtay as $row): ?>
             <div class="box">
            <img src="/jewelry/public/images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name_product']); ?>">
                <h3><?php echo htmlspecialchars($row['name_product']); ?></h3>
                <div class="price"><?php echo number_format($row['price']); ?>VND
                </div>
                <form method="POST" action="/jewelry/cart/add">
                    <input type="hidden" name="id" value="<?php echo $row['id_product']; ?>">
                    <input type="hidden" name="name_product" value="<?php echo htmlspecialchars($row['name_product']); ?>">
                     <input type="hidden" name="price" value="<?= $row['price'] ?>">
                    <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
                    <button type="submit" class="btn">Thêm vào giỏ hàng</button>
                </form>
            </div>
        <?php endforeach; ?>
        </div>
    </section>
    
<!-- <section class="feedback" id="feedback">
                <h1 class="heading"> <span>Why they </span> love us</h1>
                <div class="feedback-container">
                    <div class="feedback-box">
                        <div class="feedback-content">
                            <div class="feedback-text">
                                <p>"Cà phê rất ngon, không gian quán ấm cúng. Nhất định sẽ quay lại!"</p>
                                <h2>Nguyễn Văn ThiệnThiện</h2>
                                <span>Khách hàng thân thiết</span>
                            </div>
                        </div>
                    </div>
                    <div class="feedback-box">
                        <div class="feedback-content">
                            <div class="feedback-text">
                                <p>"Dịch vụ tốt, nhân viên nhiệt tình, giá cả hợp lý."</p>
                                <h2>Trần Thị XuyếnXuyến</h2>
                                <span>Khách hàng mới</span>
                            </div>
                        </div>
                    </div>
                    <div class="feedback-box">
                        <div class="feedback-content">
                            <div class="feedback-text">
                                <p>"Trà rất thơm, bánh ngon. Highly recommend!"</p>
                                <h2>Lê Quốc Anh</h2>
                                <span>Người yêu trà</span>
                            </div>
                        </div>
                    </div>
                    <div class="feedback-box">
                        <div class="feedback-content">
                            <div class="feedback-text">
                            <p>"Không gian đẹp, thích hợp để học bài và làm việc."</p>
                            <h2>Hoàng Minh Sang</h2>
                            <span>Người yêu cà phê</span>
                        </div>
                        </div>
                    </div>
                    <div class="feedback-box">
                        <div class="feedback-content">
                            <div class="feedback-text">
                            <p>"Nhạc nhẹ nhàng, nhân viên thân thiện, giá cả phải chăng."</p>
                            <h2>Mai Thanh Trà</h2>
                            <span>Freelance</span>
                            </div>
                        </div>
                    </div>
                    <div class="feedback-box">
                        <div class="feedback-content">
                            <div class="feedback-text">
                        <p>"Cà phê muối rất ngon, vị đậm đà, rất đáng thử!"</p>
                        <h2>Phạm Quang An Thắng</h2>
                        <span>Khách hàng thân thiết</span>
                    </div>
                        </div>
                    </div>
                </div>
            </section> -->
        <section class="contact" id="contact">
		<h1 class="heading"> <span>contact</span> us </h1>
		<div class="row">
			<iframe class="map" 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.3519982351495!2d106.64165999999999!3d10.7843294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752eb1cd7d4e49%3A0x411ab56b2abeaf38!2zNjEzIMSQLiDDgnUgQ8ahLCBQaMO6IFRydW5nLCBUw6JuIFBow7osIEjhu5MgQ2jDrSBNaW5oIDcwMDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1752637339765!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

		</div>
   </section>

</body>
</html>
<?php require_once ROOT_PATH . '/app/views/layouts/footer.php'; ?>
