<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('database_credentials.php');
include ('Net/SSH2.php');
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// user's password is stored in session so that they can authenticate secrets using auto-authenticate feature
$_SESSION['login_password'] = $password;


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
	
	// create new connection 
    	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// make sure account with username and password exists
	$stmt = $conn->prepare("SELECT password FROM accounts WHERE username=:username;");
	$stmt->execute(array('username' => $username));
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					
	}
	$database_password = $_SESSION['temp'];


	// count is used to determine whether or not if the email and password are valid 
	if (password_verify($password, $database_password)) {
		
		// make sure the config file has STORAGE_CHECK turned on
		if (STORAGE_CHECK) {
			
			// see if the user is a server_admin
			$stmt = $conn->prepare("SELECT server_admin FROM accounts WHERE username='$username' and password='$password';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					
			}
			$server_admin = $_SESSION['temp'];
			
			if ($server_admin == 'yes') {

				 $ssh_connection = new Net_SSH2(SERVER_WITH_STORAGE_ARRAY);
				 if (!$ssh_connection->login(USERNAME, PASSWORD)) {
					 exit('Login Failed');
				 }
			if (substr_count($ssh_connection->exec('/opt/MegaRAID/storcli/storcli64 /c0 show all | grep ^64:'), 'Onln') != NUMBER_OF_HARD_DRIVES){
					 header('Location: /php/storage_error.php');
					 exit();
				 }
				
			}
			
		}


		$stmt = $conn->prepare("SELECT account_id FROM accounts WHERE username=:username;");
		$stmt->execute(array('username' => $username));
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					
		}
		$_SESSION['account_id'] = $_SESSION['temp'];


		$account_id = $_SESSION['account_id'];

		// switches the users current hash time if migration is set in config
		if ($password_hash_migration) {

			// hash new password			
			$new_password = password_hash($new_password, $password_hashing_algorithim);
			
			$sql = "UPDATE accounts SET password='$new_password' WHERE account_id='$account_id'";
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$sql = "UPDATE accounts_history SET password='$new_password' WHERE account_id='$account_id'";
			$stmt = $conn->prepare($sql);
			$stmt->execute();

		}
		

		// redirect to dashboard
		header('Location: /php/dashboard.php');
		exit();

	}
	else {
	
		// calls javascript to notify the user that their email or password is invalid 
		echo "<script type='text/javascript'>
				alert('Invaild Username or Password'); 
				document.location.href = '../index.html'; 
			 </script>";
	}
	
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
