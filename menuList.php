<?php
require_once 'db_config.php';

// Query แสดงข้อมูลในตาราง menu เรียงตาม CategoryID
$menuQuery = "SELECT menu.*, categories.CategoryName
              FROM menu
              LEFT JOIN categories ON menu.CategoryID = categories.CategoryID
              ORDER BY menu.CategoryID, menu.MenuID";
$menuResult = $conn->query($menuQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu List</title>

    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: "lato", sans-serif;
            min-height: 100vh;
    width: 100%;
    background-image: linear-gradient(rgba(4,9,30,0.7), rgba(4,9,30,0.7)), url(image/pizza.jpg);
    background-position: center;
    background-size: cover;
        }

        .container {
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding-left: 10px;
            padding-right: 10px;
        }

        h2 {
            font-size: 26px;
            margin: 20px 0;
            text-align: center;
            color: #ffffff;
        }

        a{
            color: #ffffff;
        }

        h2 small {
            font-size: 0.5em;
        }

        .responsive-table li {
            border-radius: 3px;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .responsive-table .table-header {
            background-color:#ffffff;
            font-size: 18px;
            text-transform: uppercase;
        }

        .responsive-table .table-row {
            background-color: #ffffff;
            box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
        }

        .responsive-table .col-1 {
            flex-basis: 5%;
        }

        .responsive-table .col-2 {
            flex-basis: 15%;
        }

        .responsive-table .col-3 {
            flex-basis: 15%;
        }

        .responsive-table .col-4 {
            flex-basis: 20%;
        }

        .responsive-table .col-5 {
            flex-basis: 10%;
        }

        .responsive-table .col-6 {
            flex-basis: 10%;
        }

        .responsive-table .col-7 {
            flex-basis: 10%;
        }

        .responsive-table .col-8 {
            flex-basis: 10%;
        }

        @media all and (max-width: 767px) {
            .responsive-table .table-header {
                display: none;
            }

            .responsive-table li {
                display: block;
            }

            .responsive-table .col {
                flex-basis: 100%;
            }

            .responsive-table .col {
                display: flex;
                padding: 10px 0;
            }

            .responsive-table .col:before {
                color: #6c7a89;
                padding-right: 10px;
                content: attr(data-label);
                flex-basis: 50%;
                text-align: right;
            }
        }

        @media (min-width: 768px) {
            .content {
                margin-left: 250px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Manage</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="menuList.php">Menu List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addNewAdmin.php">Add New Admin</a>
                </li>
                <?php
                echo '<li><a class="nav-link" href="logout.php">Logout</a></li>';
                ?>
            </ul>
        </div>
    </nav>
    <div class="container">
    <h2>Menu</h2>
    <div class="d-flex justify-content-between align-items-center">
       <h1></h1>
        <a href="newMenu.php">New Menu</a>
    </div>
    <br>
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">ID</div>
                <div class="col col-2">Category</div>
                <div class="col col-3">Name</div>
                <div class="col col-4">Description</div>
                <div class="col col-5">Price</div>
                <div class="col col-6">Image</div>
                <div class="col col-7">Image</div>
                <div class="col col-8">Actions</div>
            </li>
            
            <?php
            while ($row = $menuResult->fetch_assoc()) {
                echo "<li class='table-row'>";
                echo "<div class='col col-1' data-label='MenuID'>{$row['MenuID']}</div>";
                echo "<div class='col col-2' data-label='Category'>{$row['CategoryName']}</div>";
                echo "<div class='col col-3' data-label='Menu Name'>{$row['MenuName']}</div>";
                echo "<div class='col col-4' data-label='Description'>{$row['Description']}</div>";
                echo "<div class='col col-5' data-label='Price'>{$row['Price']}</div>";
                echo "<div class='col col-6' data-label='Image 1'><img src='{$row['ImageURL']}' alt='Image 1' style='max-width: 100px;'></div>";
                echo "<div class='col col-7' data-label='Image 2'><img src='{$row['ImageURL2']}' alt='Image 2' style='max-width: 100px;'></div>";
                echo "<div class='col col-8' data-label='Actions'>
                <span>
                  <a href='menuEdit.php?MenuID={$row['MenuID']}'><i class='fas fa-edit' style='color: black;'></i></a>
                  <a href='deleteMenu.php?MenuID={$row['MenuID']}'><i class='fas fa-trash' style='color: black;'></i></a>
                </span>
              </div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>

    <?php
    $conn->close();
    ?>

</body>

</html>