<?php
include 'db.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $token = bin2hex(generateRandomString(50));

    $sql = "UPDATE users SET reset_token='$token' WHERE email='$email'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Password reset link: <a href='reset_password.php?token=$token'>Reset Password</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST" action="reset.php">
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Send Reset Link</button>
    </form>
    <a href="login.php">Back to Login</a>
</body>
</html>

