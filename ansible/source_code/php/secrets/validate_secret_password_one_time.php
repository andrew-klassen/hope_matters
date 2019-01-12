<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('../database_credentials.php');
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

class get_secret_value_temp_ids extends RecursiveIteratorIterator {
		function __construct($it) {
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current() {
				
				array_push($_SESSION['secret_value_temp_ids'], parent::current());

		}
		
}


$secret_id = $_SESSION['choosen_secret_id'];
$secret_password = $_POST['secret_password'];
$account_id = $_SESSION['account_id'];


// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT password FROM accounts WHERE account_id = '$account_id';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$password = $_SESSION['temp'];

// aes key used to decrypt one time password = user's password hash + id
$secret_password = $password . $account_id;


// get all temp ids
$_SESSION['secret_value_temp_ids'] = array();

$stmt = $conn->prepare("SELECT secret_value_temp_id FROM secret_values_temp WHERE secret_id = '$secret_id';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new get_secret_value_temp_ids(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}

$secret_value_temp_ids_max = count($_SESSION['secret_value_temp_ids']);


for($j = 0; $j < $secret_value_temp_ids_max; ++$j) {

	$secret_value_temp_id = $_SESSION['secret_value_temp_ids'][$j];
						

	$stmt = $conn->prepare("SELECT initialization_vector FROM secret_values_temp WHERE secret_value_temp_id='$secret_value_temp_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$initialization_vector = $_SESSION['temp'];

						
	$_SESSION['temp'] = '';
	$stmt = $conn->prepare("SELECT AES_DECRYPT(encrypted_value, '$secret_password', '$initialization_vector') FROM secret_values_temp WHERE secret_value_temp_id='$secret_value_temp_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$temp_value = $_SESSION['temp'];

	
	$_SESSION['temp'] = '';
	$stmt = $conn->prepare("SELECT key_hash FROM secret_values_temp WHERE secret_value_temp_id='$secret_value_temp_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hash = $_SESSION['temp'];
			
						
	// if valid key exists
	if (password_verify($secret_password, $hash)) {
	
		$value = $temp_value;
		break;

	}

}
				

// exit and notify user that they are unauthorized if no key exists
if (! isset($value)) {
	
	echo "<script type='text/javascript'>alert('You don\'t have permission to create a key.')
		document.location.href = 'authorize_secret.php';	
	     </script>";
	exit();

}


// get one time key privilege
$stmt = $conn->prepare("SELECT privilege FROM secret_values_temp WHERE secret_value_temp_id='$secret_value_temp_id'");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$privilege = $_SESSION['temp'];


$_SESSION['value'] = $value;
$_SESSION['privilege'] = $privilege;
$_SESSION['secret_password'] = $secret_password;
$_SESSION['secret_key_temp_id'] = $secret_key_temp_id;


header( 'Location: add_secret_key_one_time.php');
exit();
