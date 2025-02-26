<?php
include './config/db.php';

if (isset($_GET['token'])) {
    $token = $conn->real_escape_string($_GET['token']);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "UPDATE users SET password_hash='$newPassword', token=NULL WHERE token='$token'";
        
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
	<p style="color: red" >We Send verify token to your Email</p>
	/* <p style="color: red" >You Most use this model `reset_password.php?token=$token`</p> */
    <a href='reset_password.php?token=$token'>Reset Password</a>";
    <h2>Enter New Password</h2>
    <form method="POST">

        <input type="password" name="password" placeholder="New Password" required><br>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>

