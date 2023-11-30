<?php
require_once 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pizza</title>
    <link rel="stylesheet" href="account.css">
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
                        <li><a href="account.php">Account</a></li>
                        <li><a href="admin.php">Admin</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
    <!----------account page--------->

    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="image/chef.png ">
                </div>

                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register ()">Register</span>
                            <hr id="Indicator">
                        </div>

                        <!-- ส่งค่าไปยัง login_process.php -->
                        <form id="LoginForm" action="login_process.php" method="post">
                            <input type="text" name="username" placeholder="Username" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <button type="submit" class="btn">Login</button>
                            <a href="forgot_password.php">Forgot Password</a>
                        </form>

                        <!-- register_process.php -->
                        <form id="RegForm" action="register_process.php" method="post">
                            <input type="text" name="username" placeholder="Username" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <input type="email" name="email" placeholder="Email" required>
                            <button type="submit" class="btn">Register</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>


    <!---------------JS for toggle form------------------------->
    <script>
        var LoginForm = document.getElementById("LoginForm")
        var RegForm = document.getElementById("RegForm")
        var Indicator = document.getElementById("Indicator")

        function register() {
            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";
        }

        function login() {
            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
        }
    </script>




</body>

</html>