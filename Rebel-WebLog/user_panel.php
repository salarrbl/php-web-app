<?php
include 'config/db.php';
session_start();
if (isset($_SESSION['login_true']) === true) {
	try {
        $sql = "select * from `users` where id = " . $_SESSION['user_id'];
        $result = mysqli_query($conn, $sql);
        $user_information = mysqli_fetch_assoc($result);

    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['email'])) {
		    $user_id = $_POST['user_id'];
			$email = mysqli_real_escape_string($conn ,$_POST['email']);
			$name  = mysqli_real_escape_string($conn, $_POST['name']);
            $sql_1 = "UPDATE `users` SET `name` = '$name', `email` = '$email' where `id` = " . intval($_SESSION['user_id']);
			
			try {
				$result_1 = mysqli_query($conn, $sql_1);
				header("Location: user_panel.php");
			} catch (mysqli_sql_exception $e) {
				$message = $e->getMessage();
	            print($message);

			}
			exit;
	}
	if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["current-password"]) && isset($_POST['new-password'])) {
		$current_pass = $_POST['current-password'];
		$new_pass = password_hash($_POST['new-password'], PASSWORD_BCRYPT);
		if(password_verify($_POST['current-password'], $user_information['password_hash'])) {
            $sql_2 = "UPDATE `users` SET `password_hash` = '$new_pass' where `id` = " . intval($_SESSION['user_id']);
			try {
				$result_2 = mysqli_query($conn, $sql_2);
				/* echo "Change the password"; */
				header("Location: user_panel.php");
			} catch (mysqli_sql_exception $e) {
				$message = $e->getMessage();
				print($message);
			}
			exit;
		}
	}

?>

<!DOCTYPE html>

<html lang="en">
<link rel="stylesheet" href="templates/sytle.css">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>user panel</title>
</head>
<body>
	
<div>
   <!-- Sidebar -->
    <div class="sidebar">
        <h2>User Panel</h2>
        <ul>
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="#profile">Edit Profile</a></li>
			<li><a href="#posts">my articles</a></li>
			<li><a href="write_post.php">New post</a></li>
            <li><a href="#comments">my Comments</a></li>
            <li><a href="#security">security</a></li>
            <li><a href="./logout.php">logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard -->
           <h2>داشبورد</h2>
			<img src="./statics/image/" alt="">
			<?php if (!empty($uploadedFile)): ?>
					<h3>Uploaded Image:</h3>
					<img src="<?= htmlspecialchars($uploadedFile) ?>" alt="Uploaded Image" width="300">
			<?php endif; ?>
			<p>Welcome <strong><?php echo $_SESSION['user_name']?></strong>!</p>
            <p>تعداد مقالات منتشرشده: ۵</p>
        </section>

        <!-- Profile Edit -->
        <section id="profile" class="card">
            <h2>Edit Profile</h2>
            <form method="POST" action="user_panel.php">
				<input type="hidden" name="user_id" value="<?=$user_information['user_id'];?>"> <!-- Replace with the actual user_id -->
                <label for="name">Name:</label>
				<input type="text" id="name" name="name" value="<?=$user_information['name'];?>">
                <label for="email">Email:</label>
				<input type="email" id="email" name="email" value="<?=$user_information['email'];?>">
                <button type="submit" class="btn">Save Changes</button>
            </form>
        </section>

        <!-- Change Password -->
        <section id="security" class="card">
            <h2>تغییر رمز عبور</h2>
            <form action="user_panel.php" method="POST" >
                <label for="current-password">رمز عبور فعلی:</label>
                <input type="password" id="current-password" name="current-password" required>
                <label for="new-password">رمز عبور جدید:</label>
                <input type="password" id="new-password" name="new-password" required>
                <button type="submit" class="btn">تغییر رمز عبور</button>
            </form>
        </section>

        <!-- User Posts -->
        <section id="posts" class="card">
            <h2>مقالات من</h2>
            <table>
                <thead>
                    <tr>
                        <th>عنوان</th>
                        <th>وضعیت</th>
                        <th>تاریخ انتشار</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>مقاله اول</td>
                        <td>منتشر شده</td>
                        <td>۱۴۰۲/۰۱/۰۱</td>
                        <td><a href="#">ویرایش</a> | <a href="#">حذف</a></td>
                    </tr>
                    <tr>
                        <td>مقاله دوم</td>
                        <td>پیش‌نویس</td>
                        <td>-</td>
                        <td><a href="#">ویرایش</a> | <a href="#">حذف</a></td>
                    </tr>
                </tbody>
            </table>
            <button class="btn">ایجاد مقاله جدید</button>
        </section>

        <!-- User Comments -->
        <section id="comments" class="card">
            <h2>نظرات من</h2>
            <table>
                <thead>
                    <tr>
                        <th>مقاله</th>
                        <th>نظر</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>مقاله اول</td>
                        <td>این یک نظر تستی است.</td>
                        <td>تأیید شده</td>
                        <td><a href="#">ویرایش</a> | <a href="#">حذف</a></td>
                    </tr>
                    <tr>
                        <td>مقاله دوم</td>
                        <td>این نظر در انتظار تأیید است.</td>
                        <td>در انتظار تأیید</td>
                        <td><a href="#">ویرایش</a> | <a href="#">حذف</a></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</div>
<?php } else { ?>
<p>Redirecting you to login page...</p>
<script>
    setTimeout(function () {
        window.location.href = '/login.php';

        document.body.innerHTML = '<p>You are now being redirected to the new page.</p>';
    }, 1000); 
</script>
<?php } ?>
</body>
</html>
