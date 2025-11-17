// assets/js/script.js

// validation for product form (Add Product)
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        const name = document.getElementById('name').value;
        const description = document.getElementById('description').value;
        const price = document.getElementById('price').value;
        const quantity = document.getElementById('quantity').value;

        if (!name || !description || !price || !quantity) {
            alert("Please fill out all fields.");
            event.preventDefault();  // Prevent form submission if validation fails
        }
    });
});
