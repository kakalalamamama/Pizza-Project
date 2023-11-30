<?php
require_once 'db_config.php';

// Check if MenuID is set and not empty
if (isset($_GET['MenuID']) && !empty($_GET['MenuID'])) {
    // Get the MenuID from the query string
    $menuID = $_GET['MenuID'];

    // Query to delete the menu
    $deleteMenuQuery = "DELETE FROM menu WHERE MenuID = ?";
    $deleteMenuStmt = $conn->prepare($deleteMenuQuery);

    // Bind the parameter
    $deleteMenuStmt->bind_param("i", $menuID);

    // Execute the delete query
    if ($deleteMenuStmt->execute()) {
        // Redirect to menuList.php after successful deletion
        header("Location: menuList.php");
        exit();
    } else {
        echo "Error deleting menu: " . $conn->error;
    }

    // Close the prepared statement
    $deleteMenuStmt->close();
} else {
    // If MenuID is not set, redirect to menuList.php
    header("Location: menuList.php");
    exit();
}

// Close the database connection
$conn->close();
?>
