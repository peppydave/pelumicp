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

		if (empty($_POST['name']) || empty($_POST['gender']) || empty($_POST['year']) || empty($_POST['month']) || empty($_POST['day']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['phone']) || empty($_POST['dept'])) {

			$error[] ="* You're missing some fields";

		} else{

			$name = mysqli_real_escape_string($db,$_POST['name']);
					$gender = mysqli_real_escape_string($db,$_POST['gender']);
				
					$year = mysqli_real_escape_string($db,$_POST['year']);
					$month = mysqli_real_escape_string($db,$_POST['month']);
					$day = mysqli_real_escape_string($db,$_POST['day']);
					$email = mysqli_real_escape_string($db,$_POST['email']);
					$address = mysqli_real_escape_string($db,$_POST['address']);
					$phone = mysqli_real_escape_string($db,$_POST['phone']);
					$dept = mysqli_real_escape_string($db,$_POST['dept']);
			# code...
		}
		if(empty($error)){

			$insert = mysqli_query($db, "INSERT INTO member VALUES(NULL,
				'".$gender."',
				'".$year."',
				'".$month."',
				'".$day."',
				'".$email."',
				'".$address."',
				'".$phone."',
				NULL,
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

	<p>Gender: <select name="gender">

	<option value="">Select Gender</option>

	<?php foreach ($gender as $gender) { ?>

	<option value="<?php echo $gender?>" <?php if(isset($_POST['gender']) && $_POST['gender'] == $gender) {
		echo "selected = 'selected'";  }?>> 
	
		<?php echo $gender?> 

		</option>
		</select>
		<?php } ?>
		<hr/>
		<p>DOB: <select name="dob">
		<option value="">DOB(YYYY)</option>
        
    <?php for($year=1900; $year<=2016; $year++){ ?>
                        
 <option value="<?php echo $year ?>"<?php if(isset($_POST['year']) && $_POST['year'] == $year)

{echo 'checked ="checked"';} ?>>
                                
    <?php echo $year ?>

    <?php } ?>

    </select>
                
    <select name="month" class="dob">
    
    <option value="">DOB(MM)</option>
        				
    <?php for($month=1; $month<=12; $month++){ ?>
                        
<option value="<?php echo $month ?>"<?php if(isset($_POST['month']) && $_POST['month'] == 

$month){ echo 'checked = "checked"'; }?>>	
	
	<?php echo $month ?>
                        
    </option>
                        
    <?php }?>
        
    </select>

   
                
   <select name="day">
   
   <option value="">DOB(DD)</option>
        				
   <?php for($day=1; $day<=31; $day++){ ?>
                        
<option value="<?php echo $day ?>"<?php if(isset($_POST['day']) && $_POST['day'] == $day){echo 

'checked = "checked"';} ?>>
                                
   <?php echo $day ?>
                                
   </option>
                                
   <?php } ?>
                        
   </select><br />
   </p>

		
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