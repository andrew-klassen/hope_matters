<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('database_credentials.php');
require('password_validation.php');
session_start();

$account_id = $_SESSION['account_id'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];


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


try {
	/* create new connection */
    	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$stmt = $conn->prepare("SELECT password FROM accounts WHERE account_id=:account_id;");
	$stmt->execute(array('account_id' => $_SESSION['account_id']));
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					
	}
	$database_password = $_SESSION['temp'];


	// if count is 1, then the account exists
	if (password_verify($old_password, $database_password)) {
		
		// update account with new password
		if (password_check($new_password, $confirm_password)) {

			// hash new password			
			$new_password = password_hash($new_password, $password_hashing_algorithim);
			
			$sql = "UPDATE accounts SET password='$new_password' WHERE account_id='$account_id'";
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$sql = "UPDATE accounts_history SET password='$new_password' WHERE account_id='$account_id'";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			// redirect to dashbored
			header('Location: /php/dashboard.php');
			exit();	
		}
		
	}
	else {
	
		// notifiy user that their password is invalid
		echo "<script type='text/javascript'>
				alert('Old Password Invaild'); 
				document.location.href = '/html/change_password.html'; 
			 </script>";
	}
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
