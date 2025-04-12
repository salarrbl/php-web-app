<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php'; // Ensure this file connects to MySQLi

$user_id = $_SESSION['user_id'];

// Fetch notes for the logged-in user
$sql = "SELECT * FROM notes WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Store notes in an array
$notes = [];
while ($row = $result->fetch_assoc()) {
    $notes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">📒 My Notebook</a>
            <a class="btn btn-light" href="a./dd_note.php">➕ Add Note</a>
            <a class="btn btn-danger" href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>📝 My Notes</h2>

        <?php if (empty($notes)): ?>
            <div class="alert alert-warning">No notes found. <a href="add_note.php">Add your first note!</a></div>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($notes as $note): ?>
                    <a href="view_note.php?id=<?= $note['id'] ?>" class="list-group-item list-group-item-action">
                        <h5><?= htmlspecialchars($note['title']) ?></h5>
                        <p class="mb-1"><?= nl2br(htmlspecialchars(substr($note['content'], 0, 100))) ?>...</p>
                        <small class="text-muted">Created: <?= $note['created_at'] ?></small>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>

