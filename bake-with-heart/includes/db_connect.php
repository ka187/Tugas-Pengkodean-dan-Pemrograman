<?php
$conn = new mysqli("localhost", "root", "", "bake_with_heart");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>