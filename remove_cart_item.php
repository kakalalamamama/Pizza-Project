<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

if (isset($_GET['productName'])) {
    $productName = $_GET['productName'];

    // ลบข้อมูลจากตะกร้า เทียบโดยใช้ MenuID
    $deleteCartItemQuery = "DELETE FROM cart WHERE MenuID IN (SELECT MenuID FROM menu WHERE MenuName = ?) AND UserID = ?";
    $stmt = $conn->prepare($deleteCartItemQuery);
    $stmt->bind_param("si", $productName, $userID);
    $stmt->execute();
    $stmt->close();

    header("Location: cart.php");
    exit();
} else {
    header("Location: cart.php");
    exit();
}
?>
