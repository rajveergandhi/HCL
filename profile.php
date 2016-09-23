<?php

require 'core.inc.php';
require 'connect.inc.php';
if(loggedin()) {
	echo '<a href="logout.php"> Log Out </a> <br />';
	$user_id=$_SESSION['user_id'];
	$query = "SELECT * FROM `employinfo` where `id`='$user_id'";
	
	if ($query_run=mysql_query($query)) {
		$query_num_rows = mysql_num_rows($query_run);
		if($query_num_rows==0) {
			echo 'No result.';
		}
		else {
			$id=mysql_result($query_run,0,"id");
			$firstname=mysql_result($query_run,0,"firstname");
			$lastname=mysql_result($query_run,0,"lastname");
			$hq_id=mysql_result($query_run,0,"hq_id");
			echo '<strong>Employee ID: </strong>'.$id.'<strong> First name: </strong>'.$firstname.'<strong> Last name: </strong>'.$lastname.'<strong> Headquarters ID: </strong>'.$hq_id;
		}		
	}
	else {
		echo mysql_error();
	}
}
echo '<br> <a href="view_details.php"> View bill details </a>';
echo '<br> <a href="Personal_Details.php"> Personal Details </a>';
echo '<br> <a href="upload.php"> Upload a file </a>';
echo '<br> <a href="change_pass.php"> Change Password </a>';
?>
