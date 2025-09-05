<h2>Doanh thu theo ngày: <?= htmlspecialchars($date) ?></h2>

<canvas id="revenueDayChart" width="400" height="200"></canvas>

<?php if (!empty($dailyPayments)): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueDayChart').getContext('2d');

    new Chart(ctx, {
        type: 'pie', // Hoặc 'doughnut'
        data: {
            labels: <?= json_encode(array_column($dailyPayments, 'thanhtoan')) ?>,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: <?= json_encode(array_column($dailyPayments, 'tongtien')) ?>,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                    '#9966FF', '#FF9F40'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                title: { display: true, text: 'Doanh thu theo phương thức thanh toán' }
            }
        }
    });
</script>
<?php endif; ?>

<p>Tổng doanh thu: <b><?= number_format($revenue) ?> đ</b></p>
<a href="/coffee/admin/paymentreport/index">Quay lại</a>
