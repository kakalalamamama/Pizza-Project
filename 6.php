<?php
session_start();
require_once 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        
        h1 {text-align: center;}
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIZZAIOLO</title>
    
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="res.css">
</head>

<body>
    <section class="header">
        <div class=" container">
            <div class="navbar">
                <div class = "logo">
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
                <img src="image/cartwhite.png" width="25px" height="25px">
            </a>

                
            </div>
        </div>

        <?php
        $menuID = 6;
        $sqlMenu = "SELECT * FROM menu WHERE MenuID = $menuID";
        $resultMenu = $conn->query($sqlMenu);

        if ($resultMenu->num_rows > 0) {
            $rowMenu = $resultMenu->fetch_assoc();
            echo '<center>';
            echo '<div class="center">
                    <img src="' . $rowMenu['ImageURL2'] . '" width="250px">
                </div>';
            echo '</center>';
            echo '<h1 class="page-title">' . $rowMenu['MenuName'] . '</h1>';
            echo '<h1 class="descrip">' . $rowMenu['Description'] . '</h1>';
        }
        
        ?>

<form action="addToCart.php" method="post">
            <?php
            $categoryID = 2;
            $sqlAddons = "SELECT * FROM addons WHERE categoryID = $categoryID";
            $resultAddons = $conn->query($sqlAddons);

            if ($resultAddons->num_rows > 0) {
                echo '<h1 class="add">Add on</h1>';
                echo '<div class="add-on">';
                echo '<div class="checkbox-container">';

                while ($rowAddon = $resultAddons->fetch_assoc()) {
                    echo '<div class="checkbox-item">';
                    echo '<input type="checkbox" name="addons[]" value="' . $rowAddon['AddonID'] . '" id="extra' . $rowAddon['AddonID'] . '" data-price="' . $rowAddon['AddonPrice'] . '">';
                    echo '<label for="extra' . $rowAddon['AddonID'] . '"> + ' . $rowAddon['AddonName'] . ' +' . $rowAddon['AddonPrice'] . '</label>';
                    echo '</div>';
                }


                echo '</div>';
                echo '</div>';
            }


            ?>
            <input type="hidden" name="menuID" value="6">
            <input type="hidden" name="basePrice" value="259">
            <h1 class="quan">Quantity</h1>
            <div class="quantity-container">
                <button type="button" onclick="decreaseQuantity()" id="decrement">-</button>
                <input type="text" name="quantity" id="quantity" class="quantity-input" value="1" readonly>
                <button type="button" onclick="increaseQuantity()" id="increment">+</button>
            </div>

            <h1 class="total-price">Total Price: <span id="total-price">259</span>฿</h1>

            <center>
            <div class="cart-container">
                <div class="button-container">
                    <input type="submit" class="cart-button" value="Add to cart">
                </div>
            </div>
            </center>
        </form>


        <script>
            let quantityInput = document.getElementById('quantity');
            let totalPriceElement = document.getElementById('total-price');
            let basePrice = 259;
            let currentQuantity = 1;
        
            // Add event listeners to all checkboxes
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalPrice);
            });
        
            function increaseQuantity() {
                currentQuantity++;
                updateQuantity();
            }
        
            function decreaseQuantity() {
                if (currentQuantity > 1) {
                    currentQuantity--;
                    updateQuantity();
                }
            }
        
            function updateQuantity() {
                quantityInput.value = currentQuantity;
                updateTotalPrice();
            }
        
            function updateTotalPrice() {
                let selectedAddons = document.querySelectorAll('input[type="checkbox"]:checked');
                let addonPrices = Array.from(selectedAddons).map(checkbox => parseInt(checkbox.dataset.price));
                let totalAddonsPrice = addonPrices.reduce((total, price) => total + price, 0);
        
                let total = basePrice * currentQuantity + totalAddonsPrice;
                totalPriceElement.textContent = total;
            }
            
        </script>
        
        
        
        
    </section>
</body>
</html>
