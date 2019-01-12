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

class get_user_ids extends RecursiveIteratorIterator {
		function __construct($it) {
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current() {
				
				array_push($_SESSION['user_ids'], parent::current());

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
$secret_password = str_replace('\'', '\\\'', $secret_password);

$accounts = $_POST['accounts'];
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

$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
			$hash = password_hash($secret_password, $password_hashing_algorithim);
			$value = str_replace('\'', '\\\'', $value);			

			$query = "INSERT INTO secret_values (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password', '$initialization_vector'), '$initialization_vector', '$hash', '$privilege');"; 
			$conn->exec($query);

		}
		// user is giving another user the ability to create a key 
		else {
			
			if ($username == 'Everyone') {
				
				// get list of everyone's user id
				$_SESSION['user_ids'] = array();

				$stmt = $conn->prepare("SELECT account_id FROM accounts;");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new get_user_ids(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}
				$_SESSION['user_ids'];

				$user_id_max = count($_SESSION['user_ids']);


				// get list of all secrets temp ids
				$_SESSION['secret_value_temp_ids'] = array();

				$stmt = $conn->prepare("SELECT secret_value_temp_id FROM secret_values_temp WHERE secret_id = '$secret_id';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new get_secret_value_temp_ids(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}


				$secret_value_temp_ids_max = count($_SESSION['secret_value_temp_ids']);

				
				// create one time secret for all user's
				for($i = 0; $i < $user_id_max; ++$i) {
					
					$account_id = $_SESSION['user_ids'][$i];

					$stmt = $conn->prepare("SELECT password FROM accounts WHERE account_id = '$account_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}

					// aes key used for one time login = users_password_hash + account_id
					$secret_password = $_SESSION['temp'] . $account_id;

					$_SESSION['temp'] = '';
					

					// iterate through all temp ids
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
							
							// delete current one time login if exists
							$query = "DELETE FROM secret_values_temp WHERE secret_value_temp_id='$secret_value_temp_id';"; 
							$conn->exec($query);

							$value = $temp_value;
							break;

						}

					}
					
					// insert new one time login
					$initialization_vector = generate_initialization_vector();
					$value = $value_start;
					$hash = password_hash($secret_password, $password_hashing_algorithim);
					$value = str_replace('\'', '\\\'', $value);
					
					
					$query = "INSERT INTO secret_values_temp (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password', '$initialization_vector'), '$initialization_vector', '$hash', '$privilege');"; 
					$conn->exec($query);
									
				}
				
			}

			else if ($username == 'Server Admins') {

				// get list of everyone's user id
				$_SESSION['user_ids'] = array();

				$stmt = $conn->prepare("SELECT account_id FROM accounts WHERE server_admin = 'yes';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new get_user_ids(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}
				$_SESSION['user_ids'];

				$user_id_max = count($_SESSION['user_ids']);


				// get list of secrets temp ids
				$_SESSION['secret_value_temp_ids'] = array();

				$stmt = $conn->prepare("SELECT secret_value_temp_id FROM secret_values_temp WHERE secret_id = '$secret_id';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new get_secret_value_temp_ids(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}

				$secret_value_temp_ids_max = count($_SESSION['secret_value_temp_ids']);


				// iterate through all users
				for($i = 0; $i < $user_id_max; ++$i) {
					
					$account_id = $_SESSION['user_ids'][$i];

					$stmt = $conn->prepare("SELECT password FROM accounts WHERE account_id = '$account_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}

					// aes key used for one time login = users_password_hash + account_id
					$secret_password = $_SESSION['temp'] . $account_id;

					$_SESSION['temp'] = '';
					

					// iterate through all temp ids
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

							$query = "DELETE FROM secret_values_temp WHERE secret_value_temp_id='$secret_value_temp_id';"; 
							$conn->exec($query);

							$value = $temp_value;
							break;
						}

					}
					
					// insert new one time login				
					$initialization_vector = generate_initialization_vector();
					$value = $value_start;
					$hash = password_hash($secret_password, $password_hashing_algorithim);
					$value = str_replace('\'', '\\\'', $value);
										
					$query = "INSERT INTO secret_values_temp (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password', '$initialization_vector'), '$initialization_vector', '$hash', '$privilege');";
					$conn->exec($query);
				
				}
				
			}

			// individual user
			else {

				$_SESSION['secret_value_temp_ids'] = array();

				$stmt = $conn->prepare("SELECT secret_value_temp_id FROM secret_values_temp WHERE secret_id = '$secret_id';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new get_secret_value_temp_ids(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}


				$secret_value_temp_ids_max = count($_SESSION['secret_value_temp_ids']);
				$stmt = $conn->prepare("SELECT account_id FROM accounts WHERE username = '$username';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}
				$account_id = $_SESSION['temp'];


				$stmt = $conn->prepare("SELECT password FROM accounts WHERE account_id = '$account_id';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}

				// aes key used for one time login = users_password_hash + account_id
				$secret_password = $_SESSION['temp'] . $account_id;

				$_SESSION['temp'] = '';
					

				// iterate through all temp ids
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

						$query = "DELETE FROM secret_values_temp WHERE secret_value_temp_id='$secret_value_temp_id';"; 
						$conn->exec($query);

						$value = $temp_value;
						break;

					}

				}
				
				// insert new one time login
				$initialization_vector = generate_initialization_vector();
				$value = $value_start;
				$hash = password_hash($secret_password, $password_hashing_algorithim);
				$value = str_replace('\'', '\\\'', $value);

				$query = "INSERT INTO secret_values_temp (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password', '$initialization_vector'), '$initialization_vector', '$hash', '$privilege');";
				$conn->exec($query);

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
