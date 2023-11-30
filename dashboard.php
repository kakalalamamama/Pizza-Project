<?php
require_once 'db_config.php';

// Query นับจำนวนคำสั่งซื้อทั้งหมด
$totalOrdersQuery = "SELECT COUNT(DISTINCT MenuID) AS totalOrders FROM cart";
$totalOrdersResult = $conn->query($totalOrdersQuery);
$totalOrders = $totalOrdersResult->fetch_assoc()["totalOrders"];

// Query นับจำนวนลูกค้าที่สมัครสมาิชกทั้งหมด
$totalCustomersQuery = "SELECT COUNT(DISTINCT UserID) AS totalCustomers FROM users";
$totalCustomersResult = $conn->query($totalCustomersQuery);
$totalCustomers = $totalCustomersResult->fetch_assoc()["totalCustomers"];

// Query หาผลรวมของราคาที่ได้จากการสั่งซื้อที่ได้รับการยืนยัน 
$totalConfirmedAmountQuery = "
SELECT SUM(menu.Price + COALESCE(addonTotal.AddonTotalPrice, 0)) AS totalConfirmedAmount
FROM cart
LEFT JOIN (
SELECT cart.MenuID, COALESCE(SUM(addons.AddonPrice), 0) AS AddonTotalPrice
FROM cart
LEFT JOIN addons ON FIND_IN_SET(addons.AddonID, cart.AddonID)
WHERE cart.Confirmation = 1
GROUP BY cart.MenuID
) AS addonTotal ON cart.MenuID = addonTotal.MenuID
LEFT JOIN menu ON cart.MenuID = menu.MenuID
WHERE cart.Confirmation = 1
";
$totalConfirmedAmountResult = $conn->query($totalConfirmedAmountQuery);
$totalConfirmedAmount = $totalConfirmedAmountResult->fetch_assoc()["totalConfirmedAmount"];


// Query แสดงจำนวนผู้ใช้ที่สั่งเมนูนั้นๆ
$bestSellingMenusQuery = "
SELECT MenuName, COUNT(DISTINCT cart.UserID) AS totalUsers
FROM cart
JOIN menu ON cart.MenuID = menu.MenuID
GROUP BY menu.MenuID
ORDER BY totalUsers DESC
";
$bestSellingMenusResult = $conn->query($bestSellingMenusQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .content {
            margin-left: 0;
            padding: 20px;
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
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
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

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">
                            <?php echo $totalOrders; ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Customers</h5>
                        <p class="card-text">
                            <?php echo $totalCustomers; ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Confirmed Amount</h5>
                        <p class="card-text">
                            <?php echo number_format($totalConfirmedAmount, 2); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Best-Selling Menus</h5>
                <canvas id="bestSellingMenusChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // แสดงกราฟแท่ง
        var ctx = document.getElementById('bestSellingMenusChart').getContext('2d');
        var bestSellingMenusChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    while ($row = $bestSellingMenusResult->fetch_assoc()) {
                        echo "'" . $row['MenuName'] . "', ";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Number of Users',
                    data: [
                        <?php
                        $bestSellingMenusResult->data_seek(0);
                        while ($row = $bestSellingMenusResult->fetch_assoc()) {
                            echo $row['totalUsers'] . ", ";
                        }
                        ?>
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>

</body>

</html>