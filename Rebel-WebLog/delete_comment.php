<?php
session_start();
include './config/db.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    die("⛔ Unauthorized access!");
}

if (isset($_GET['id'])) {
    $comment_id = intval($_GET['id']);
    $sql = "DELETE FROM comments WHERE id = $comment_id";
    mysqli_query($conn, $sql);
}

header("Location: admin_comments.php");
exit;
?>

