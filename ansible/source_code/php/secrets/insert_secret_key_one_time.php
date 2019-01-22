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

$secret_value_temp_id = $_SESSION['secret_key_temp_id'];
$secret_password_one_time = $_SESSION['secret_password'];

$secret_password = $_POST['secret_password'];
$secret_password = str_replace('\'', '\\\'', $secret_password);

$key_file = read_key_file('key_file');
$key_file = trim($key_file);
$keys = array();
$keys = explode('---additional_key---', $key_file);
$key_file = trim($keys[0]);

$secret_password = $secret_password . $key_file;

$_SESSION['temp'] = '';
$secret_id = $_SESSION['choosen_secret_id'];

$account_id = $_SESSION['account_id'];


$conn = new PDO($dbconnection_secret, $dbusername_secret, $dbpassword_secret);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	try {

			// if password is blank
			if ($secret_password == '') {

			echo "<script type='text/javascript'>alert('You need to provide a password.')
					document.location.href = 'add_secret_key_one_time.php';	
	     		      </script>";
			      exit();

			}	


			// get all temp ids
			$stmt = $conn->prepare("SELECT secret_value_temp_id, key_hash FROM secret_values_temp WHERE secret_id = :secret_id;");
			$stmt->execute(array('secret_id' => $secret_id));
			$secret_value_temp_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);


			$secret_value_temp_ids_max = count($secret_value_temp_ids);

	

			for($j = 0; $j < $secret_value_temp_ids_max; ++$j) {

						$hash = $secret_value_temp_ids[$j]['key_hash'];
						

						// if valid key exists
						if (password_verify($secret_password_one_time, $hash)) {

							


							$stmt = $conn->prepare("SELECT AES_DECRYPT(encrypted_value, :secret_password_one_time, initialization_vector) as `value`, privilege FROM secret_values_temp WHERE secret_value_temp_id = :secret_value_temp_id;");
							$stmt->execute(array('secret_password_one_time' => $secret_password_one_time, 'secret_value_temp_id' => $secret_value_temp_ids[$j]['secret_value_temp_id']));
							$secret_value_record = $stmt->fetch(PDO::FETCH_ASSOC);
	
							$value = $secret_value_record['value'];
							$privilege = $secret_value_record['privilege'];
							$secret_value_temp_id = $secret_value_temp_ids[$j]['secret_value_temp_id'];					
							

							break;

						}

			}
			



			// insert newly created persistant key
			$initialization_vector = generate_initialization_vector();
			$hash = password_hash($secret_password, $password_hashing_algorithim, $password_hashing_options);
			$value = str_replace('\'', '\\\'', $value);


			$stmt = $conn->prepare("INSERT INTO secret_values (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES (:secret_id, AES_ENCRYPT(:value, :secret_password, :initialization_vector), :initialization_vector2, :hash, :privilege);");
			$stmt->execute(array('secret_id' => $secret_id, 'value' => $value, 'secret_password' => $secret_password, 'initialization_vector' => $initialization_vector, 'initialization_vector2' => $initialization_vector, 'hash' => $hash, 'privilege' => $privilege));
			
			// remove the one time key
			$stmt = $conn->prepare("DELETE FROM secret_values_temp WHERE secret_value_temp_id = :secret_value_temp_id;");
			$stmt->execute(array('secret_value_temp_id' => $secret_value_temp_id));

		

		// remove sensitive varibles from user's php session
		$_SESSION['value'] = '';
		$_SESSION['privilege'] = '';
		$_SESSION['secret_password'] = '';
		$_SESSION['secret_value_temp_id'] = '';
		$_SESSION['secret_value_id'] = '';
		$_SESSION['secret_id'] = '';
		$_SESSION['choosen_secret_id'] = '';

		// redirect user back to where they can add more items
		header( 'Location: /php/secrets/select_secrets.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_secret_key_one_time.php', $e->getMessage());
	}

$conn = null;
