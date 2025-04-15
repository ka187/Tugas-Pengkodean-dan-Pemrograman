<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    
    $stmt = $conn->prepare("INSERT INTO inventory (item_name, quantity, price) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?");
    $stmt->bind_param("sidd", $item_name, $quantity, $price, $quantity);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);

echo "<h3>Daftar Inventory</h3>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p>{$row['item_name']} - Kuantitas: {$row['quantity']} - Harga: Rp {$row['price']}</p>";
    }
} else {
    echo "<p>Belum ada barang di inventory.</p>";
}

$conn->close();
?>