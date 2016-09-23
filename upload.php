<?php

require 'core.inc.php';
require 'connect.inc.php';
if(loggedin()) {
	echo '<a href="logout.php"> Log Out </a> <br>';
	echo '<br> <a href="Profile.php"> Go back </a>';
	if(isset($_POST["upload"])&&isset($_POST["date"])) {
		$date=$_POST["date"];
		//echo "<pre>".print_r($_FILES,true)."</pre>";
		//echo $_FILES['file']['error'];
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {
			echo "<br>" . "File ". $_FILES['file']['name'] ." uploaded successfully.";
		}
		$handle = fopen($_FILES['file']['tmp_name'], "r");
		while (($emapData = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$import="INSERT into contact_bill_details(id,number,call_amount,call_timing,called_to_number,bill_issue_id,date_time,status) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$date','$emapData[6]')";
			mysql_query($import) or die(mysql_error());
		}
		fclose($handle);
		print "Import done";
	}
}

?>
<form action="upload.php" method="POST" enctype="multipart/form-data">
	Upload CSV file for particular month(Select first day of the month): <br>
	<input type="date" name="date" /> <br>
	<input type="file" name="file" id="file" size="15000" /> <br>
	<input type="submit" name="upload" value="upload" /><br>
</form>