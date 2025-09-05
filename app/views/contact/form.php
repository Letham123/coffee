<?php if(isset($_SESSION['flash_message'])): ?>
    <p style="color:green;"><?php echo $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?></p>
<?php endif; ?>

<form action="/contact/submit" method="post">
    <h3>Get in touch</h3>
    <div class="inputBox">
        <span class="fas fa-user"></span>
        <input type="text" name="name" placeholder="Enter your full name" required>
    </div>
    <div class="inputBox">
        <span class="fas fa-envelope"></span>
        <input type="email" name="email" placeholder="Enter your email" required>
    </div>
    <div class="inputBox">
        <span class="fas fa-phone"></span>
        <input type="text" name="phone" placeholder="Enter your phone" required>
    </div>
    <div class="inputBox">
        <span class="fas fa-comment"></span>
        <input type="text" name="message" placeholder="Write your message here..." required>
    </div>
    <input type="submit" value="Contact Now" class="btn">
</form>
