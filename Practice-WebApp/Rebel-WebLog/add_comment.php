<?php
session_start();
include './config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $post_id = intval($_POST['post_id']);
    $author_id = intval($_SESSION['user_id']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    if (empty($content)) {
        die("❌ Comment cannot be empty.");
    }

    $sql = "INSERT INTO comments (post_id, author_id, content, status) 
            VALUES ('$post_id', '$author_id', '$content', 'pending')";
    if (mysqli_query($conn, $sql)) {
        echo "✅ Comment submitted for approval.";
    } else {
        echo "❌ Error saving comment.";
    }
} else {
    echo "⛔ Unauthorized access!";
}
?>

