<?php

require 'core.inc.php';
require 'connect.inc.php';
if(loggedin()) {
	echo '<a href="logout.php"> Log Out </a> <br>';
	$user_id=$_SESSION['user_id'];
	$query = "SELECT * FROM `employinfo` where `id`='$user_id'";
	if ($query_run=mysql_query($query)) {
		$query_num_rows = mysql_num_rows($query_run);
		if($query_num_rows==0) {
			echo 'No result.';
		}
		else {
			$id=mysql_result($query_run,0,"id");
			$dob=mysql_result($query_run,0,"dob");
			$mail_id=mysql_result($query_run,0,"mail_id");
			$contact_no=mysql_result($query_run,0,"contact_no");
			$designation=mysql_result($query_run,0,"designation");
			$address=mysql_result($query_run,0,"address");
			echo '<strong> Date Of Birth: </strong>'.$dob.'<strong> Email ID: </strong>'.$mail_id.'<strong> Contact Number: </strong>'.$contact_no.'<strong> Designation: </strong>'.$designation. '<strong> Address: </strong>'.$address.' <br>';
			echo '<br> <a href="Profile.php"> Go back </a>';
		}		
	}
	else {
		echo mysql_error();
	}
}
