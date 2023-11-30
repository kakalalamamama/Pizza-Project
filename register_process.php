<?php
session_start(); // เก็บ session
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // เข้ารหัส รหัสผ่าน

    $email = $_POST['email'];

    // เพิ่มข้อมูลลงฐานข้อมูล
    $sql = "INSERT INTO Users (Username, Password, Email) VALUES ('$username', '$hashedPassword', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
