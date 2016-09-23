<?php

require 'core.inc.php';
require 'connect.inc.php';

if(loggedin()) {
	//echo 'Logged in. <a href="logout.php"> Log Out </a>';
	header('Location: profile.php');
	}
else {
	include 'login.php';
	}

?>