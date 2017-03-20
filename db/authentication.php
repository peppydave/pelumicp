<?php
$db = mysqli_connect("localhost","root","peppydev","church") or die (mysqli_error()); 

	function authenticate(){


		if(!isset($_SESSION['id']) && !isset($_SESSION['username'])){
				
		header("Location:adminreg.php");

}
}


?>