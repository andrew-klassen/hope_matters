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

class client_check extends RecursiveIteratorIterator {
		function __construct($it) {
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current() {
			parent::current();
		}
		function beginChildren() {
			echo "<tr>";
		}
		function endChildren() {
			echo "</tr>" . "\n";
		}
}

// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$choosen_client_id = $_SESSION['choosen_client_id'];
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT client_id FROM current_clients WHERE client_id='$choosen_client_id' AND check_out IS NULL;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
foreach(new client_check(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
	++$count;
}


if (!$count) {

	try {
		
		// grab all current values from database
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

		}
		$first_name = $_SESSION['temp'];
			
			
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

		}
		$last_name = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

		}
		$sex = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

		}
		$location = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

		}
		$date_of_birth = $_SESSION['temp'];
		
		
		// check in the client
		$query = "INSERT INTO current_clients (client_id, first_name, last_name, sex, location, date_of_birth, check_in, created_by) VALUES ('$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', NOW(), '$username');"; 
		$conn->exec($query);
		
		
		// redirect back to dashboard
		header( 'Location: /php/dashboard.php' ) ;
		exit();
		
	}
	catch(PDOException $e) {
		create_database_error($query, 'update_client.php', $e->getMessage());	
	}

	$conn = null;
}

// client was already checked in
else {
	echo "<script type='text/javascript'>
			alert('The client is already checked in.'); 
			document.location.href = 'view_client.php'; 
		  </script>";	
}