<style>
    .sidebar { width: 250px; background: #343a40; color: white; min-height: 100vh; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; }
        .sidebar a:hover { background: #495057; }
        .sidebar .active { background: #007bff; }
</style>
<nav class="sidebar">
    <h3 class="text-center py-4">Xin chào, Admin</h3>
    <a href="/coffee/admin/admindashboard" class="<?= ($_SERVER['REQUEST_URI'] == '/coffee/admin/admindashboard') ? 'active' : '' ?>">Dashboard</a>
    <a href="/coffee/admin/category/index" class="<?= ($_SERVER['REQUEST_URI'] == '/coffee/admin/category/index') ? 'active' : '' ?>">Quản lý danh mục sản phẩm</a>
    <a href="/coffee/admin/orders/index" class="<?= ($_SERVER['REQUEST_URI'] == '/coffee/admin/orders/index') ? 'active' : '' ?>">Quản lý đơn hàng</a>
    <a href="/coffee/admin/users/index" class="<?= ($_SERVER['REQUEST_URI'] == '/coffee/admin/users/index') ? 'active' : '' ?>">Quản lý người dùng</a>
    <a href="/coffee/admin/products/index" class="<?= ($_SERVER['REQUEST_URI'] == '/coffee/admin/products/index') ? 'active' : '' ?>">Quản lý sản phẩm</a>
    <a href="/coffee/admin/voucher/index" class="<?= ($_SERVER['REQUEST_URI'] == '/coffee/admin/voucher/index') ? 'active' : '' ?>">Quản lý mã giảm giá</a>
    <a href="/coffee/admin/contacts/index" class="<?= ($_SERVER['REQUEST_URI'] == '/coffee/admin/contacts/index') ? 'active' : '' ?>">Quản lý phản hồi</a>
    <a href="/coffee/admin/paymentreport/index" class="<?= ($_SERVER['REQUEST_URI'] == '/coffee/admin/paymentreport/index') ? 'active' : '' ?>">Quản lý thanh toán & báo cáo</a>
    <a href="/coffee/">Đăng xuất</a>
</nav>
