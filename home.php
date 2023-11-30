<?php
session_start();
require_once 'db_config.php';
// เช็คว่าเข้าสู่ระบบรึยัง ถ้ายังให้เข้าสู่ระบบก่อนที่หน้า account.php
if (!isset($_SESSION['user_id'])) {
    header("Location: account.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pizza</title>
    <link rel="stylesheet" href="home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



<body>
    <div class="header">

        <div class=" container">
            <div class="navbar">
                <div class="logo">
                    <img src="image/logo1.png" width="105px">
                </div>
                <nav>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="abount.php">About</a></li>
                        <?php
                        // ส่วนของการออกจากระบบ 
                        if (isset($_SESSION['user_id'])) {
                            echo '<li><a href="logout.php">Logout</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
                <a href="cart.php">
                    <img src="image/cart1.png" width="25px" height="25px">
                </a>
            </div>
            <div class="row">
                <div class="col-2">
                    <h1> PIZZAIOLO<br> <br></h1>
                    <h2>YOU CAN'T MAKE <br> EVERYONE HAPPY. <br>YOU'RE NOT PIZZA.</h2>
                    <a href="categories-index.php" class="btn"> Explore Now &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="image/chef.png" width="900px">
                </div>
            </div>
        </div>
    </div>
    <!----featured categories --->
    <div class="categories">
        <div class="small-container">

            <div class="row">
                <div class="col-3">
                    <img src="image/sdogh100100.jpg">
                </div>

                <div class="col-3">
                    <img src="image/fkitchen.jpg">

                </div>

                <div class="col-3">
                    <img src="image/oven10001000.jpg">

                </div>
            </div>
        </div>
    </div>
    <!---Featured Foods-->

    <!----------------pizza------------------------->
    <div class="small-container">
        <h2 class="title">PIZZA</h2>
        <div class="row">
            <?php
            // ดึงข้อมูลเมนูที่มี CategoryID = 1 มาแสดง
            $sql = "SELECT * FROM Menu WHERE CategoryID = 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-4">';
                    echo '<a href="' . $row['MenuID'] . '.php">';
                    echo '<img src="' . $row['ImageURL'] . '">';
                    echo '<h4>' . $row['MenuName'] . '</h4>';
                    echo '</a>';
                    echo '<div class="rating">';
                    $rating = 5;
                    for ($i = 1; $i <= 5; $i++) {
                        $iconClass = ($i <= $rating) ? 'fa-star' : 'fa-star-o';
                        echo '<i class="fa ' . $iconClass . '"></i>';
                    }
                    echo '</div>';
                    echo '<p>' . $row['Price'] . ' ฿</p>';
                    echo '</div>';
                }
            } else {
                echo "ไม่พบข้อมูลในหมวดหมู่ PIZZA";
            }
            ?>
        </div>

        <!-------------------------Pasta--------------------->
        <h2 class="title">PASTA</h2>
        <div class="row">
            <?php
            // ดึงข้อมูลเมนูที่มี CategoryID = 2 มาแสดง
            $sql = "SELECT * FROM Menu WHERE CategoryID = 2";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-4">';
                    echo '<a href="' . $row['MenuID'] . '.php">';
                    echo '<img src="' . $row['ImageURL'] . '">';
                    echo '<h4>' . $row['MenuName'] . '</h4>';
                    echo '</a>';
                    echo '<div class="rating">';
                    $rating = 5;
                    for ($i = 1; $i <= 5; $i++) {
                        $iconClass = ($i <= $rating) ? 'fa-star' : 'fa-star-o';
                        echo '<i class="fa ' . $iconClass . '"></i>';
                    }
                    echo '</div>';
                    echo '<p>' . $row['Price'] . ' ฿</p>';
                    echo '</div>';
                }
            } else {
                echo "ไม่พบข้อมูลในหมวดหมู่ PIZZA";
            }
            ?>
        </div>

        <!-------------------------Appetizers--------------------->
        <h2 class="title">APPETIZERS</h2>
        <div class="row">
            <?php
            // ดึงข้อมูลเมนูที่มี CategoryID = 3 มาแสดง
            $sql = "SELECT * FROM Menu WHERE CategoryID = 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-4">';
                    echo '<a href="' . $row['MenuID'] . '.php">';
                    echo '<img src="' . $row['ImageURL'] . '">';
                    echo '<h4>' . $row['MenuName'] . '</h4>';
                    echo '</a>';
                    echo '<div class="rating">';
                    $rating = 5;
                    for ($i = 1; $i <= 5; $i++) {
                        $iconClass = ($i <= $rating) ? 'fa-star' : 'fa-star-o';
                        echo '<i class="fa ' . $iconClass . '"></i>';
                    }
                    echo '</div>';
                    echo '<p>' . $row['Price'] . ' ฿</p>';
                    echo '</div>';
                }
            } else {
                echo "ไม่พบข้อมูลในหมวดหมู่ PIZZA";
            }
            ?>
        </div>



        <!-------------------------Drinks--------------------->
        <h2 class="title">DRINKS</h2>
        <div class="row">
            <?php
            // ดึงข้อมูลเมนูที่มี CategoryID = 4 มาแสดง
            $sql = "SELECT * FROM Menu WHERE CategoryID = 4";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-4">';
                    echo '<a href="' . $row['MenuID'] . '.php">';
                    echo '<img src="' . $row['ImageURL'] . '">';
                    echo '<h4>' . $row['MenuName'] . '</h4>';
                    echo '</a>';
                    echo '<div class="rating">';
                    $rating = 5;
                    for ($i = 1; $i <= 5; $i++) {
                        $iconClass = ($i <= $rating) ? 'fa-star' : 'fa-star-o';
                        echo '<i class="fa ' . $iconClass . '"></i>';
                    }
                    echo '</div>';
                    echo '<p>' . $row['Price'] . ' ฿</p>';
                    echo '</div>';
                }
            } else {
                echo "ไม่พบข้อมูลในหมวดหมู่ PIZZA";
            }
            ?>
        </div>

    </div>



</body>

</html>