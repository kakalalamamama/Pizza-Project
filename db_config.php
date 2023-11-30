<?php
// เชื่อมต่อกับฐานข้อมูล
$host = "localhost";
$username = "root";
$password = "root";
$database = "pizzaiolo";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
