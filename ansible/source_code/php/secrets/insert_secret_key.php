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
$secret_password = str_replace('\'', '\\\'', $secret_password);

$privilege = $_POST['privilege'];

$value = $_SESSION['value'];
$value_start = $_SESSION['value'];

$username = $_POST['username'];

$key_file = read_key_file('key_file');
$key_file = trim($key_file);
$keys = array();
$keys = explode('---additional_key---', $key_file);
$key_file = trim($keys[0]);

$secret_password = $secret_password . $key_file;

$conn = new PDO($dbconnection_secret, $dbusername_secret, $dbpassword_secret);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	try {
		
		// if both fields are blank
		if ($secret_password == '' and $username == '') {

			echo "  <script type='text/javascript'>alert('You need either a username or password.')
					document.location.href = 'show_secret.php';	
	     			</script>";
			exit();

		}
		
		// if user provided both fields 
		else if ($secret_password != '' and $username != '') {

			echo "  <script type='text/javascript'>alert('Username or password, not both.')
					document.location.href = 'show_secret.php';	
	     			</script>";
			exit();

		}

		// if user is adding a key	
		else if ($secret_password != '') {

			$initialization_vector = generate_initialization_vector();
			$hash = password_hash($secret_password, $password_hashing_algorithim, $password_hashing_options);
			$value = str_replace('\'', '\\\'', $value);			

			$stmt = $conn->prepare("INSERT INTO secret_values (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES (:secret_id, AES_ENCRYPT(:value, :secret_password, :initialization_vector), :initialization_vector2, :hash, :privilege);");
			$stmt->execute(array('secret_id' => $secret_id, 'value' => $value, 'secret_password' => $secret_password, 'initialization_vector' => $initialization_vector, 'initialization_vector2' => $initialization_vector, 'hash' => $hash, 'privilege' => $privilege));

		}
		// user is giving another user the ability to create a key 
		else {
			
			if ($username == 'Everyone') {
				

				$stmt = $conn->prepare("SELECT account_id, CONCAT(`password`, account_id) as secret_password FROM accounts;");
				$stmt->execute();
				$user_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$user_id_max = count($user_ids);




				// get list of all secrets temp ids
				$stmt = $conn->prepare("SELECT secret_value_temp_id, key_hash FROM secret_values_temp WHERE secret_id = :secret_id;");
				$stmt->execute(array('secret_id' => $secret_id));
				$secret_value_temp_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$secret_value_temp_ids_max = count($secret_value_temp_ids);



				// create one time secret for all user's
				for($i = 0; $i < $user_id_max; ++$i) {
					
					$account_id = $user_ids[$i]['account_id'];

					// aes key used for one time login = users_password_hash + account_id
					$secret_password = $user_ids[$i]['secret_password'];


					
					// iterate through all temp ids
					for($j = 0; $j < $secret_value_temp_ids_max; ++$j) {

						$secret_value_temp_id = $secret_value_temp_ids[$j]['secret_value_temp_id'];


						
						$hash = $secret_value_temp_ids[$j]['key_hash'];
						

						// if valid key exists
						if (password_verify($secret_password, $hash)) {
							
							// delete current one time login if exists
							$stmt = $conn->prepare("DELETE FROM secret_values_temp WHERE secret_value_temp_id = :secret_value_temp_id;");
							$stmt->execute(array('secret_value_temp_id' => $secret_value_temp_id));

							break;

						}

					}
					
					// insert new one time login
					$initialization_vector = generate_initialization_vector();
					$value = $value_start;
					$hash = password_hash($secret_password, $password_hashing_algorithim, $password_hashing_options);
					$value = str_replace('\'', '\\\'', $value);
					

					$stmt = $conn->prepare("INSERT INTO secret_values_temp (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES (:secret_id, AES_ENCRYPT(:value, :secret_password, :initialization_vector), :initialization_vector2, :hash, :privilege);");
					$stmt->execute(array('secret_id' => $secret_id, 'value' => $value, 'secret_password' => $secret_password, 'initialization_vector' => $initialization_vector, 'initialization_vector2' => $initialization_vector, 'hash' => $hash, 'privilege' => $privilege));


									
				}
				
			}

			else if ($username == 'Server Admins') {


				$stmt = $conn->prepare("SELECT account_id, CONCAT(`password`, account_id) as secret_password FROM accounts WHERE server_admin = 'yes';");
				$stmt->execute();
				$user_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$user_id_max = count($user_ids);




				// get list of all secrets temp ids
				$stmt = $conn->prepare("SELECT secret_value_temp_id, key_hash FROM secret_values_temp WHERE secret_id = :secret_id;");
				$stmt->execute(array('secret_id' => $secret_id));
				$secret_value_temp_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$secret_value_temp_ids_max = count($secret_value_temp_ids);




				// iterate through all users
				for($i = 0; $i < $user_id_max; ++$i) {
					
					$account_id = $user_ids[$i]['account_id'];

					// aes key used for one time login = users_password_hash + account_id
					$secret_password = $user_ids[$i]['secret_password'];
					

					// iterate through all temp ids
					for($j = 0; $j < $secret_value_temp_ids_max; ++$j) {

						$secret_value_temp_id = $secret_value_temp_ids[$j]['secret_value_temp_id'];

						$hash = $secret_value_temp_ids[$j]['key_hash'];
						
						
						// if valid key exists
						if (password_verify($secret_password, $hash)) {

							$stmt = $conn->prepare("DELETE FROM secret_values_temp WHERE secret_value_temp_id = :secret_value_temp_id;");
							$stmt->execute(array('secret_value_temp_id' => $secret_value_temp_id));

							break;
						}

					}
					
					// insert new one time login				
					$initialization_vector = generate_initialization_vector();
					$value = $value_start;
					$hash = password_hash($secret_password, $password_hashing_algorithim, $password_hashing_options);
					$value = str_replace('\'', '\\\'', $value);
								

					$stmt = $conn->prepare("INSERT INTO secret_values_temp (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES (:secret_id, AES_ENCRYPT(:value, :secret_password, :initialization_vector), :initialization_vector2, :hash, :privilege);");
					$stmt->execute(array('secret_id' => $secret_id, 'value' => $value, 'secret_password' => $secret_password, 'initialization_vector' => $initialization_vector, 'initialization_vector2' => $initialization_vector, 'hash' => $hash, 'privilege' => $privilege));
				
				}
				
			}

			// individual user
			else {

				// get list of all secrets temp ids
				$stmt = $conn->prepare("SELECT secret_value_temp_id, key_hash FROM secret_values_temp WHERE secret_id = :secret_id;");
				$stmt->execute(array('secret_id' => $secret_id));
				$secret_value_temp_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$secret_value_temp_ids_max = count($secret_value_temp_ids);



				$stmt = $conn->prepare("SELECT account_id, CONCAT(`password`, account_id) as secret_password FROM accounts WHERE username = :username;");
				$stmt->execute(array('username' => $username));
				$user_ids = $stmt->fetch(PDO::FETCH_ASSOC);

				$account_id = $user_ids['account_id'];
				

				// aes key used for one time login = users_password_hash + account_id
				$secret_password = $user_ids['secret_password'];


		

				// iterate through all temp ids
				for($j = 0; $j < $secret_value_temp_ids_max; ++$j) {

					$secret_value_temp_id = $secret_value_temp_ids[$j]['secret_value_temp_id'];

					$hash = $secret_value_temp_ids[$j]['key_hash'];
					
	
					// if valid key exists
					if (password_verify($secret_password, $hash)) {

						$stmt = $conn->prepare("DELETE FROM secret_values_temp WHERE secret_value_temp_id = :secret_value_temp_id;");
						$stmt->execute(array('secret_value_temp_id' => $secret_value_temp_id));

						break;

					}

				}
				
				// insert new one time login
				$initialization_vector = generate_initialization_vector();
				$value = $value_start;
				$hash = password_hash($secret_password, $password_hashing_algorithim, $password_hashing_options);
				$value = str_replace('\'', '\\\'', $value);

				$stmt = $conn->prepare("INSERT INTO secret_values_temp (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES (:secret_id, AES_ENCRYPT(:value, :secret_password, :initialization_vector), :initialization_vector2, :hash, :privilege);");
					$stmt->execute(array('secret_id' => $secret_id, 'value' => $value, 'secret_password' => $secret_password, 'initialization_vector' => $initialization_vector, 'initialization_vector2' => $initialization_vector, 'hash' => $hash, 'privilege' => $privilege));

			}

		}
		
		// remove sensitive varibles from user's php session
		$_SESSION['value'] = '';
		$_SESSION['privilege'] = '';
		$_SESSION['secret_password'] = '';
		$_SESSION['secret_value_temp_id'] = '';
		$_SESSION['secret_value_id'] = '';
		$_SESSION['secret_id'] = '';
		$_SESSION['choosen_secret_id'] = '';		

		
		// redirect user back to where they can add more secrets
		header( 'Location: /php/secrets/select_secrets.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_secret_key.php', $e->getMessage());
	}

$conn = null;
