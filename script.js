document.addEventListener('DOMContentLoaded', () => {
    fetchProducts();

    const productForm = document.getElementById('productForm');
    productForm.addEventListener('submit', function (e) {
        e.preventDefault();
        addProduct();
    });
});

function fetchProducts() {
    fetch('fetch_products.php')
        .then(response => response.json())
        .then(data => {
            const inventoryTable = document.getElementById('inventoryTable').getElementsByTagName('tbody')[0];
            inventoryTable.innerHTML = '';
            data.forEach(product => {
                const row = inventoryTable.insertRow();
                row.insertCell(0).textContent = product.id;
                row.insertCell(1).textContent = product.product_name;
                row.insertCell(2).textContent = product.quantity;
                row.insertCell(3).textContent = product.price;
                row.insertCell(4).textContent = product.created_at;
            });
        });
}

function addProduct() {
    const product_name = document.getElementById('product_name').value;
    const quantity = document.getElementById('quantity').value;
    const price = document.getElementById('price').value;

    console.log(product_name, quantity, price);

    const formData = new FormData(); // Initialize FormData without arguments
    formData.append('product_name', product_name);
    formData.append('quantity', quantity);
    formData.append('price', price);

    console.log([...formData]); // Log formData for debugging

    fetch('add_product.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        fetchProducts();
        document.getElementById('productForm').reset();
    })
    .catch(error => console.error('Error:', error));
}
