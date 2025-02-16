<?php
include 'db.php';

if (isset($_GET['token'])) {
    $token = $conn->real_escape_string($_GET['token']);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "UPDATE users SET password='$newPassword', reset_token=NULL WHERE reset_token='$token'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Password reset successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "Invalid token!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Enter New Password</h2>
    <form method="POST">
        <input type="password" name="password" placeholder="New Password" required><br>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>

