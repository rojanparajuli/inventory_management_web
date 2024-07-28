<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_file = 'inventory_db.sql';
$sql = file_get_contents($sql_file);

if ($conn->multi_query($sql) === TRUE) {
    echo "Database and table created successfully";
} else {
    echo "Error creating database or table: " . $conn->error;
}

$conn->close();
?>
