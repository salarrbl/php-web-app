<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php
include 'header.php';
echo '<h1>Resgistration</h1>';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    try {
        $sql = "INSERT INTO `users` (username, email, password) value ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result === true){
            header("Location: login.php?msg=You have registered successfully, please login"); // Redirect to a welcome page or dashboard
        }
    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
    }
}
?>

<form action="register.php" method="post" id="registrationForm">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
	
    <label for="password">Confrim Password:</label>
    <input type="password" id="Confrimpassword" name="password" required><br><br>

    <input type="submit" value="Register"><br>
    <a href='login.php'>You've already an account?</a>
</form>
<script>
  const form = document.getElementById('registrationForm');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('ConfirmPassword');
  const errorMessage = document.getElementById('errorMessage');

  form.addEventListener('submit', function(event) {
    if (password.value !== confirmPassword.value) {
      event.preventDefault(); // Stop form submission
      errorMessage.textContent = "Passwords do not match!";
    } else {
      errorMessage.textContent = ""; // Clear error message
    }
  });
</script>
<?php
if (isset($message)) {
    echo "<p>$message</p>";
}
?>

	
</body>
</html>
