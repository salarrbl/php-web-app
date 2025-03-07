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
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $more_info = $_POST['more_info'];

    // Update contact
    $sql = "UPDATE contacts SET name = ?, number = ?, email = ?, country = ?, more_info = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssi', $name, $number, $email, $country, $more_info, $id, $user_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
</head>
<body>
    <h1>Edit Contact</h1>

    <form method="post">
        <input type="text" name="name" value="<?php echo $contact['name']; ?>" required>
        <input type="text" name="number" value="<?php echo $contact['number']; ?>">
        <input type="email" name="email" value="<?php echo $contact['email']; ?>">
        <input type="text" name="country" value="<?php echo $contact['country']; ?>">
        <textarea name="more_info"><?php echo $contact['more_info']; ?></textarea>
        <button type="submit">Update Contact</button>
    </form>
</body>
</html>

