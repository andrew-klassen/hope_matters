<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../database_credentials.php');
require('../file_upload.php');
session_start();

// make sure user is logged in
login_check();

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

// make sure image is acceptible before continuing
if ($image_path = upload_file('employee_image', 'Employee', '/php/employee_info/change_info.php', '../../uploaded_images/in_use/employee_images/')) {

	$account_id = $_SESSION['account_id'];	
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$message_to_everyone = $_POST['message_to_everyone'];
	
	// replace single quotes with correct excape keys
	$message_to_everyone = str_replace('\'', '\\\'', $message_to_everyone);
	
	
	// make database connection
	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	
	$stmt = $conn->prepare("SELECT first_name FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$first_name_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT last_name FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$last_name_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT email FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$email_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT phone_number FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$phone_number_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT message_to_everyone FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$message_to_everyone_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT image_path FROM accounts WHERE account_id='$account_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$image_path_check = $_SESSION['temp'];

	
	// archive image to history folder
	if ($image_path_check != 'no_image' and $image_path != 'no_image'){
		rename($image_path_check, '../../uploaded_images/no_longer_used/employee_images_history/' . substr($image_path_check, strposX($image_path_check, '/', 5) + 1));
	}	
	// make sure the image is not replaced, if an image exists in the database
	elseif ($image_path_check and $image_path == 'no_image'){
		$image_path = $image_path_check;
	}

	
	try {
			
		if ($first_name != $first_name_check or $last_name != $last_name_check or $email != $email_check or $phone_number != $phone_number_check or $message_to_everyone != $message_to_everyone_check or $image_path != $image_path_check) {
			
			$query = "INSERT INTO accounts_history (account_id, username, first_name, last_name, job_title, work_location, normal_work_hours, email, phone_number, message_to_everyone, image_path, master_log_access, server_admin, password, timestamp, created_by) SELECT account_id, username, first_name, last_name, job_title, work_location, normal_work_hours, email, phone_number, message_to_everyone, image_path, master_log_access, server_admin, password, timestamp, created_by FROM accounts WHERE account_id='$account_id';"; 
			$conn->exec($query);
			
			$query = "UPDATE accounts SET first_name='$first_name', last_name='$last_name', email='$email', phone_number='$phone_number', message_to_everyone='$message_to_everyone', image_path='$image_path' WHERE account_id='$account_id';"; 
			$conn->exec($query);
		
		}
				
		// redirect user back to where they can select a lab order
		header( 'Location: /php/dashboard.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'update_info.php', $e->getMessage());
	}

	$conn = null;

}