<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('../database_credentials.php');

session_start();

// make sure user is logged in
login_check();


$secret_id = $_SESSION['choosen_secret_id'];

$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try {
			
		// wipes all keys, the secret, and one time logins
		$query = "DELETE FROM secret_values WHERE secret_id='$secret_id';"; 
		$conn->exec($query);

		$query = "DELETE FROM secrets WHERE secret_id='$secret_id';"; 
		$conn->exec($query);

		$query = "DELETE FROM secret_values_temp WHERE secret_id='$secret_id';"; 
		$conn->exec($query);
		
				
		// redirect user back to where they can add more items
		header( 'Location: /php/secrets/select_secrets.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'delete_secret.php', $e->getMessage());
	}

$conn = null;
