<?php
include './config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* $email = $conn->real_escape_string($_POST['email']); */
    $name = $conn->real_escape_string($_POST['name']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE name='$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
		if (password_verify($password, $row['password_hash'])) {
			$_SESSION['login_true'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header('Location: user_panel.php');
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this email!";
    }
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="./templates/login.css">
<head>
    <title>Login</title>
</head>
<body>
   <div>
 <h2>Login</h2>
    <form method="POST" action="login.php">
        <input type="name" name="name" placeholder="Name" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <a href="signup.php">Create an account</a>
    <a href="reset.php">Forgot Password?</a>
</div>
</body>
</html>

