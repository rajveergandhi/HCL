<?php
require 'core.inc.php';
require 'connect.inc.php';

if(!loggedin()) {
	if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['password'])&&isset($_POST['password_again'])&&isset($_POST['dob'])&&isset($_POST['hq_id'])&&isset($_POST['mail_id'])&&isset($_POST['contact_no'])&&isset($_POST['designation'])&&isset($_POST['address'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
		$password_hash = md5($password);
		$password_again = $_POST['password_again'];
		$dob = $_POST['dob'];
		$hq_id = $_POST['hq_id'];
		$mail_id = $_POST['mail_id'];
		$contact_no = $_POST['contact_no'];
		$designation = $_POST['designation'];
		$address = $_POST['address'];
		if(!empty($_POST['firstname'])&&!empty($_POST['lastname'])&&!empty($_POST['password'])&&!empty($_POST['password_again'])&&isset($_POST['dob'])&&!empty($_POST['hq_id'])&&!empty($_POST['mail_id'])&&!empty($_POST['contact_no'])&&!empty($_POST['designation'])&&!empty($_POST['address'])) {
			if ($password!=$password_again) {
				echo 'Passwords do not match.';
				}
			else {
			$query = "INSERT INTO `employinfo` VALUES ('','$firstname','$lastname','$password','$dob','$hq_id','$mail_id','$contact_no','$designation','$address')";
			if ($query_run = mysql_query($query)) {
				header('Location: register_success.php');
				}
			else {
				echo 'Sorry, Could not register at this time. Try again later.';
				}
			}
		}
		else {
			echo 'Fill in all the fields.';
		}
	}
}
?>

<form action="register.php" method="POST">
First Name:  <input type="text" name="firstname" value="<?php if(isset($firstname)) echo $firstname; ?>"> <br>
Last Name:  <input type="text" name="lastname" value="<?php if(isset($lastname)) echo $lastname; ?>"> <br>
Password:  <input type="password" name="password" id="password"> <br>
Password again:  <input type="password" name="password_again" id="password_again"><br>
Date of Birth:  <input type="date" name="dob" value="<?php if(isset($dob)) echo $dob; ?>"> <br>
Headquarters ID:  <input type="text" name="hq_id" value="<?php if(isset($hq_id)) echo $hq_id; ?>"> <br>
Email ID:  <input type="email" name="mail_id" value="<?php if(isset($mail_id)) echo $mail_id; ?>"> <br>
Contact Number:  <input type="tel" name="contact_no" value="<?php if(isset($contact_no)) echo $contact_no; ?>"> <br>
Designation:  <input type="textarea" rows="30" columns="10" name="designation" value="<?php if(isset($designation)) echo $designation; ?>"> <br>
Address:  <input type="textarea" rows="30" columns="10" name="address" value="<?php if(isset($address)) echo $address; ?>"> <br>
<br> <input type="submit" name="register" value="Register"><br>
</form>


<!DOCTYPE html>
<html>
	<body>

		<button OnClick="GetRandom()" type="button">Generate Random Password</button>
		<br /> <br />
		Password Generated: <div id="demo"> </div>
		<script>
			function generatePassword() {
				var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

			for( var i=0; i < 8; i++ )
				text += possible.charAt(Math.floor(Math.random() * possible.length));
			return text;
		}
		function GetRandom()    {
			var myElement = document.getElementById("password")
			myElement.value = generatePassword()
			var myElement2 = document.getElementById("password_again")
			myElement2.value = myElement.value
			document.getElementById("demo").innerHTML = myElement.value;
		}

		</script>
	</body>
</html>
