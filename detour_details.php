<?php
require 'connect.inc.php';
include 'view_details.php';
$date=$_SESSION['date'];
$o_bill_amount=0;
$p_bill_amount=0;

if(isset($_POST['todelete'])){
	//foreach($_POST['todelete'] as $delete){
	//$query2 = "UPDATE `contact_bill_details` SET `status` = '$_POST['todelete'][0]' WHERE `id`='$user_id' and `date_time`='$date'";
	$myArray=$_POST['todelete'];
	/*$i=0;
	$query2 = "select `status` from `contact_bill_details` WHERE `id`='$user_id' and `date_time`='$date'";
	if ($query_run = mysql_query($query2)) {
		$query_num_rows = mysql_num_rows($query_run);
		while($row = mysql_fetch_array($query_run)) {
			do {
				$query3 = "UPDATE `contact_bill_details` SET `status` = '$myArray[$i]' WHERE `id`='$user_id' and `date_time`='$date'";
				$query_run = mysql_query($query2);
			} while($i<$query_num_rows);
		}
	}*/
	/*$query2 = "SELECT * FROM `contact_bill_details` WHERE ";
	$item_count = count($_POST['todelete']);
	for($i = 0; $i < $item_count; $i++) {
		$itemid = (int)mysql_real_escape_string($_POST['todelete'][i]);
		$query .= '`id` = '.$itemid;
		if($i +1 < $item_count) {
			$query .= ' OR ';
		}
	}
	$r = mysql_query($query2);*/
	$index = 0;
	$q = mysql_query("SELECT `called_to_number` FROM `contact_bill_details`");
	while(list($indicator) = @mysql_fetch_row($q)) {
		mysql_query("UPDATE `contact_bill_details` SET `status`='".$myArray[$index++]."' WHERE `called_to_number`='$indicator'");
	}

}
$query = "SELECT * FROM `contact_bill_details` WHERE `id`='$user_id' and `date_time`='$date'";
if ($query_run=mysql_query($query)) {
	$query_num_rows = mysql_num_rows($query_run);
	if($query_num_rows==0) {
		echo 'No bill details for this month<br><br>';
	}
	else {
		$id=mysql_result($query_run,0,"id");
		$number=mysql_result($query_run,0,"number");
		echo '<strong> Employee ID: </strong>'.$id.'<strong> Number: </strong>'.$number.'<br><br>';
		for ($i = 0; $i < $query_num_rows; $i++) {
			$call_amount=mysql_result($query_run,$i,"call_amount");
			$call_timing=mysql_result($query_run,$i,"call_timing");
			$called_to_number=mysql_result($query_run,$i,"called_to_number");
			$bill_issue_id=mysql_result($query_run,$i,"bill_issue_id");
			$status=mysql_result($query_run,$i,"Status");
			if($status=='o') {
				$o_bill_amount+=$call_amount;
			}
			else if($status=='p') {
				$p_bill_amount+=$call_amount;
			}
			echo '<strong> Bill Issue ID: </strong>'.$bill_issue_id.'<strong> Called to number: </strong>'.$called_to_number. '<strong> Call Timing: </strong>'.$call_timing. '<strong> Call Amount: </strong>'. $call_amount. '<br>';
			if ($status=='o') {
				echo '<strong> Status: Official Call</strong>';
			}
			else if ($status=='p') {
				echo '<strong> Status: Personal Call</strong>';
			}
			echo '<br><br>';
		}
	echo '<br> <b>Official Bill amount: </b>'.$o_bill_amount.'<br><br>';
	echo '<br> <b>Personal Bill amount: </b>'.$p_bill_amount.'<br><br>';
	}
}


?>