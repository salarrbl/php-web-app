<?php
session_start();
include './config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("❌ You must be logged in to view your posts.");
}

$author_id = intval($_SESSION['user_id']); // Get logged-in user ID

// Fetch user's posts
$sql = "SELECT * FROM posts WHERE author_id = $author_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>
</head>
<body>
    <h2>My Posts</h2>
    <a href="write_post.php">➕ Write New Post</a> | <a href="view_posts.php">📜 View All Posts</a>
    <hr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h3>{$row['title']}</h3>";
            echo "<p>{$row['content']}</p>";
            echo "<p><strong>Status:</strong> {$row['status']} | <strong>Published At:</strong> {$row['published_at']}</p>";
            echo "<a href='./edit_note.php?id={$row['id']}'>✏️ Edit</a> | ";
            echo "<a href='note_del.php?id={$row['id']}'>🗑 Delete</a>";
            echo "<hr>";
        }
    } else {
        echo "<p>📭 No posts found.</p>";
    }
    
    mysqli_close($conn);
    ?>
</body>
</html>

