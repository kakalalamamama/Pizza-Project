<?php
session_start();
require_once 'db_config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: account.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIZZAIOLO</title>
    <link rel="stylesheet" href="abount.css">
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="image/logo1.png" width="105px">
                </div>
                <nav>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            echo '<li><a href="logout.php">Logout</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
                <a href="cart.php">
                    <img src="image/cartwhite.png" width="25px" height="25px">
                </a>

            </div>

            <!-------------------------->
            <div class="row">
                <div class="col-2">
                    <h1> PIZZAIOLO<br>  <br></h1>
                    <h2>
                        Welcome to PIZZAIOLO, your go-to online ordering hub for pizza without the hassle of delivery.We're dedicated to connecting pizza lovers with local pizzerias, offering a seamless online experience to order and pick up your favorite pizzas. Our platform supports local businesses, providing a user-friendly interface for customization and order placement. Skip the delivery and enjoy the convenience of picking up your hot and fresh pizza at your chosen pizzeria. Join us in celebrating the love of pizza and supporting local communities!
                    </h2>

                </div>
                <div class="col-2">
                    <img src="image/q.png" width="900px">
                </div>
            </div>
            <!-------------------------->
            <div class="row3">
                <img src="image/w.png" width="900px">
                <div class="col-3">
                    <h1>How we made pizza?  <br></h1>
                    <h2>
                        PIZZAIOLO, where pizza making is an art form. Our journey begins with a meticulously crafted dough, a blend of tradition and quality. Our signature sauce, a symphony of tomatoes and herbs, sets the stage for hand-stretched perfection by our skilled artisans. We select only the finest, locally sourced ingredients, creating a culinary masterpiece that undergoes a transformative journey in our fiery ovens. At PIZZAIOLO, we don't just make pizzas; we craft moments of joy, shared laughter, and delightful memories. Join us in savoring the passion and dedication that goes into every slice. Welcome to our family.
                    </h2>
                </div>
                
               
            </div>
        </div>
    </div>


</body>
</html>