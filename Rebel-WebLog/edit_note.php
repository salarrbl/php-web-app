<?php
session_start();
include './config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("❌ You must be logged in to edit posts.");
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("❌ Invalid post ID.");
}

$post_id = intval($_GET['id']);
$user_id = intval($_SESSION['user_id']);

// Fetch post data to edit
$sql = "SELECT * FROM posts WHERE id = $post_id AND author_id = $user_id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    die("❌ Post not found or you don't have permission to edit it.");
}

// Update post if form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);

    $update_sql = "UPDATE posts SET title = '$title', content = '$content', status = '$status', updated_at = NOW() WHERE id = $post_id AND author_id = $user_id";

    try {
        mysqli_query($conn, $update_sql);
        header("Location: my_posts.php"); // Redirect to My Posts page
        exit;
    } catch (mysqli_sql_exception $e) {
        echo "❌ Error updating post: " . $e->getMessage();
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h2>Edit Post</h2>
    <form action="" method="post">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        <br>
        <label>Content:</label>
        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        <br>
        <label>Status:</label>
        <select name="status">
            <option value="draft" <?php if ($post['status'] === 'draft') echo 'selected'; ?>>Draft</option>
            <option value="published" <?php if ($post['status'] === 'published') echo 'selected'; ?>>Published</option>
        </select>
        <br>
        <input type="submit" value="Update">
        <a href="my_posts.php">Cancel</a>
    </form>
</body>
</html>

