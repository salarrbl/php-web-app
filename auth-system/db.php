<?php
$servername = "localhost";
$username = "rebel";
$password = "1234";
$dbname = "auth_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

