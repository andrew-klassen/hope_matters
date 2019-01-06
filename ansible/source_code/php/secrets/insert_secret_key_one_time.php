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


class get_secret_value_temp_ids extends RecursiveIteratorIterator {
		function __construct($it) {
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current() {
				
				array_push($_SESSION['secret_value_temp_ids'], parent::current());

		}
		
}


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


$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try {

			// if password is blank
			if ($secret_password == '') {

			echo "<script type='text/javascript'>alert('You need to provide a password.')
					document.location.href = 'add_secret_key_one_time.php';	
	     		      </script>";
			      exit();

			}	


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


						$stmt = $conn->prepare("SELECT AES_DECRYPT(encrypted_value, '$secret_password_one_time', '$initialization_vector') FROM secret_values_temp WHERE secret_value_temp_id='$secret_value_temp_id';");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

						}
						$value = $_SESSION['temp'];

						
						$_SESSION['temp'] = '';
						$stmt = $conn->prepare("SELECT value_hash FROM secret_values_temp WHERE secret_value_temp_id='$secret_value_temp_id';");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
									
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

						}
						$hash = $_SESSION['temp'];
						

						// if valid key exists
						if (password_verify($temp_value, $hash)) {

							break;

						}

			}
			

			// get secret's privilege
			$stmt = $conn->prepare("SELECT privilege FROM secret_values_temp WHERE secret_value_temp_id = '$secret_value_temp_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

			}
			$privilege = $_SESSION['temp'];


			// insert newly created persistant key
			$initialization_vector = generate_initialization_vector();
			$hash = password_hash($value, $password_hashing_algorithim);
			$value = str_replace('\'', '\\\'', $value);

			$query = "INSERT INTO secret_values (secret_id, encrypted_value, initialization_vector, value_hash, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password', '$initialization_vector'), '$initialization_vector', '$hash', '$privilege');"; 
			$conn->exec($query);

			// remove the one time key
			$query = "DELETE FROM secret_values_temp WHERE secret_value_temp_id ='$secret_value_temp_id';"; 
			$conn->exec($query);
		

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
