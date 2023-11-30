<?php
require_once 'db_config.php';

if (isset($_GET['MenuID'])) {
    $menuID = $_GET['MenuID'];

    // เลือกข้อมูลจาก menu แสดงเฉพาะที่มี MenuID ตรงกัน
    $menuQuery = "SELECT * FROM menu WHERE MenuID = ?";
    $menuStmt = $conn->prepare($menuQuery);
    $menuStmt->bind_param('i', $menuID);
    $menuStmt->execute();
    $menuResult = $menuStmt->get_result();

    if ($menuResult->num_rows > 0) {
        $menuData = $menuResult->fetch_assoc();
    } else {
        // Handle case where MenuID is not found
        echo 'Menu not found.';
        exit;
    }

    $menuStmt->close();
} else {
    // Handle case where MenuID is not provided
    echo 'MenuID parameter is missing.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>

    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
        body {
            min-height: 100vh;
            width: 100%;
            background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url(image/pizza.jpg);
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

        input[type=text],
        input[type=number],
        select {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f7f7f7;
            font-family: Montserrat, Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <h2>Edit Menu</h2>

        <form action="processEditMenu.php" method="post">
            <!-- Include hidden input for MenuID -->
            <input type="hidden" name="menuID" value="<?php echo $menuData['MenuID']; ?>">

            <div class="form-group">
                <label for="menuName"><b>Menu Name:</label>
                <input type="text" class="form-control" id="menuName" name="menuName" value="<?php echo $menuData['MenuName']; ?>" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <?php
                    // แสดงข้อมูลจาก categories
                    $categoryQuery = "SELECT * FROM categories";
                    $categoryResult = $conn->query($categoryQuery);

                    // แสดง CategoryName เทียบกับ CategoryID
                    while ($category = $categoryResult->fetch_assoc()) {
                        $selected = ($category['CategoryID'] == $menuData['CategoryID']) ? 'selected' : '';
                        echo "<option value='{$category['CategoryID']}' {$selected}>{$category['CategoryName']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo $menuData['Description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo $menuData['Price']; ?>" required>
            </div>

            <div class="form-group">
                <label for="imageURL">Image URL:</label>
                <input type="text" class="form-control" id="imageURL" name="imageURL" value="<?php echo $menuData['ImageURL']; ?>">
            </div>

            <div class="form-group">
                <label for="imageURL2">Image URL 2:</label>
                <input type="text" class="form-control" id="imageURL2" name="imageURL2" value="<?php echo $menuData['ImageURL2']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="menuList.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>