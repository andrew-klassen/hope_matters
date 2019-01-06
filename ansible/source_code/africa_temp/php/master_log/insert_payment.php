<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../database_credentials.php');
session_start();

// make sure the user is logged in
login_check();
master_log_check();

$username = $_SESSION['username'];
$client_id = $_SESSION['choosen_client_id']; if (isset($_POST['choosen_client_id'])) {$client_id = $_POST['choosen_client_id'];}


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


			// make database connection
			$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/****** get the clients general information ******/
			$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$client_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$first_name = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$client_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$last_name = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$client_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$sex = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$client_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$location = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$client_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$date_of_birth = $_SESSION['temp'];
			
			
$department = $_POST['transaction_type_add'];	
$revisit = $_POST['revisit'];		
$billed = $_POST['billed'];	
$paid = $_POST['paid'];		
$notes = $_POST['notes'];	
$payment_method = $_POST['payment_method'];	

// single quotes need to be replaced with the correct excape keys for the following value
$notes = str_replace('\'', '\\\'', $notes);


try {
	
	// the query
    $query = "INSERT INTO master_log (client_id, first_name, last_name, sex, location, date_of_birth, created_by, department, payment_method, revisit, billed, paid, notes) VALUES ('$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$username', '$department', '$payment_method', '$revisit', '$billed', '$paid', '$notes')"; 
    $conn->exec($query);
	
	if ($paid != 0) {
		
		// get id of the payment that was just created
		$stmt = $conn->prepare("SELECT LAST_INSERT_ID();");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
		}
		$payment_id = $_SESSION['temp'];
		
		// insert a change record
		$query = "INSERT INTO master_log_change (payment_id, client_id, first_name, last_name, sex, location, date_of_birth, created_by, department, payment_method, revisit, amount, notes) VALUES ('$payment_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$username', '$department', '$payment_method', '$revisit', '$paid', '$notes')"; 
		$conn->exec($query);
	
	}
	
	// redirect the user back to the client page
	header( 'Location: master_log_client.php');
	exit();
}

catch(PDOException $e) {
	create_database_error($query, 'insert_payment.php', $e->getMessage());		
}

$conn = null;