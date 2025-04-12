<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; }
        input, textarea { display: block; margin: 10px 0; width: 100%; padding: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Contact Manager | <a href="logout.php">Logout</a></h1>   
    
    <form method="post" action="save.php">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="number" placeholder="Number">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="country" placeholder="Country">
        <textarea name="more_info" placeholder="More Information"></textarea>
        <button type="submit">Add Contact</button>
    </form>

    <input type="text" id="search" placeholder="Search..." onkeyup="searchContacts()">

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Country</th>
                <th>More Information</th>
            </tr>
        </thead>
        <tbody id="contact-list">
            <?php
			/* echo $user_id; */
$sql = "SELECT * FROM contacts WHERE user_id=$user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['number'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['country'] . "</td>";
					echo "<td>" . $row['more_info'] . "</td>";
					echo "<td>
						<a href='view.php?id=" . $row['id'] . "'>View</a> |
						<a href='edit.php?id=" . $row['id'] . "'>Edit</a> |
						<a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                    </td>";
				echo "</tr>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No contacts found.</td></tr>";
            }
?>
	<?php 
	$sql1 = "SELECT * FROM contacts 
        WHERE name LIKE '%$search%' 
        OR number LIKE '%$search%' 
        OR email LIKE '%$search%' 
        OR country LIKE '%$search%' 
        OR more_info LIKE '%$search%'";
			$resul1t = $conn->query($sql1);

			if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['number'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['country'] . "</td>";
                    echo "<td>" . $row['more_info'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No contacts found.</td></tr>";
            }

?>
        </tbody>
    </table>

    <script>
        function searchContacts() {
            const searchValue = document.getElementById('search').value;
            const rows = document.querySelectorAll('#contact-list tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        }
    </script>
</body>
</html>

