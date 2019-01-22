<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('../crypto_settings.php');
session_start();

// make sure user is logged in
login_check();

$secret_id = $_SESSION['choosen_secret_id'];
$secret_password = $_SESSION['login_password'];


// make database connection
$conn = new PDO($dbconnection_secret, $dbusername_secret, $dbpassword_secret);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


// get all admin secrets 
$stmt = $conn->prepare("SELECT secret_value_id, key_hash FROM secret_values WHERE secret_id = :secret_id and privilege = 'admin';");
$stmt->execute(array('secret_id' => $secret_id));
$secret_keys_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

$secret_keys_id_max = count($secret_keys_ids);


for($i = 0; $i < $secret_keys_id_max; ++$i) {

	$hash = $secret_keys_ids[$i]['key_hash'];

	// if valid key exists
	if (password_verify($secret_password, $hash)) {

		$stmt = $conn->prepare("SELECT AES_DECRYPT(encrypted_value, :secret_password, initialization_vector) as `value`, privilege FROM secret_values WHERE secret_value_id = :secret_value_id;");
		$stmt->execute(array('secret_password' => $secret_password, 'secret_value_id' => $secret_keys_ids[$i]['secret_value_id']));
		$secret_value_record = $stmt->fetch(PDO::FETCH_ASSOC);

		$value = $secret_value_record['value'];
		$privilege = "admin";
		break;

	}

}


if ($privilege != "admin") {

	// get all read keys
	$stmt = $conn->prepare("SELECT secret_value_id, key_hash FROM secret_values WHERE secret_id = :secret_id and privilege = 'read';");
	$stmt->execute(array('secret_id' => $secret_id));
	$secret_keys_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$secret_keys_id_max = count($secret_keys_ids);


	for($i = 0; $i < $secret_keys_id_max; ++$i) {

		$hash = $secret_keys_ids[$i]['key_hash'];

		// if valid key exists
		if (password_verify($secret_password, $hash)) {
		
			$stmt = $conn->prepare("SELECT AES_DECRYPT(encrypted_value, :secret_password, initialization_vector) as `value`, privilege FROM secret_values WHERE secret_value_id = :secret_value_id;");
			$stmt->execute(array('secret_password' => $secret_password, 'secret_value_id' => $secret_keys_ids[$i]['secret_value_id']));
			$secret_value_record = $stmt->fetch(PDO::FETCH_ASSOC);

			$value = $secret_value_record['value'];
			$privilege = "read";
			break;

		}

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
