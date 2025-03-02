<?php
include './config/db.php';

// Fetch posts with author name
$sql = "SELECT posts.*, users.name AS author_name 
        FROM posts 
        JOIN users ON posts.author_id = users.id 
        ORDER BY posts.created_at DESC";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
</head>
<body>
    <h2>All Posts</h2>
    <a href="write_post.php">➕ Write New Post</a> | <a href="my_posts.php">👤 My Posts</a>
    <hr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h3>{$row['title']}</h3>";
            echo "<p>{$row['content']}</p>";
            echo "<p><strong>Author:</strong> {$row['author_name']} | <strong>Status:</strong> {$row['status']} | <strong>Published At:</strong> {$row['published_at']}</p>";
            echo "<hr>";
        }
    } else {
        echo "<p>📭 No posts found.</p>";
    }
    
    mysqli_close($conn);
    ?>
</body>
</html>

