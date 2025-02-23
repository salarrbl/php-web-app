<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php'; // Database connection

$user_id = $_SESSION['user_id'];

// Fetch **pending** and **completed** notes separately
$sql_pending = "SELECT * FROM notes WHERE user_id = ? AND completed = 0 ORDER BY created_at DESC";
$stmt = $conn->prepare($sql_pending);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_pending = $stmt->get_result();
$pending_notes = $result_pending->fetch_all(MYSQLI_ASSOC);

$sql_completed = "SELECT * FROM notes WHERE user_id = ? AND completed = 1 ORDER BY created_at DESC";
$stmt = $conn->prepare($sql_completed);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_completed = $stmt->get_result();
$completed_notes = $result_completed->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - My Notes</title>
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
        <h2>📌 Pending Notes</h2>
        <?php if (empty($pending_notes)): ?>
            <div class="alert alert-warning">No pending notes. Start writing!</div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($pending_notes as $note): ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($note['title']) ?></h5>
                                <p class="card-text"><?= nl2br(htmlspecialchars(substr($note['content'], 0, 100))) ?>...</p>
                                <p class="text-muted"><small>Created: <?= $note['created_at'] ?></small></p>
                                <a href="view_note.php?id=<?= $note['id'] ?>" class="btn btn-primary btn-sm">View</a>
                                <a href="edit_note.php?id=<?= $note['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="note_del.php?id=<?= $note['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                <a href="complete_note.php?id=<?= $note['id'] ?>" class="btn btn-success btn-sm">✔ Mark as Completed</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <h2 class="mt-4">✅ Completed Notes</h2>
        <?php if (empty($completed_notes)): ?>
            <div class="alert alert-info">No completed notes yet.</div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($completed_notes as $note): ?>
                    <div class="col-md-4">
                        <div class="card mb-3 border-success">
                            <div class="card-body">
                                <h5 class="card-title text-success"><?= htmlspecialchars($note['title']) ?></h5>
                                <p class="card-text text-success"><?= nl2br(htmlspecialchars(substr($note['content'], 0, 100))) ?>...</p>
                                <p class="text-muted"><small>Created: <?= $note['created_at'] ?></small></p>
                                <a href="view_note.php?id=<?= $note['id'] ?>" class="btn btn-secondary btn-sm">View</a>
                                <a href="note_del.php?id=<?= $note['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this completed note?')">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>

