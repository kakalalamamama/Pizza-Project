<?php
session_start();

$_SESSION = array();

session_destroy(); // ล้างข้อมูล session

header("Location: account.php");
exit();
?>