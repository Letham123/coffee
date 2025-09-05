document.addEventListener('DOMContentLoaded', () => {
  window.toggleFilter = function() {
    const filterBody = document.getElementById('filterBody');
    filterBody.classList.toggle('active');
  }
});
