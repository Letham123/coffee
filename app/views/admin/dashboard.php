<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 250px; background: #343a40; color: white; min-height: 100vh; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; }
        .sidebar a:hover { background: #495057; }
        .sidebar .active { background: #007bff; }
        .content { flex-grow: 1; padding: 30px; }
    </style>
</head>
<body>
<?php require_once __DIR__ . '/sidebar.php'; ?>
<div class="content">
        <div class="row g-4">
    <div class="col-md-3">
        <div class="card p-4">
            <h5>Đơn hàng</h5>
            <p class="display-6"><?= $orderCount ?></p>
            <small class="text-muted">Tổng số đơn hàng</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4">
            <h5>Khách hàng</h5>
            <p class="display-6"><?= $customerCount ?></p>
            <small class="text-muted">Số khách hàng đăng ký</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4">
            <h5>Sản phẩm</h5>
            <p class="display-6"><?= $productCount ?></p>
            <small class="text-muted">Sản phẩm đang bán</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4">
            <h5>Mã giảm giá</h5>
            <p class="display-6"><?= $voucherCount ?></p>
            <small class="text-muted">Mã giảm giá còn hiệu lực</small>
        </div>
    </div>
</div>

<section style="margin-top: 40px;">
    <h4>Đơn hàng mới nhất</h4>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($latestOrders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['id_order']) ?></td>
                <td><?= htmlspecialchars($order['username']) ?></td>
                <td><?= number_format($order['total']) ?> VND</td>
                <td>
                    <?php if($order['status'] == 'Chờ xử lý'): ?>
                        <span class="badge bg-warning text-dark">Chờ xử lý</span>
                    <?php else: ?>
                        <span class="badge bg-success">Đã giao</span>
                    <?php endif; ?>
                </td>
                <td><?= $order['order_date'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
