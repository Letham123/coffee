<style>
    .sidebar { width: 250px; background: #343a40; color: white; min-height: 100vh; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; }
        .sidebar a:hover { background: #495057; }
        .sidebar .active { background: #007bff; }
</style>
<nav class="sidebar">
    <h3 class="text-center py-4">Xin chào, Admin</h3>
    <a href="/jewelry/admin/admindashboard" class="<?= ($_SERVER['REQUEST_URI'] == '/jewelry/admin/admindashboard') ? 'active' : '' ?>">Dashboard</a>
    <a href="/jewelry/admin/category/index" class="<?= ($_SERVER['REQUEST_URI'] == '/jewelry/admin/category/index') ? 'active' : '' ?>">Quản lý danh mục sản phẩm</a>
    <a href="/jewelry/admin/orders/index" class="<?= ($_SERVER['REQUEST_URI'] == '/jewelry/admin/orders/index') ? 'active' : '' ?>">Quản lý đơn hàng</a>
    <a href="/jewelry/admin/users/index" class="<?= ($_SERVER['REQUEST_URI'] == '/jewelry/admin/users/index') ? 'active' : '' ?>">Quản lý người dùng</a>
    <a href="/jewelry/admin/products/index" class="<?= ($_SERVER['REQUEST_URI'] == '/jewelry/admin/products/index') ? 'active' : '' ?>">Quản lý sản phẩm</a>
    <a href="/jewelry/admin/voucher/index" class="<?= ($_SERVER['REQUEST_URI'] == '/jewelry/admin/voucher/index') ? 'active' : '' ?>">Quản lý mã giảm giá</a>
    <a href="/jewelry/admin/contacts/index" class="<?= ($_SERVER['REQUEST_URI'] == '/jewelry/admin/contacts/index') ? 'active' : '' ?>">Quản lý phản hồi</a>
    <a href="/jewelry/admin/paymentreport/index" class="<?= ($_SERVER['REQUEST_URI'] == '/jewelry/admin/paymentreport/index') ? 'active' : '' ?>">Quản lý thanh toán & báo cáo</a>
    <a href="/jewelry/">Đăng xuất</a>
</nav>
