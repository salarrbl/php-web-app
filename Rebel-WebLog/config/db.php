<?php
$db_servername = "localhost"; 
$db_username = "rebel"; 
$db_password = "1234"; 
$db_database = "weblog"; 

// Create a connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

?>
