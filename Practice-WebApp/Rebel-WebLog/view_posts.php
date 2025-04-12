<?php
session_start();
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
    <a href="write_post.php">➕ Write New Post</a> | <a href="my_posts.php">👤 My Posts</a> | <a href="user_panel.php">Dashboard</a>
    <hr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $post_id = $row['id'];
            echo "<h3>{$row['title']}</h3>";
            echo "<p>{$row['content']}</p>";
            echo "<p><strong>Author:</strong> {$row['author_name']} | <strong>Status:</strong> {$row['status']} | <strong>Published At:</strong> {$row['published_at']}</p>";
            
            // Fetch comments for this post
            $comments_sql = "SELECT comments.*, users.name AS author_name 
                             FROM comments 
                             JOIN users ON comments.author_id = users.id 
                             WHERE comments.post_id = $post_id AND comments.status = 'approved' 
                             ORDER BY comments.created_at DESC";
            $comments_result = mysqli_query($conn, $comments_sql);
            
            echo "<h4>💬 Comments:</h4>";
            if (mysqli_num_rows($comments_result) > 0) {
                echo "<ul>";
                while ($comment = mysqli_fetch_assoc($comments_result)) {
                    echo "<li><strong>{$comment['author_name']}:</strong> {$comment['content']} <em>({$comment['created_at']})</em></li>";
                }
                echo "</ul>";
            } else {
                echo "<p>📭 No comments yet.</p>";
            }

            // Show comment form if user is logged in
            if (isset($_SESSION['user_id'])) {
                echo '<h4>✏️ Add a Comment:</h4>
                    <form action="add_comment.php" method="POST">
                        <input type="hidden" name="post_id" value="' . $post_id . '">
                        <textarea name="content" required></textarea>
                        <br>
                        <button type="submit">📤 Submit</button>
                    </form>';
            } else {
                echo "<p>🔑 <a href='login.php'>Login</a> to comment.</p>";
            }

            echo "<hr>";
        }
    } else {
        echo "<p>📭 No posts found.</p>";
    }
    
    mysqli_close($conn);
    ?>
</body>
</html>

