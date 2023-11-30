<?php
session_start();
require_once 'db_config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: account.php");
    exit();
}

$userID = $_SESSION['user_id'];

// ดึงข้อมูลจากตาราง cart และใช้ JOIN รวมข้อมูลจากตาราง addons และ menu โดยให้ตาราง cart เป็นตารางหลัก
$fetchCartQuery = "SELECT
    menu.MenuID,
    menu.MenuName AS ProductName,
    GROUP_CONCAT(addons.AddonName SEPARATOR ', ') AS Addons,
    cart.Quantity,
    (menu.Price + COALESCE(SUM(addons.AddonPrice), 0)) AS TotalPrice
FROM
    cart
LEFT JOIN addons ON FIND_IN_SET(addons.AddonID, cart.AddonID)
LEFT JOIN menu ON cart.MenuID = menu.MenuID
WHERE -- เลือกเฉพาะรายการที่เป็นของผู้ใช้ที่เข้าสู่ระบบอยู่ และยังไม่ได้ทำการยืนยัน 
    cart.UserID = ? AND cart.Confirmation = 0
GROUP BY -- หากมีรายการซ้ำจะรวมจำนวนของรายการและราคารวมของทุกรายการ
    cart.MenuID, cart.Quantity";

$stmt = $conn->prepare($fetchCartQuery);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <img src="image/logo1.png" width="105px">
            </div>
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="abount.php">About</a></li>
                    <?php
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
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Orders</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product Name</th>
                                <th>Addons</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // แสดงข้อมูลในตาราง
                            $totalCartPrice = 0;
                            while ($row = $result->fetch_assoc()) {
                                $productTotalPrice = $row['TotalPrice'] * $row['Quantity'];
                                $totalCartPrice += $productTotalPrice;
                            ?>
                                <tr>
                                    <td><?php echo $row['ProductName']; ?></td>
                                    <td><?php echo $row['Addons']; ?></td>
                                    <td><?php echo $row['Quantity']; ?></td>
                                    <td><?php echo $productTotalPrice; ?></td>
                                    <td>
                                        <!-- ลบสินค้าออกจากตะกร้า -->
                                        <a href="remove_cart_item.php?productName=<?php echo urlencode($row['ProductName']); ?>" class="close" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td>Total Cart Price: <?php echo $totalCartPrice; ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <?php
        // ยืนยันคำสั่งซื้อ
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div class="alert alert-success" role="alert">
            Order confirmation successful!
          </div>';
        }
        ?>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <form action="confirm_order.php" method="post">
                    <button type="submit" class="btn">Confirm Order</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>