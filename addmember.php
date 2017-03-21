<?php
	session_start();

	include('db/authentication.php');

	authenticate();

	$gender = array("M", "F");

	$dept = array("Ushering", "Choir", "Prayer", "Children", "Evangelism");


?>
<!DOCTYPE html>
<html>
<head>
	<title>Register member</title>
</head>
<body>

<?php
	if(array_key_exists('add', $_POST)){

		$error = array();

		if (empty($_POST['name']) || empty($_POST['gender']) || empty($_POST['dob']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['phone']) || empty($_POST['held']) || empty($_POST['dept'])) {

			$error[] ="* You're missing some fields";

		} else{

			$name = mysqli_real_escape_string($db,$_POST['name']);
					$gender = mysqli_real_escape_string($db,$_POST['gender']);
				
					$dob = mysqli_real_escape_string($db,$_POST['dob']);
					$email = mysqli_real_escape_string($db,$_POST['email']);
					$address = mysqli_real_escape_string($db,$_POST['address']);
					$phone = mysqli_real_escape_string($db,$_POST['phone']);
					$held = mysqli_real_escape_string($db,$_POST['held']);
					$dept = mysqli_real_escape_string($db,$_POST['dept']);
			# code...
		}
		if(empty($error)){

			$insert = mysqli_query($db, "INSERT INTO member VALUES(NULL,
				'".$name."',
				'".$gender."',
				'".$dob."','
				'".$email."',
				'".$address."',
				'".$phone."',
				'".$held."',
				'".$dept."',
				NOW ())
				") or die(mysqli_error($db));

			$success = "Successfuly Added";
					header("Location:addmember.php?success=$success");
						
				}	else	{
					
					
				foreach($error as $error){
					
				echo "<p> $error </p>";
		}
		}

	}
if(isset($_GET['success'])){
			
		echo '<em>'.$_GET['success'].'</em>';
			
		}



?>

	<form action="" method="post">

	Name: <input type="text" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>"/>
	<br/>

	<select name="gender" class="txt">
        
  	<option value="">Select Gender</option>
                        
  	<?php foreach($gender as $gender){ ?>
                        
  	<option value="<?php echo $gender?>" <?php if(isset($_POST['gender']) && $_POST['gender'] == $gender) {
	  
	echo "selected = 'selected'"; } ?>> 
	
	<?php echo $gender?> 
    
    </option>
                        
    <?php } ?> 
                        
    </select><br />
		<p>DOB: <input type="date" name="dob" value="YYYY-MM-DD">

		
   </p>
   <p>Email: <input type="text" name="email" value="<?php if(isset($_POST['name'])){ echo $_POST ['email'];}?>"></p>
	<p>Address: <textarea rows="5" cols="20" name="address"><?php if(isset($_POST['address'])){echo $_POST ['address'];}?> </textarea><br/></p>
	<p>Phone number:<input type="text" name="phone"></p>
	<p>Post Held: <input type="text" name="held"></p>
	<p>Department: <select name="dept">
	<?php foreach($dept as $dept){ ?>

	<option value="<?php echo $dept?>" <?php if(isset($_POST['$dept']) && $_POST['$dept'] == $dept) {
	  
	echo "selected = 'selected'"; } ?>> 
	
	<?php echo $dept?> 
    
    </option>
                        
    <?php } ?> 
                        
    </select><br />

    	<input type="submit" name="add" value="Register New member">

	
	</form>

</body>
</html>