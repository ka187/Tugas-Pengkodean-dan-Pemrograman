<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $sale_price = $_POST['sale_price'];
    
    $stmt = $conn->prepare("INSERT INTO sales (item_name, quantity, sale_price) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $item_name, $quantity, $sale_price);
    $stmt->execute();
    
    $stmt = $conn->prepare("UPDATE inventory SET quantity = quantity - ? WHERE item_name = ?");
    $stmt->bind_param("is", $quantity, $item_name);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT * FROM sales ORDER BY sale_date DESC";
$result = $conn->query($sql);

echo "<h3>Riwayat Penjualan</h3>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p>{$row['sale_date']} - {$row['item_name']} - Kuantitas: {$row['quantity']} - Harga Jual: Rp {$row['sale_price']}</p>";
    }
} else {
    echo "<p>Belum ada penjualan.</p>";
}

$conn->close();
?>