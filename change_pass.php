<?php
require 'core.inc.php';
require 'connect.inc.php';

if(loggedin()) {
	if(isset($_POST['oldpassword'])&&isset($_POST['newpassword'])&&isset($_POST['newpasswordagain'])) {
		$oldpassword = $_POST['oldpassword'];
		$newpassword = $_POST['newpassword'];
		$newpasswordagain = $_POST['newpasswordagain'];
		if(!empty($_POST['oldpassword'])&&!empty($_POST['newpassword'])&&!empty($_POST['newpasswordagain'])) {
			if ($newpassword!=$newpasswordagain) {
				echo 'Passwords do not match.';
			}
			else {
				$user_id=$_SESSION['user_id'];
				$query = "SELECT * FROM `employinfo` WHERE `id`='$user_id'";
				if ($query_run=mysql_query($query)) {
					$query_num_rows = mysql_num_rows($query_run);
					if($query_num_rows==0) {
						echo 'No result.';
					}
					else {
						$password=mysql_result($query_run,0,"password");
						if($oldpassword==$password) {
							$query2 = "UPDATE `employinfo` SET `password` = '$newpassword' WHERE `id`='$user_id'";
							if ($query_run = mysql_query($query2)) {
								Header('Location: changed.php');
							}
							else {
								echo 'Sorry, Could not change password at this time. Try again later.';
							}
						}
						else {
							echo 'Old password entered is wrong.';
						}
					}
				}
				else {
					echo mysql_error();
				}
			}
		}
		else {
			echo 'Fill in all the fields.';
		}
	}
}
			
?>

<form action="change_pass.php" method="POST">
	Old Password: <input type="password" name="oldpassword"> <br>
	New Password: <input type="password" name="newpassword"> <br>
	New Password again: <input type="password" name="newpasswordagain"> <br>
	<input type="submit" name="submit" value="submit">
</form>