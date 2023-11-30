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

    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="image/chef.png ">
                </div>

                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span>Login</span>
                        </div>

                        <form id="" action="login_admin_process.php" method="post">
                            <input type="text" name="username" placeholder="Username" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <button type="submit" class="btn">Login</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>