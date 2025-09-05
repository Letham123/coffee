<h2>Doanh thu theo năm: <?= htmlspecialchars($year) ?></h2>

<canvas id="revenueChart" width="600" height="300"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');

    // Giả sử $monthlyRevenue là mảng 12 phần tử, doanh thu từng tháng
    const months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    const revenues = <?= json_encode($monthlyRevenue ?? array_fill(0,12,0)) ?>;

    new Chart(ctx, {
        type: 'bar', // Biểu đồ cột
        data: {
            labels: months,
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
                title: { display: true, text: 'Doanh thu theo tháng trong năm <?= htmlspecialchars($year) ?>' }
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
