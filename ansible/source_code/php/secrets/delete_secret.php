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

$conn = new PDO($dbconnection_secret, $dbusername_secret, $dbpassword_secret);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	try {
			
		// wipes all keys, the secret, and one time logins
		$stmt = $conn->prepare("DELETE FROM secret_values WHERE secret_id = :secret_id;");
		$stmt->execute(array('secret_id' => $secret_id));

		$stmt = $conn->prepare("DELETE FROM secrets WHERE secret_id = :secret_id;");
		$stmt->execute(array('secret_id' => $secret_id));

		$stmt = $conn->prepare("DELETE FROM secret_values_temp WHERE secret_id = :secret_id;");
		$stmt->execute(array('secret_id' => $secret_id));
		
				
		// redirect user back to where they can add more items
		header( 'Location: /php/secrets/select_secrets.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'delete_secret.php', $e->getMessage());
	}

$conn = null;
