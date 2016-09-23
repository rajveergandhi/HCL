<?php
if (isset($_POST['username'])&&isset($_POST['password'])) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$password_hash = md5($password);
		
	if (!empty($username)&&!empty($password)) {
	
		$query = "SELECT `id` FROM `employinfo` WHERE `id`='$username' AND `password`='$password'";
		if ($query_run=mysql_query($query)) {
			$query_num_rows = mysql_num_rows($query_run);
			
			if($query_num_rows==0) {
				echo 'Invalid username/password combination';
				}
			
			else if($query_num_rows==1) {
				$user_id = mysql_result($query_run,0,'id');
				$_SESSION['user_id']=$user_id;
				echo 'login successful! Sending you to the login page...';
				header( "refresh:5;url=profile.php" );
				//header('Location: index.php');
				}
			}
		else {
			echo mysql_error();
			}
		}
	else {
		echo 'Please enter username and password.';
		}
	}
	


	
?>

<form action="<?php echo $current_file; ?>" method="POST">
	Employee ID : <input type="text" name="username"> Password: <input type="password" name="password">
	<input type="submit" value="log in">
</form>
<form action="register.php" method="POST">
	<input type="submit" value="register">
</form>
<form action="forgotpassword.php" method="POST">
	<input type="submit" value="Forgot Password">
</form>
