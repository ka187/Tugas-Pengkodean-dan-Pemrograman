document.addEventListener('DOMContentLoaded', () => {
    fetchInventory();
    fetchSales();

    document.getElementById('inventoryForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        fetch('includes/inventory.php', {
            method: 'POST',
            body: formData
        })
        .then(() => {
            fetchInventory();
            e.target.reset();
        });
    });

    document.getElementById('salesForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        fetch('includes/sales.php', {
            method: 'POST',
            body: formData
        })
        .then(() => {
            fetchSales();
            fetchInventory();
            e.target.reset();
        });
    });
});

function fetchInventory() {
    fetch('includes/inventory.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('inventoryList').innerHTML = data;
        });
}

function fetchSales() {
    fetch('includes/sales.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('salesList').innerHTML = data;
        });
}