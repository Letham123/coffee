document.addEventListener("DOMContentLoaded", function () {
    let navbar = document.querySelector('.navbar');
    let searchForm = document.querySelector('.search-form');
    let cartItem = document.querySelector('.cart-items-container');

    document.querySelector('#search-btn').addEventListener("click", function () {
        searchForm.classList.toggle('active');
        navbar.classList.remove('active');
        if (cartItem) cartItem.classList.remove('active');
    });

    document.getElementById("cart-btn").addEventListener("click", function () {
        if (cartItem) cartItem.classList.toggle("hidden");
    });

    window.onscroll = () => {
        navbar.classList.remove('active');
        searchForm.classList.remove('active');
        if (cartItem) cartItem.classList.remove('active');
    };
    const modal = document.getElementById("productModal");
    const modalName = document.getElementById("productName");
    const modalPrice = document.getElementById("productPrice");
    const closeModal = document.querySelector(".close");

    document.querySelectorAll(".open-modal").forEach(button => {
        button.addEventListener("click", function () {
            const name = this.dataset.name;
            const price = this.dataset.price;
            modalName.textContent = name;
            modalPrice.textContent = `Giá: ${price} VND`;
            modal.style.display = "flex";
        });
    });

    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
});


