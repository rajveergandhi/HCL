<?php
require 'core.inc.php';
require 'connect.inc.php';
$bill_amount=0;
if(loggedin()) {
	$user_id=$_SESSION['user_id'];
	if (isset($_POST['date'])) {
		$date=$_POST['date'];
		if (!empty($date)) {
			$_SESSION['date']=$date;
			$query = "SELECT * FROM `contact_bill_details` WHERE `id`='$user_id' and `date_time`='$date'";
			if ($query_run=mysql_query($query)) {
			$query_num_rows = mysql_num_rows($query_run);
				if($query_num_rows==0) {
					echo 'No bill details for this month<br><br>';
				}
			else {
				echo '<form method="post" action="detour_details.php">';
				$id=mysql_result($query_run,0,"id");
				$number=mysql_result($query_run,0,"number");
				echo '<strong> Employee ID: </strong>'.$id.'<strong> Number: </strong>'.$number.'<br><br>';
				for ($i = 0; $i < $query_num_rows; $i++) {
					$call_amount=mysql_result($query_run,$i,"call_amount");
					$call_timing=mysql_result($query_run,$i,"call_timing");
					$called_to_number=mysql_result($query_run,$i,"called_to_number");
					$bill_issue_id=mysql_result($query_run,$i,"bill_issue_id");
					$bill_amount+=$call_amount;
					echo '<strong> Bill Issue ID: </strong>'.$bill_issue_id.'<strong> Called to number: </strong>'.$called_to_number. '<strong> Call Timing: </strong>'.$call_timing. '<strong> Call Amount: </strong>'. $call_amount.'<br>';
					echo 'Status of call(All set as official by default) : Official: <input type="checkbox" value="o" name="todelete[]"/> Personal: <input type="checkbox" value="p" name="todelete[]"/>';
					echo '<br><br>';
				}
				echo '<input type="submit" name="submit" value="Submit"/>';
				echo '</form>';
				echo '<br> <b>Total bill amount: </b>'.$bill_amount.'<br><br>';
			}
		}
		else {
			echo mysql_error();
			}
		}
	}
	echo '<a href="logout.php"> Log Out </a> <br>';
	echo '<a href="Profile.php"> Go back </a>';
}
	
?>
<form action="view_details.php" method="POST">
	View bill details of particular month (Select first day of the month for that months details): <br>
	<input type="date" name="date"> <br>
	<input type="submit" name="register" value="View Details"><br>
</form>