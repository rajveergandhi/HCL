<?php
require 'core.inc.php';
require 'connect.inc.php';

if(!loggedin()) {
	if(isset($_POST['id'])&&isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['dob'])&&isset($_POST['hq_id'])&&isset($_POST['mail_id'])&&isset($_POST['contact_no'])) {
		$id=$_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$dob = $_POST['dob'];
		$hq_id = $_POST['hq_id'];
		$mail_id = $_POST['mail_id'];
		$contact_no = $_POST['contact_no'];
		if(!empty($_POST['id'])&&!empty($_POST['firstname'])&&!empty($_POST['lastname'])&&isset($_POST['dob'])&&!empty($_POST['hq_id'])&&!empty($_POST['mail_id'])&&!empty($_POST['contact_no'])) {
			$query = "SELECT `password` FROM `employinfo` WHERE `id`='$id' AND `firstname`='$firstname' AND `lastname`='$lastname' AND `dob`='$dob' AND `hq_id`='$hq_id' AND `mail_id`='$mail_id' AND `contact_no`='$contact_no'";
			if ($query_run=mysql_query($query)) {
				$query_num_rows = mysql_num_rows($query_run);
			
				if($query_num_rows==0) {
					echo 'Wrong details entered.';
					}
				else if($query_num_rows==1) {
					$password=mysql_result($query_run,0,"password");
					echo 'Your password is: <b>'.$password.'</b> redirecting to login page in 5 seconds...';
					header('refresh:5;url=login.php');
					}
				}
			else {
				echo mysql_error();
			}
		}
	else {
		echo 'Please enter all details.';
		}
	}
}
?>

<form action="forgotpassword.php" method="POST">
Employee ID:  <input type="text" name="id" value="<?php if(isset($id)) echo $id; ?>"> <br>
First Name:  <input type="text" name="firstname" value="<?php if(isset($firstname)) echo $firstname; ?>"> <br>
Last Name:  <input type="text" name="lastname" value="<?php if(isset($lastname)) echo $lastname; ?>"> <br>
Date of Birth:  <input type="date" name="dob" value="<?php if(isset($dob)) echo $dob; ?>"> <br>
Headquarters ID:  <input type="text" name="hq_id" value="<?php if(isset($hq_id)) echo $hq_id; ?>"> <br>
Email ID:  <input type="email" name="mail_id" value="<?php if(isset($mail_id)) echo $mail_id; ?>"> <br>
Contact Number:  <input type="tel" name="contact_no" value="<?php if(isset($contact_no)) echo $contact_no; ?>"> <br>
<br> <input type="submit" name="submit"><br>
</form>