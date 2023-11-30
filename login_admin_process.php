<?php
session_start();
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // เลือกข้อมูลที่มี username เหมือนกันกับที่ส่งค่ามาจาก form
    $sql = "SELECT * FROM admin_users WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $hashedPassword = $admin['Password']; // เข้ารหัส รหัสผ่านที่รับค่ามา

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['admin_id'] = $admin['AdminID'];
            header("Location: dashboard.php");
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
