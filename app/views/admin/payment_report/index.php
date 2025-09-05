<h2 style="text-align: center; margin-bottom: 20px;">Quản Lý Thanh Toán & Báo cáo</h2>

<div style="max-width: 900px; margin: 0 auto; font-family: Arial, sans-serif;">

    <section style="background: #f8f8f8; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 15px; text-align: center;">Thống kê doanh thu</h3>

        <form method="get" action="/coffee/admin/paymentreport/revenueByDate" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px; justify-content: center;">
            <label>Chọn ngày:</label>
            <input type="date" name="date" value="<?= $_GET['date'] ?? date('Y-m-d') ?>" style="padding:5px 10px; border-radius:4px; border:1px solid #ccc;">
            <button type="submit" style="padding:5px 15px; border:none; background:#36A2EB; color:white; border-radius:4px; cursor:pointer;">Xem</button>
        </form>

        <form method="get" action="/coffee/admin/paymentreport/revenueByMonth" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px; justify-content: center;">
            <label>Chọn tháng:</label>
            <input type="month" name="month" value="<?= $_GET['month'] ?? date('Y-m') ?>" style="padding:5px 10px; border-radius:4px; border:1px solid #ccc;">
            <button type="submit" style="padding:5px 15px; border:none; background:#36A2EB; color:white; border-radius:4px; cursor:pointer;">Xem</button>
        </form>

        <form method="get" action="/coffee/admin/paymentreport/revenueByYear" style="display: flex; align-items: center; gap: 10px; justify-content: center;">
            <label>Chọn năm:</label>
            <input type="number" min="2000" max="<?= date('Y') ?>" name="year" value="<?= $_GET['year'] ?? date('Y') ?>" style="padding:5px 10px; border-radius:4px; border:1px solid #ccc;">
            <button type="submit" style="padding:5px 15px; border:none; background:#36A2EB; color:white; border-radius:4px; cursor:pointer;">Xem</button>
        </form>
    </section>

    <section style="background: #f8f8f8; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 15px; text-align: center;">Báo cáo sản phẩm bán chạy</h3>
        <form method="get" action="/coffee/admin/paymentreport/topProducts" style="display: flex; align-items: center; gap: 10px; justify-content: center;">
            <label>Số sản phẩm muốn xem:</label>
            <input type="number" name="limit" min="1" max="100" value="<?= $_GET['limit'] ?? 10 ?>" style="padding:5px 10px; border-radius:4px; border:1px solid #ccc;">
            <button type="submit" style="padding:5px 15px; border:none; background:#36A2EB; color:white; border-radius:4px; cursor:pointer;">Xem</button>
        </form>
    </section>
<p>
    <a href="/coffee/admin/admindashboard" 
       style="display:inline-block; padding:8px 20px; background:black; color:white; text-decoration:none; border-radius:4px; text-align:center;">
       Quay lại
    </a>
</p>
</div>
