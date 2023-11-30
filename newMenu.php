<?php
require_once 'db_config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Menu</title>

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
        <h2>New Menu</h2>

        <form action="processNewMenu.php" method="post">
            <div class="form-group">
                <label for="menuName"><b>Menu Name:</label>
                <input type="text" class="form-control" id="menuName" name="menuName" placeholder="Menu Name" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <?php
                    // ดึงข้อมูล Category จากฐานข้อมูล
                    $categoryQuery = "SELECT * FROM categories";
                    $categoryResult = $conn->query($categoryQuery);

                    // แสดงตัวเลือกใน dropdown
                    while ($category = $categoryResult->fetch_assoc()) {
                        echo "<option value='{$category['CategoryID']}'>{$category['CategoryName']}</option>";
                    }
                    ?>
                </select>
                <input type="hidden" name="categoryID" id="categoryID">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description" ></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="Price" required>
            </div>

            <div class="form-group">
                <label for="imageURL">Image URL:</label>
                <input type="text" class="form-control" id="imageURL" name="imageURL" placeholder="ImageURL">
            </div>

            <div class="form-group">
                <label for="imageURL2">Image URL 2:</label>
                <input type="text" class="form-control" id="imageURL2" name="imageURL2" placeholder="ImageURL2">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="menuList.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        // ใช้ JavaScript เพื่ออัปเดต input hidden เมื่อมีการเลือก Category
        document.getElementById('category').addEventListener('change', function() {
            var categoryID = this.value;
            document.getElementById('categoryID').value = categoryID;
        });
    </script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>