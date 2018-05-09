<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<!DOCTYPE html>
<html>
	<head>
		<title>Hope Matters</title>
		<link rel='icon' href='/images/hope_matters_logo.png'>
		<link rel='stylesheet' type='text/css' href='/css/navbar.css'>
		<link rel='stylesheet' type='text/css' href='/css/add_client.css'>
		<script src="/js/change_info_validation.js" type="text/javascript"></script>
	</head>

	
	<body style='padding-top: 70px;'>

	  <div id='container'>
		   
		  <div id='sign-out'>
			<form method='post' action='/php/dashboard.php'>
				<input type='submit' value='Dashboard'>
			</form>
		  </div>
		  
		  <div id='sign-out'>
			<form method='post' action='/php/sign_out.php'>
				<input type='submit' value='Sign Out'>
			</form>
		  </div>
		  
	  </div>
	  <br></br>


<div class='accountCard' style="width: 600px; height: 780px;">
  

<?php
require('../database_credentials.php');
session_start();

// make sure user is logged in
login_check();

$account_id = $_SESSION['account_id'];

class grab_value extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		 $_SESSION['temp'] = parent::current();
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}
	
	// make database connection
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $conn->prepare("SELECT image_path FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$image_path = $_SESSION['temp'];
	
	
	// if the employee did not upload an image, use employee_no_image 
	if ($image_path == 'no_image') {
		$image_path = '/images/employee_no_image.png';
	}
	
	
	$stmt = $conn->prepare("SELECT first_name FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$first_name = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT last_name FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$last_name = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT email FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$email = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT phone_number FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$phone_number = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT message_to_everyone FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$message_to_everyone = $_SESSION['temp'];
	
	
	echo "<form action='/php/employee_info/update_info.php' name='change_info' onsubmit='return validate_form()' method='post' enctype='multipart/form-data'>
	<div style='margin-left: 50px;'><img  src='$image_path' style='width: 500px; height: 281px;'></div>
		 <div style='margin-left: 220px;'>Add/Change Image <br><input type='file' name='employee_image' id='employee_image'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label></div><br>
	
			  <div style='width: 400px;  margin-left: 50px; margin-top: 10px; float: left;'>
				<b>First Name:</b><br>
				<input style='height: 35px;' type='text' name='first_name' value='$first_name' maxlength='25'>
				<b>Last Name:</b><br>
				<input style='height: 35px;' type='text' name='last_name' value='$last_name' maxlength='25'>
				<b>Email:</b><br>
				<input style='height: 35px;' type='text' name='email' value='$email' maxlength='45'>
				<b>Phone Number:</b><br>
				<input style='height: 35px;' type='number' name='phone_number' value='$phone_number' maxlength='11'>
				<b>Message to Everyone:</b><br>
				<textarea name='message_to_everyone' style='width: 500px; height: 75px; margin-top: 5px;'  maxlength='255'>$message_to_everyone</textarea>
				<input style='margin-left: 150px; margin-top: 20px; width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Apply Changes'>
			  </div>
		  </form>";
		  
?>	

		
  </div> 
</body>
</html>