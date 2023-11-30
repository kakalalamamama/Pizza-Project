<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่า menuID จากการเลือกในตาราง
    if (isset($_POST['menuID'])) {
        $menuID = $_POST['menuID'];
    } else {
        echo 'MenuID parameter is missing.';
        exit;
    }

    // เลือกข้อมูลจากในตารางเมนู
    $menuName = $_POST['menuName'];
    $categoryID = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imageURL = $_POST['imageURL'];
    $imageURL2 = $_POST['imageURL2'];

    // Update ข้อมูลที่แก้ไขแล้วแทนที่ข้อมูลเดิม โดยเที่ยบจาก menuID
    $updateMenuQuery = "UPDATE menu SET MenuName=?, CategoryID=?, Description=?, Price=?, ImageURL=?, ImageURL2=? WHERE MenuID=?";
    $updateMenuStmt = $conn->prepare($updateMenuQuery);
    $updateMenuStmt->bind_param('sissssi', $menuName, $categoryID, $description, $price, $imageURL, $imageURL2, $menuID);

    if ($updateMenuStmt->execute()) {
        header('Location: menuList.php');
        exit;
    } else {
        echo 'Error updating menu details: ' . $conn->error;
    }

    $updateMenuStmt->close();
} else {
    echo 'Invalid request method.';
    exit;
}

$conn->close();
?>
