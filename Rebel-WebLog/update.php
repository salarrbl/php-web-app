<?php
include 'config/db.php';
session_start();
if (isset($_SESSION['login_true']) === true) {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		    $user_id = $_POST['user_id'];
			$email = mysqli_real_escape_string($conn ,$_POST['email']);
			$name  = mysqli_real_escape_string($conn, $_POST['name']);
            $sql_1 = "UPDATE `users` SET `name` = '$name', `email` = '$email' where `id` = " . intval($user_id);
			try {
				$result_1 = mysqli_query($conn, $sql_1);
				echo "updated";
			} catch (mysqli_sql_exception $e) {
				$message = $e->getMessage();
	            print($message);

			}
			exit;
	}

