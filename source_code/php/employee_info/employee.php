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
		  
		  <div style='float: left;  width: 300px;'>
			<form method='post' action='employee_list.php'>
				<input style='width: 300px;' type='submit' value='Employee Selection'>
			</form>
		  </div>
		  
	  </div>
	  <br></br>


<div class='accountCard' style="width: 600px; height: 730px;">
  

<?php
require('../database_credentials.php');
session_start();

// make sure user is logged in
login_check();

$choosen_employee_id = $_SESSION['choosen_employee_id'];

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
	
	$stmt = $conn->prepare("SELECT image_path FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$image_path = $_SESSION['temp']; 
	
	
	// if the employee did not upload an image, use employee_no_image
	if ($image_path == 'no_image') {
		$image_path = '/images/employee_no_image.png';
	}
	
	
	$stmt = $conn->prepare("SELECT username FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$username = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT first_name FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$first_name = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT last_name FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$last_name = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT job_title FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$job_title = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT work_location FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$work_location = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT normal_work_hours FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$normal_work_hours = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT email FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$email = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT phone_number FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$phone_number = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT message_to_everyone FROM accounts WHERE account_id='$choosen_employee_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
	}
	$message_to_everyone = $_SESSION['temp'];
	
	
	
	echo "<div style='margin-left: 50px;'><img  src='$image_path' style='width: 500px; height: 281px;'></div>
	
		<div style='width: 200px;  margin-left: 50px; margin-top: 50px; float: left;'>
			<div style='height: 15px; width: 200px;'><b>Username:</b></div><br>
			<div style='height: 15px; width: 200px;'><b>First Name:</b></div><br>
			<div style='height: 15px; width: 200px;'><b>Last Name:</b></div><br>
			<div style='height: 15px; width: 200px;'><b>Job Title:</b></div><br>
			<div style='height: 15px; width: 200px;'><b>Work Location:</b></div><br>
			<div style='height: 15px; width: 200px;'><b>Normal Work Hours:</b></div><br>
			<div style='height: 15px; width: 200px;'><b>Email:</b></div><br>
			<div style='height: 15px; width: 200px;'><b>Phone Number:</b></div><br>
			<div style='height: 15px; width: 200px;'><b>Message to Everyone:</b></div><br>
		  </div>
		  
		  <div style='width: 300px; margin-top: 50px; float: left; '>
			<div style='height: 15px; width: 300px;'>$username</div><br>
			<div style='height: 15px; width: 300px;'>$first_name</div><br>
			<div style='height: 15px; width: 300px;'>$last_name</div><br>
			<div style='height: 15px; width: 300px;'>$job_title</div><br>
			<div style='height: 15px; width: 300px;'>$work_location</div><br>
			<div style='height: 15px; width: 300px;'>$normal_work_hours</div><br>
			<div style='height: 15px; width: 300px;'>$email</div><br>
			<div style='height: 15px; width: 300px;'>$phone_number</div><br>
		  </div>
	
		  <div style='width: 500px; height: 125px; margin-left: 50px; float: left;'>
			$message_to_everyone
		  </div>";
	
?>	


  </div> 
</body>
</html>