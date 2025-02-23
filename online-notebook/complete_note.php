<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid note ID.");
}

$note_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Update the note to mark as completed
$sql = "UPDATE notes SET completed = 1 WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $note_id, $user_id);

if ($stmt->execute()) {
    header("Location: dashboard.php?msg=Note marked as completed");
    exit();
} else {
    die("Error updating note.");
}
?>

