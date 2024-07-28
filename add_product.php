<?php
include 'db_connect.php';

echo("hello");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input data
    $product_name = trim($_POST['product_name']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);



    // Validate the input data
    if (!empty($product_name) && $quantity > 0 && $price >= 0) {
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO inventory (product_name, quantity, price) VALUES (?, ?, ?)");
        if ($stmt === false) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit();
        }

        $stmt->bind_param("sid", $product_name, $quantity, $price); // "sid" means string, integer, double

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        // Close the statement and the connection
        $stmt->close();
    } else {
        echo "Invalid input data";
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>
