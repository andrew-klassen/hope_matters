<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../database_credentials.php');
session_start();

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

$choosen_client_id = $_SESSION['choosen_client_id'];
$username = $_SESSION['username'];


		// make database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$stmt = $conn->prepare("SELECT current_clients_id FROM current_clients WHERE client_id='$choosen_client_id'; AND check_out IS NULL;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

		}
		$current_clients_id = $_SESSION['temp'];
		
		$conn = null;

	try {
		
		// make database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		// archive clients old information
		$query = "UPDATE current_clients SET check_out=NOW() WHERE current_clients_id='$current_clients_id';"; 
		$conn->exec($query);
		
		
		// redirect back to dashboard
		header( 'Location: /php/current_clients/view_checked_out_clients.php' );
		exit();
		
	}
	catch(PDOException $e) {
		create_database_error($query, 'view_checked_out_clients.php', $e->getMessage());	
	}

$conn = null;