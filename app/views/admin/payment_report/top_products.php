<h2 style="text-align: center;">Top <?= intval($_GET['limit'] ?? 10) ?> sản phẩm bán chạy</h2>


<canvas id="topProductsChart" width="400" height="200"></canvas>

<?php if (!empty($topProducts)): ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('topProductsChart').getContext('2d');
        const topProductsChart = new Chart(ctx, {
            type: 'pie', // Hoặc 'bar', 'doughnut'
            data: {
                labels: <?= json_encode(array_column($topProducts, 'name')) ?>,
                datasets: [{
                    label: 'Số lượng bán',
                    data: <?= json_encode(array_column($topProducts, 'total_sold')) ?>,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                        '#9966FF', '#FF9F40', '#66FF66', '#FF6666',
                        '#66B2FF', '#FFD700'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    title: {
                        display: true,
                        text: 'Top sản phẩm bán chạy'
                    }
                }
            }
        });
    </script>
<?php else: ?>
    <p>Chưa có sản phẩm bán chạy nào.</p>
<?php endif; ?>

<a href="/jewelry/admin/paymentreport/index">Quay lại</a>
