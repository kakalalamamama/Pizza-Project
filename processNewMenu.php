<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $menuName = $_POST['menuName'];
    $categoryID = $_POST['categoryID'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imageURL = $_POST['imageURL'];
    $imageURL2 = $_POST['imageURL2'];

    // เพิ่มข้อมูลใหม่ลงในตาราง menu
    $insertMenuQuery = "INSERT INTO menu (CategoryID, MenuName, Description, Price, ImageURL, ImageURL2) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertMenuQuery);
    $stmt->bind_param("issdss", $categoryID, $menuName, $description, $price, $imageURL, $imageURL2);
    $stmt->execute();

    $stmt->close();
}

$conn->close();

header("Location: menuList.php");
exit();
?>
