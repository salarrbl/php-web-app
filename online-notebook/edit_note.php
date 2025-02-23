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

// Fetch the note from the database
$sql = "SELECT * FROM notes WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $note_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$note = $result->fetch_assoc();

if (!$note) {
    die("Note not found.");
}

// Handle form submission (update the note)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $content = trim($_POST["content"]);

    if (empty($title) || empty($content)) {
        $error = "Both title and content are required.";
    } else {
        $sql = "UPDATE notes SET title = ?, content = ? WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $title, $content, $note_id, $user_id);
        
        if ($stmt->execute()) {
            header("Location: view_note.php?id=" . $note_id);
            exit();
        } else {
            $error = "Error updating note. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">📒 My Notebook</a>
            <a class="btn btn-danger" href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>✏️ Edit Note</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($note['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="5" required><?= htmlspecialchars($note['content']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">💾 Save Changes</button>
            <a href="view_note.php?id=<?= $note['id'] ?>" class="btn btn-secondary">⬅️ Cancel</a>
        </form>
    </div>

</body>
</html>

