<?php
include './config/db.php'; // Include database connection
session_start();
if (isset($_SESSION['login_true']) === true) {
	try {
        $sql = "select * from `users` where id = " . $_SESSION['user_id'];
        $result = mysqli_query($conn, $sql);
        $user_information = mysqli_fetch_assoc($result);

    } catch (mysqli_sql_exception $e) {
		$message = $e->getMessage();
		header('Location: login.php');
	}
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $author_id = intval($_SESSION['user_id']); // Assuming user is logged in
    $status = mysqli_real_escape_string($conn, $_POST["status"]); // 'draft' or 'published'

    $sql = "INSERT INTO posts (title, content, author_id, status, published_at) 
            VALUES ('$title', '$content', '$author_id', '$status', NOW())";

    try {
        $result = mysqli_query($conn, $sql);
        header("Location: view_posts.php"); // Redirect to posts list
    } catch (mysqli_sql_exception $e) {
        echo "❌ Error: " . $e->getMessage();
    }
}
mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a New Post</title>
</head>
<body>
    <h2>Write a New Post</h2>
    <form action="write_post.php" method="post">
        <label>Title:</label>
        <input type="text" name="title" required>
        <br>
        <label>Content:</label>
        <textarea name="content" required></textarea>
		<input type="hidden" name="author_id" value="<?=$user_information['user_id'];?>"> <!-- Replace with the actual user_id -->
        <br>
        <label>Status:</label>
        <select name="status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

