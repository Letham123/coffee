document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.delete-item').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            if (confirm('Bạn có chắc muốn xóa sản phẩm này không?')) {
                fetch('/coffee/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + encodeURIComponent(id)
                })
                .then(res => res.text())
                .then(data => {
                    console.log('Response:', data);
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
    const clearCartBtn = document.getElementById('clear-cart');
    if (clearCartBtn) {
        clearCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng không?')) {
                fetch('/coffee/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'all=1'
                })
                .then(res => res.text())
                .then(data => {
                    console.log('Response:', data);
                    location.reload(); // tải lại trang để cập nhật giỏ hàng
                })
                .catch(error => console.error('Error:', error));
            }
        });
    }
});
