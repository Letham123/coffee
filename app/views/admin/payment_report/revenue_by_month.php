<h2>Doanh thu theo tháng: <?= htmlspecialchars($month) ?></h2>

<canvas id="revenueMonthChart" width="600" height="300"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueMonthChart').getContext('2d');

    // Giả sử $dailyRevenue là mảng doanh thu từng ngày trong tháng
    const days = <?= json_encode(array_keys($dailyRevenue ?? [])) ?>; // ['01','02',...]
    const revenues = <?= json_encode(array_values($dailyRevenue ?? [])) ?>;

    new Chart(ctx, {
        type: 'bar', // Hoặc 'line' nếu muốn đường
        data: {
            labels: days,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: revenues,
                backgroundColor: '#36A2EB'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Doanh thu theo ngày trong tháng <?= htmlspecialchars($month) ?>' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: value => value.toLocaleString() + ' đ' }
                }
            }
        }
    });
</script>

<p>Tổng doanh thu: <b><?= number_format($revenue) ?> đ</b></p>
<a href="/coffee/admin/paymentreport/index">Quay lại</a>
