<?php
	session_start();

	include('db/authentication.php');

	authenticate();

	$id = $_SESSION['id'];

	$username = $_SESSION['username'];


?>
<!DOCTYPE html>
<html>
<head>
	<title>admin home</title>
</head>
<body>
	<a href="addmember.php">Add a new member</a>
	<a href="logout.php">LOGOUT</a>

	<?php

	echo '<p>WELCOME</p>';
	echo "<p>ID: <strong>$id</strong></p>";
	echo "<p>Username: <strong>$username</strong></p>";
	?>
</body>
</html>