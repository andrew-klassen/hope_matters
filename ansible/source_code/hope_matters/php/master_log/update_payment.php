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
master_log_check();

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

$choosen_payment_id = $_SESSION['choosen_payment_id'];
$username = $_SESSION['username'];

$transaction_type = $_POST['transaction_type'];
$payment_method = $_POST['payment_method'];
$revisit = $_POST['revisit'];
$billed = $_POST['billed'];
$paid = $_POST['paid'];
$notes = $_POST['notes'];

// single quotes need to be replaced with the correct excape keys for the following value
$notes = str_replace('\'', '\\\'', $notes);

	//make database connection
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$stmt = $conn->prepare("SELECT department FROM master_log WHERE payment_id='$choosen_payment_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$department_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT payment_method FROM master_log WHERE payment_id='$choosen_payment_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$payment_method_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT revisit FROM master_log WHERE payment_id='$choosen_payment_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$revisit_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT notes FROM master_log WHERE payment_id='$choosen_payment_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$notes_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT billed FROM master_log WHERE payment_id='$choosen_payment_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$billed_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT paid FROM master_log WHERE payment_id='$choosen_payment_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$paid_check = $_SESSION['temp'];
	

try {
	
	if ($transaction_type != $department_check or $payment_method != $payment_method_check or $revisit != $revisit_check or $notes != $notes_check or $billed != $billed_check or $paid != $paid_check) {
	
		$query = "INSERT INTO master_log_history (payment_id, client_id, first_name, last_name, sex, location, date_of_birth, department, payment_method, revisit, notes, billed, paid, timestamp, created_by) SELECT payment_id, client_id, first_name, last_name, sex, location, date_of_birth, department, payment_method, revisit, notes, billed, paid, timestamp, created_by FROM master_log WHERE payment_id='$choosen_payment_id';"; 
		$conn->exec($query);
		
		$sql = "UPDATE master_log SET department='$transaction_type', payment_method='$payment_method', revisit='$revisit', billed='$billed', paid='$paid', notes='$notes',
		created_by='$username' WHERE payment_id='$choosen_payment_id';";
		
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		// get the difference in payments
		$amount = $paid - $paid_check;
		
		if ($amount) {
		
			$stmt = $conn->prepare("SELECT client_id FROM master_log WHERE payment_id='$choosen_payment_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$client_id = $_SESSION['temp'];
		
		
			$stmt = $conn->prepare("SELECT first_name FROM master_log WHERE payment_id='$choosen_payment_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$first_name = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT last_name FROM master_log WHERE payment_id='$choosen_payment_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$last_name = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT sex FROM master_log WHERE payment_id='$choosen_payment_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$sex = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT location FROM master_log WHERE payment_id='$choosen_payment_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$location = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT date_of_birth FROM master_log WHERE payment_id='$choosen_payment_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$date_of_birth = $_SESSION['temp'];
			
			
			// insert the  change into the change table
			$query = "INSERT INTO master_log_change (payment_id, client_id, first_name, last_name, sex, location, date_of_birth, department, payment_method, revisit, notes, amount, created_by) VALUES ('$choosen_payment_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$transaction_type', '$payment_method', '$revisit', '$notes', '$amount', '$username');"; 
			$conn->exec($query);
		}
	
	}
	
	// redirect user back to the master log
	header( 'Location: master_log.php');
	exit();
}
catch(PDOException $e) {
    create_database_error($query, 'update_payment.php', $e->getMessage());
}

$conn = null;