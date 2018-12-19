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


$secret_id = $_SESSION['choosen_secret_id'];

$secret_password = $_POST['secret_password'];
$secret_password = str_replace('\'', '\\\'', $secret_password);

$accounts = $_POST['accounts'];
$privilege = $_POST['privilege'];

$value = $_SESSION['value'];
$value = str_replace('\'', '\\\'', $value);

$username = $_POST['username'];

// aes key
$key_file = read_key_file('key_file');
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

			$query = "INSERT INTO secret_keys (secret_id, `key`, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password'), '$privilege');"; 
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

					// see if user already has a one time login
					$stmt = $conn->prepare("SELECT AES_DECRYPT(`key`, '$secret_password') FROM secret_keys_temp WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL;");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$temp_value = $_SESSION['temp'];

					// if there are no existing one time logins, create one
					if ($temp_value == NULL) {
				
						$query = "INSERT INTO secret_keys_temp (secret_id, `key`, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password'), '$privilege');"; 
						$conn->exec($query);

					}
					
					// if one exists, make sure permissions are correct
					else {
			
						$stmt = $conn->prepare("SELECT secret_key_temp_id FROM secret_keys_temp WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

						}
						$secret_key_temp_id = $_SESSION['temp'];
						
						$stmt = $conn->prepare("SELECT privilege FROM secret_keys_temp WHERE secret_key_temp_id=$secret_key_temp_id");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

						}
						$current_privilege = $_SESSION['temp'];

						if ($current_privilege != $privilege) {
							$query = "UPDATE secret_keys_temp SET privilege='$privilege' WHERE secret_key_temp_id='$secret_key_temp_id';"; 
							$conn->exec($query);
						}

					}
									
				}
				
			}

			else if ($username == 'Server Admins') {

				// get list of all server admins user ids
				$_SESSION['user_ids'] = array();

				$stmt = $conn->prepare("SELECT account_id FROM accounts WHERE server_admin = 'yes';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new get_user_ids(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}
				$_SESSION['user_ids'];

				$user_id_max = count($_SESSION['user_ids']);
				
				// create one time secret for all server admins
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

					// see if user already has a one time login
					$stmt = $conn->prepare("SELECT AES_DECRYPT(`key`, '$secret_password') FROM secret_keys_temp WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL;");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$temp_value = $_SESSION['temp'];

					// if there are no existing one time logins, create one
					if ($temp_value == NULL) {
				
						$query = "INSERT INTO secret_keys_temp (secret_id, `key`, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password'), '$privilege');"; 
						$conn->exec($query);

					}
					
					// if there is a one time login, check permissions and set them correctly
					else {
			
						$stmt = $conn->prepare("SELECT secret_key_temp_id FROM secret_keys_temp WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

						}
						$secret_key_temp_id = $_SESSION['temp'];
						
						$stmt = $conn->prepare("SELECT privilege FROM secret_keys_temp WHERE secret_key_temp_id=$secret_key_temp_id");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

						}
						$current_privilege = $_SESSION['temp'];

						if ($current_privilege != $privilege) {
							$query = "UPDATE secret_keys_temp SET privilege='$privilege' WHERE secret_key_temp_id='$secret_key_temp_id';"; 
							$conn->exec($query);
						}

					}
									

				}
				
			}

			// individual user
			else {
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

				// see if user already has a one time login
				$stmt = $conn->prepare("SELECT AES_DECRYPT(`key`, '$secret_password') FROM secret_keys_temp WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL;");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}
				$temp_value = $_SESSION['temp'];

				// if there are no existing one time logins, create one
				if ($temp_value == NULL) {
				
					$query = "INSERT INTO secret_keys_temp (secret_id, `key`, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password'), '$privilege');"; 
					$conn->exec($query);

				}
					
				else {
			
					$stmt = $conn->prepare("SELECT secret_key_temp_id FROM secret_keys_temp WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL;");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$secret_key_temp_id = $_SESSION['temp'];
						
					$stmt = $conn->prepare("SELECT privilege FROM secret_keys_temp WHERE secret_key_temp_id=$secret_key_temp_id");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$current_privilege = $_SESSION['temp'];

					if ($current_privilege != $privilege) {
						$query = "UPDATE secret_keys_temp SET privilege='$privilege' WHERE secret_key_temp_id='$secret_key_temp_id';"; 
						$conn->exec($query);
					}

				}

			}
			

		}
		
		// remove sensitive varibles from user's php session
		$_SESSION['value'] = '';
		$_SESSION['privilege'] = '';
		$_SESSION['secret_password'] = '';
		$_SESSION['secret_key_temp_id'] = '';
		$_SESSION['secret_key_id'] = '';
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
