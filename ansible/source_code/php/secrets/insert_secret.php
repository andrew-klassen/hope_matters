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

$label = $_POST['label'];
$label = str_replace('\'', '\\\'', $label);

$description = $_POST['description'];
$description = str_replace('\'', '\\\'', $description);

$value = $_POST['value'];

$secret_password = $_POST['secret_password'];
$secret_password = str_replace('\'', '\\\'', $secret_password);

$key_file = read_key_file('key_file');
$secret_password = $secret_password . $key_file;

$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try {		
		
		// see if a key with the same label exists
		$_SESSION['temp'] = '';
		$stmt = $conn->prepare("SELECT secret_id FROM secrets WHERE label = '$label';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		}
		$duplicate_label_id = $_SESSION['temp'];

		if ($duplicate_label_id != NULL) {

			echo "<script type='text/javascript'>alert('A key with the same label exists.')
					document.location.href = 'add_secret.php';	
	     		      </script>";
			      exit();

		}

		// if password is blank
		if ($secret_password == '') {

			echo "<script type='text/javascript'>alert('You need to provide a password.')
					document.location.href = 'add_secret.php';	
	     		      </script>";
			      exit();

		}

		// insert secret
		$query = "INSERT INTO secrets (label, description) VALUES ('$label', '$description');"; 
		$conn->exec($query);

		// get secret's id
		$stmt = $conn->prepare("SELECT LAST_INSERT_ID();");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		}
		$secret_id = $_SESSION['temp'];

		$initialization_vector = generate_initialization_vector();
		$hash = password_hash($value, $password_hashing_algorithim);
		$value = str_replace('\'', '\\\'', $value);

		// insert the first key
		$query = "INSERT INTO secret_values (secret_id, encrypted_value, initialization_vector, value_hash, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password', '$initialization_vector'), '$initialization_vector', '$hash', 'admin');"; 
		$conn->exec($query);

			
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
		create_database_error($query, 'insert_secret.php', $e->getMessage());
	}

$conn = null;
