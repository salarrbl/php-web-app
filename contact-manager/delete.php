<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Delete the contact
    $sql = "DELETE FROM contacts WHERE id = $id AND user_id = $user_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No contact ID provided.";
}
?>

