<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php'; // Database connection

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid note ID.");
}

$note_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Delete the note only if it belongs to the logged-in user
$sql = "DELETE FROM notes WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $note_id, $user_id);

if ($stmt->execute()) {
    header("Location: dashboard.php?msg=Note deleted successfully");
    exit();
} else {
    die("Error deleting note.");
}
?>

