<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require './config/db.php'; // Database connection

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid note ID.");
}

$id = $_GET['id'];
$author_id = $_SESSION['user_id'];

// Delete the note only if it belongs to the logged-in user
$sql = "DELETE FROM posts WHERE id = ? AND author_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $author_id);

if ($stmt->execute()) {
	header("Location: my_posts.php?msg=Note deleted successfully");
	$s = $_GET['msg'];
	echo "Note deleted successfully";
    exit();
} else {
    die("Error deleting note.");
}
?>

