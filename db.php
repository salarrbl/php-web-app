<?php
$host = 'localhost';
$user = 'rebel';
$password = '1234';
$dbname = 'contact_manager';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/* echo "Connected successfully"; */

?>

