<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php'; // Database connection

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid note ID.");
}
$note_id = $_GET['id'];

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Note</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">📒 My Notebook</a>
            <a class="btn btn-light" href="add_note.php">➕ Add Note</a>
            <a class="btn btn-danger" href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2><?= htmlspecialchars($note['title']) ?></h2>
        <p class="text-muted">Created on: <?= $note['created_at'] ?></p>
        <hr>
        <p><?= nl2br(htmlspecialchars($note['content'])) ?></p>

        <a href="dashboard.php" class="btn btn-secondary">⬅️ Back</a>
        <a href="edit_note.php?id=<?= $note['id'] ?>" class="btn btn-warning">✏️ Edit</a>
		<a href="note_del.php?id=<?= $note['id'] ?>" class="btn btn-danger"  onclick="return confirm('Are you sure you want to delete this note?')">🗑️ Delete</a>

    </div>

</body>
</html>

