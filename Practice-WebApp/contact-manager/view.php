<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch contact data
    $sql = "SELECT * FROM contacts WHERE id = $id AND user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $contact = $result->fetch_assoc();
    } else {
        echo "Contact not found.";
        exit();
    }
} else {
    echo "No contact ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Contact</title>
</head>
<body>
    <h1>View Contact</h1>
    <p><strong>Name:</strong> <?php echo $contact['name']; ?></p>
    <p><strong>Number:</strong> <?php echo $contact['number']; ?></p>
    <p><strong>Email:</strong> <?php echo $contact['email']; ?></p>
    <p><strong>Country:</strong> <?php echo $contact['country']; ?></p>
    <p><strong>More Information:</strong> <?php echo $contact['more_info']; ?></p>
    <a href="dashboard.php">Back to Contacts</a>
</body>
</html>

