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


$label = $_POST['label'];
$label = str_replace('\'', '\\\'', $label);

$description = $_POST['description'];
$description = str_replace('\'', '\\\'', $description);

$value = $_POST['value'];

$secret_password = $_POST['secret_password'];
$secret_password = str_replace('\'', '\\\'', $secret_password);

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
		
		// see if a key with the same label exists
		$stmt = $conn->prepare("SELECT secret_id FROM secrets WHERE label = :label;");
		$stmt->execute(array('label' => $label));
		$secret_row = $stmt->fetch(PDO::FETCH_ASSOC);
		$duplicate_label_id = $secret_row['secret_id'];


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
		$stmt = $conn->prepare("INSERT INTO secrets (label, description) VALUES (:label, :description);");
		$stmt->execute(array('label' => $label, 'description' => $description));


		$stmt = $conn->prepare("SELECT LAST_INSERT_ID();");
		$stmt->execute();
		$secret_id_row = $stmt->fetch(PDO::FETCH_NUM);
		$secret_id = $secret_id_row[0];


		$initialization_vector = generate_initialization_vector();
		$hash = password_hash($secret_password, $password_hashing_algorithim, $password_hashing_options);
		$value = str_replace('\'', '\\\'', $value);


		$stmt = $conn->prepare("INSERT INTO secret_values (secret_id, encrypted_value, initialization_vector, key_hash, privilege) VALUES (:secret_id, AES_ENCRYPT(:value, :secret_password, :initialization_vector), :initialization_vector2, :hash, 'admin');");
					$stmt->execute(array('secret_id' => $secret_id, 'value' => $value, 'secret_password' => $secret_password, 'initialization_vector' => $initialization_vector, 'initialization_vector2' => $initialization_vector, 'hash' => $hash));

			
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
