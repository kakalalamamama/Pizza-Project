<?php
session_start();
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าต่างๆจากฟอร์มที่สั่งเมนู
    $userID = $_SESSION['user_id'];
    $menuID = isset($_POST['menuID']) ? intval($_POST['menuID']) : 1;
    $basePrice = isset($_POST['basePrice']) ? floatval($_POST['basePrice']) : 399;
    $addonIDs = isset($_POST['addons']) ? $_POST['addons'] : [];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    $totalPrice = $basePrice * $quantity;

    // ตรวจสอบว่ามีการเลือก add ons

    // หากมีการเลือก
    if (!empty($addonIDs)) {
        // วนลูปผ่านรายการ add ons ที่ผู้ใช้เลือก
        foreach ($addonIDs as $addonID) {
            // ดึงข้อมูลราคาของ add ons จากฐานข้อมูล addons โดยเทียบจาก AddonID
            $addonPriceQuery = "SELECT AddonPrice FROM addons WHERE AddonID = ?";
            $stmtAddon = $conn->prepare($addonPriceQuery);
            $stmtAddon->bind_param("i", $addonID);
            $stmtAddon->execute();
            $addonPriceResult = $stmtAddon->get_result();

            if ($addonPriceResult->num_rows > 0) {
                $addonPrice = $addonPriceResult->fetch_assoc()['AddonPrice'];
                $totalPrice += $addonPrice; // นำราคา addon มาบวกเพิ่มในราคารวมทั้งหมด
            }

            // เพิ่มข้อมูลลงตาราง cart
            $insertAddonQuery = "INSERT INTO cart (UserID, MenuID, AddonID, Quantity, TotalPrice, Confirmation) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertAddonQuery);
            $confirmation = 0;
            $stmt->bind_param("iiidsi", $userID, $menuID, $addonID, $quantity, $totalPrice, $confirmation);
            $stmt->execute();
            $stmt->close();
        }
    } else { 
        // หากไม่มีการเลือก addons จะเพิ่มข้อมูลลงในตาราง cart โดยให้ AddonID เป็น null
        $insertQuery = "INSERT INTO cart (UserID, MenuID, AddonID, Quantity, TotalPrice, Confirmation) VALUES (?, ?, null, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $confirmation = 0;
        $stmt->bind_param("iiidi", $userID, $menuID, $quantity, $totalPrice, $confirmation);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();

    header("Location: cart.php");
    exit();
} else {
    exit();
}
