<?php
include './config/db.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $token = bin2hex(generateRandomString(50));
	/* echo  "$token"; */

    $sql = "UPDATE users SET token='$token' WHERE email='$email'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Password reset link: <a href='reset_password.php?token=$token'>Reset Password</a>";
		/* header('Location: reset_password.php'); */
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="./templates/login.css">
<head>
    <title>Reset Password</title>
</head>
<body>
<div>
<h2>Reset Password</h2>
    <form method="POST" action="reset.php">
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Send Reset Link</button>
    </form>
    <a href="login.php">Back to Login</a>

</div>
</body>
</html>

