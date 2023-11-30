<?php
session_start();
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // เลือกข้อมูลที่มี username เหมือนกันกับที่ส่งค่ามาจาก form
    $sql = "SELECT * FROM Users WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['Password']; // เข้ารหัส รหัสผ่านที่รับค่ามา

        // ถ้ารหัสผ่านตรงกัน จะเข้าสู่ระบบสำเร็จ
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $user['UserID']; // เก็บ session เป็น UserID เพื่อใช้ในการสั่งสินค้า
            header("Location: home.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
    $conn->close();
}
?>
