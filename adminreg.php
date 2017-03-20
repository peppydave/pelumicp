<?php

	session_start();

	include('db/authentication.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Church admin</title>
</head>
<body>
<h1>Holy Sacred Church</h1>
<marquee>come receive salvation</marquee>
<h3>Admin Login</h3>
<p>Existing User?.....Log in</p>
<?php
	if(array_key_exists('login', $_POST)){
		$error = array();

		if(empty($_POST['luname']) || empty($_POST['lpword'])){
		$error[] = "Both fields are required";
		
		}else{

		$username = mysqli_real_escape_string($db, $_POST['luname']);	
		$password = mysqli_real_escape_string($db, $_POST['lpword']);
		}
	
		if(!empty($error)){
				foreach ($error as $error) {
					# code...
					echo '<p>'.$error.'</p>';
				}
		}
		if(empty($error)){
		$query = mysqli_query($db, "SELECT * FROM admin WHERE username = '".$username."' AND password = '".$password."'") or die(mysqli_error($db)); 



				 	if(mysqli_num_rows($query) == 1){

				 		while($admin_detail = mysqli_fetch_array($query)){

				 		$_SESSION['id'] = $admin_detail['admin_id'];
				 		$_SESSION['username'] = $admin_detail['username'];
				 		header("Location:admin_home.php");
						}
				 	}
				 }else{
				 	$login_error ="Invalid Login Details";
				 	header("Location:admin_login.php?login_error=$login_error");
				 }


	}
			if (isset($_GET['login_error'])) {
				# code...
				echo $_GET['login_error'];
			}
?>
<form action="" method="post">

	<p>Username: <input type="text" name="luname"></p>
	<p>Password: <input type="Password" name="lpword"></p>
	<input type="submit" name="login" value="login">
	<hr/>
</form>
<p>Not Registered yet?.....Sign up</p>
<form action="" method="post">
<p>Name: <input type="text" name="name"></p>
<p>Address: <textarea name="address"></textarea></textarea></p>
<p>Phone number: <input type="text" name="num"></p>
<p>email: <input type="text" name="email"></p>
<p>Church Branch:<input type="text" name="branch"></p>
<p>Password: <input type="Password" name="pword"></p>
<input type="submit" name="register" value="Click to register">
</form>
</body>
</html>