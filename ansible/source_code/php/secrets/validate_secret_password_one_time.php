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
$secret_password = $_POST['secret_password'];
$account_id = $_SESSION['account_id'];


// make database connection
$conn = new PDO($dbconnection_secret, $dbusername_secret, $dbpassword_secret);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


// get user's password hash
$stmt = $conn->prepare("SELECT password FROM accounts WHERE account_id = :account_id;");
$stmt->execute(array('account_id' => $account_id));
$password = $stmt->fetch(PDO::FETCH_ASSOC);

// aes key used to decrypt one time password = user's password hash + id
$secret_password = $password['password'] . $account_id;


// get all temp ids
$stmt = $conn->prepare("SELECT secret_value_temp_id, key_hash FROM secret_values_temp WHERE secret_id = :secret_id;");
$stmt->execute(array('secret_id' => $secret_id));
$secret_value_temp_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$secret_value_temp_rows_max = count($secret_value_temp_rows);


for($i = 0; $i < $secret_value_temp_rows_max; ++$i) {

	$hash = $secret_value_temp_rows[$i]['key_hash'];
							
	// if valid key exists
	if (password_verify($secret_password, $hash)) {
	
		$stmt = $conn->prepare("SELECT AES_DECRYPT(encrypted_value, :secret_password, initialization_vector) as `value`, privilege FROM secret_values_temp WHERE secret_value_temp_id = :secret_value_temp_ids;");
		$stmt->execute(array('secret_password' => $secret_password, 'secret_value_temp_ids' => $secret_value_temp_rows[$i]['secret_value_temp_id']));
		$secret_value_temp_record = $stmt->fetch(PDO::FETCH_ASSOC);
	
		$value = $secret_value_temp_record['value'];
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


$privilege = $secret_value_temp_record['privilege'];


$_SESSION['value'] = $value;
$_SESSION['privilege'] = $privilege;
$_SESSION['secret_password'] = $secret_password;
$_SESSION['secret_key_temp_id'] = $secret_key_temp_id;


header( 'Location: add_secret_key_one_time.php');
exit();
