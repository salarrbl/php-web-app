<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="templates/sytle.css">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>user panel</title>
</head>
<body>
	
<?php
include 'config/db.php';
session_start();
/* $user_nameA = $_SESSION['user_name']; */
/* $sqll = "SELECT * FROM users WHERE username = '$user_nameA'"; */
/* $result_a = mysqli_query($conn, $sqll); */
/* $roww = mysqli_fetch_assoc($result_a); */
/* echo ($roww); */
/* print_r($roww); */
if (isset($_SESSION['login_true']) === true) {
?>
<div>
   <!-- Sidebar -->
    <div class="sidebar">
        <h2>User Panel</h2>
        <ul>
            <li><a href="#dashboard">داشبورد</a></li>
            <li><a href="#profile">ویرایش پروفایل</a></li>
            <li><a href="#posts">مقالات من</a></li>
            <li><a href="#comments">نظرات من</a></li>
            <li><a href="#security">امنیت</a></li>
            <li><a href="#logout">خروج</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard -->
        <section id="dashboard" class="card">
            <h2>داشبورد</h2>
			<p>Welcome <strong><?php echo $_SESSION['user_name']?></strong>!</p>
            <p>تعداد مقالات منتشرشده: ۵</p>
        </section>

        <!-- Profile Edit -->
        <section id="profile" class="card">
            <h2>ویرایش پروفایل</h2>
            <form>
                <label for="name">نام:</label>
                <input type="text" id="name" name="name" value="نام کاربر">
                <label for="email">ایمیل:</label>
                <input type="email" id="email" name="email" value="user@example.com">
                <button type="submit" class="btn">ذخیره تغییرات</button>
            </form>
        </section>

        <!-- Change Password -->
        <section id="security" class="card">
            <h2>تغییر رمز عبور</h2>
            <form>
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
    // Delay the redirection for 3 seconds (adjust as needed)
    setTimeout(function () {
        // Specify the URL you want to redirect to
        window.location.href = '/login.php';

        // Display a message (optional)
        document.body.innerHTML = '<p>You are now being redirected to the new page.</p>';
    }, 3000); // 3000 milliseconds (3 seconds)
</script>
<?php } ?>
</body>
</html>
