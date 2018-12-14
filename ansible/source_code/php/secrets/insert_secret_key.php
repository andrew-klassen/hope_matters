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

$secret_id = $_SESSION['choosen_secret_id'];
$secret_password = $_POST['secret_password'];
$accounts = $_POST['accounts'];
$privilege = $_POST['privilege'];
$value = $_SESSION['value'];
$username = $_POST['username'];


$key_file = read_key_file('key_file');


$secret_password = $secret_password . $key_file;



$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try {
			
		if ($secret_password != '') {

			$query = "INSERT INTO secret_keys (secret_id, `key`, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password'), '$privilege');"; 
			$conn->exec($query);
		}
		else if ($username != '') {
			
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
			$secret_password = $_SESSION['temp'] . $account_id;

			
			$query = "INSERT INTO secret_keys_temp (secret_id, `key`, privilege) VALUES ('$secret_id', AES_ENCRYPT('$value', '$secret_password'), '$privilege');"; 
			$conn->exec($query);
			


		}
				
		// redirect user back to where they can add more items
		header( 'Location: /php/secrets/select_secrets.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_item.php', $e->getMessage());
	}

$conn = null;

