<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    // เข้ารหัสรหัสผ่าน
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // เพิ่มข้อมูลใหม่ลงตาราง admin_users
    $insertQuery = "INSERT INTO admin_users (Username, Password, Name, Email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssss", $username, $hashedPassword, $name, $email);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        body{
            min-height: 100vh;
    width: 100%;
    background-image: linear-gradient(rgba(4,9,30,0.7), rgba(4,9,30,0.7)), url(image/pizza.jpg);
    background-position: center;
    background-size: cover;
        }
        .container {
            padding: 20px;
            width: 500px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            border-radius: 10px;
            background: white;
            -webkit-box-shadow: 2px 1px 21px -9px rgba(0, 0, 0, 0.38);
            -moz-box-shadow: 2px 1px 21px -9px rgba(0, 0, 0, 0.38);
            box-shadow: 2px 1px 21px -9px rgba(0, 0, 0, 0.38);
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f7f7f7;
            font-family: Montserrat, Arial, Helvetica, sans-serif;
        }

        select {
            width: 18%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f7f7f7;
            font-family: Montserrat, Arial, Helvetica, sans-serif;
        }

        input[type=email] {
            width: 81%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f7f7f7;
        }

        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        select:focus {
            background-color: #ddd;
            outline: none;
        }



        button {
            background-color: #0eb7f4;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            font-size: 16px;
            font-family: Montserrat, Arial, Helvetica, sans-serif;
            border-radius: 10px;
        }

        button:hover {
            opacity: 1;
        }
    </style>
</head>

<body>

    
        <div class="container mt-4">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1>Add New Admin</h1>

            <div class="form-group">
                <label for="name"><b>Name</b></label>
                <input type="text" id="name" name="name" placeholder="Enter Name" required>
            </div>

            <div class="form-group">
                <label for="username"><b>Username</b></label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>

            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="password" name="password" required>
            </div>

            <div class="clearfix">
                <button type="submit" class="btn btn-primary">Add Admin</button>
                <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>