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

class get_secret_keys_ids extends RecursiveIteratorIterator {
		function __construct($it) {
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current() {
				
				array_push($_SESSION['secret_keys_ids'], parent::current());

		}
		
}

$_SESSION['temp'] = '';
$secret_id = $_SESSION['choosen_secret_id'];

$secret_password = $_POST['secret_password'];
$secret_password = str_replace('\'', '\\\'', $secret_password);
$secret_password_start = $secret_password;

$key_file = read_key_file('key_file');
$key_file = trim($key_file);
$keys = array();
$keys = explode('---additional_key---', $key_file);


// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

foreach ($keys as &$current_key) {
 
	$secret_password = $secret_password_start . trim($current_key);

		
	//************ if more than one valid key exists, with different permissions, the admin permission takes affect ************


	// get all admin secret ids
	$_SESSION['secret_keys_ids'] = array();

	$stmt = $conn->prepare("SELECT secret_value_id FROM secret_values WHERE secret_id = '$secret_id' and privilege = 'admin';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new get_secret_keys_ids(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}

	$secret_keys_id_max = count($_SESSION['secret_keys_ids']);


	for($i = 0; $i < $secret_keys_id_max; ++$i) {

		$secret_value_id = $_SESSION['secret_keys_ids'][$i];


		$_SESSION['temp'] = '';
		$stmt = $conn->prepare("SELECT key_hash FROM secret_values WHERE secret_value_id='$secret_value_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

		}
		$hash = $_SESSION['temp'];
		

		// if valid key exists
		if (password_verify($secret_password, $hash)) {

			$stmt = $conn->prepare("SELECT initialization_vector FROM secret_values WHERE secret_value_id='$secret_value_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

			}
			$initialization_vector = $_SESSION['temp'];


			// see if any admin keys exist
			$_SESSION['temp'] = '';
			$stmt = $conn->prepare("SELECT AES_DECRYPT(encrypted_value, '$secret_password', '$initialization_vector') FROM secret_values WHERE secret_value_id='$secret_value_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

			}
			$temp_value = $_SESSION['temp'];

			$value = $temp_value;
			$privilege = "admin";
			break;
		}

	}


	// if no admin secrets existed
	if ($privilege != "admin") {

		$_SESSION['secret_keys_ids'] = array();

		$stmt = $conn->prepare("SELECT secret_value_id FROM secret_values WHERE secret_id = '$secret_id' and privilege = 'read' ;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
		foreach(new get_secret_keys_ids(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

		}

		$secret_keys_id_max = count($_SESSION['secret_keys_ids']);


		for($i = 0; $i < $secret_keys_id_max; ++$i) {

			$secret_value_id = $_SESSION['secret_keys_ids'][$i];


			$_SESSION['temp'] = '';
			$stmt = $conn->prepare("SELECT key_hash FROM secret_values WHERE secret_value_id='$secret_value_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

			}
			$hash = $_SESSION['temp'];
		

			// if valid key exists
			if (password_verify($secret_password, $hash)) {

				$stmt = $conn->prepare("SELECT initialization_vector FROM secret_values WHERE secret_value_id='$secret_value_id'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}
				$initialization_vector = $_SESSION['temp'];


				// see if any read secret exist
				$_SESSION['temp'] = '';
				$stmt = $conn->prepare("SELECT AES_DECRYPT(encrypted_value, '$secret_password', '$initialization_vector') FROM secret_values WHERE secret_value_id='$secret_value_id' and AES_DECRYPT(encrypted_value, '$secret_password', '$initialization_vector') is not NULL;");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}
				$temp_value = $_SESSION['temp'];

				$value = $temp_value;
				$privilege = "read";
				break;
			}

		}


	}

	if (isset($value)) {
		break;
	}

}

// if no valid keys exist
if (! isset($value)) {
	
	echo "<script type='text/javascript'>alert('No key with the password found.')
		document.location.href = 'authorize_secret.php';	
	     </script>";
	exit();

}


// wipe the value and privilege to prevent sensitive data from being stored in user's session
$_SESSION['value'] = $value;
$_SESSION['privilege'] = $privilege;


header( 'Location: show_secret.php');
exit();
