<?php
session_start();
require_once 'db_config.php';

$userID = $_SESSION['user_id'];

// ยืนยันคำสั่งซื้อ จะอัพเดทตาราง cart ให้ Confirmation = 1
$updateConfirmationQuery = "UPDATE cart SET Confirmation = 1 WHERE UserID = ?";
$stmt = $conn->prepare($updateConfirmationQuery);
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->close();

$conn->close();

header("Location: cart.php?success=1");
exit();
?>
