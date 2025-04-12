<?php
session_start();
include 'db.php';
$user_id = $_SESSION['user_id'];
/* echo $user_id; */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $number = $conn->real_escape_string($_POST['number']);
    $email = $conn->real_escape_string($_POST['email']);
    $country = $conn->real_escape_string($_POST['country']);
    $more_info = $conn->real_escape_string($_POST['more_info']);
	/* $user_id = $conn->real_escape_string($_POST['id']); */


    $sql = "INSERT INTO contacts (name, number, email, country, more_info, user_id) 
            VALUES ('$name', '$number', '$email', '$country', '$more_info', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

