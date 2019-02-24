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
	
	$lab_order_id = $_SESSION['choosen_lab_order'];
	$username = $_SESSION['username'];
	
	// make database connection
	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	// get the entire lab order
	$stmt = $conn->prepare("SELECT * FROM lab_order WHERE lab_order_id=:lab_order_id");
	$stmt->execute(array('lab_order_id' => $lab_order_id));
	$lab_order_array = $stmt->fetch(PDO::FETCH_ASSOC);

	// get all checkbox column names
	$stmt = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'hope_matters' AND TABLE_NAME = 'lab_order' AND COLUMN_TYPE = 'enum(\'yes\',\'no\')';");
	$stmt->execute();
	$lab_order_checkbox_columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

	
	// iterates through all the needed post values
	foreach ($_POST as $key => $value) {

		if ($value == 'on') {
			$value = 'yes';
		}
			
		if ($value != '' and $key != 'submit_button') {

			$update_query_string = $update_query_string . $key .  " = '" . query_format($value) . "', ";
			
		}

	}
	
	// checkboxes checked post a value of 'on', loop below sets all other values to no
	foreach ($lab_order_checkbox_columns as $row) {
		
		if (strpos($update_query_string, $row['COLUMN_NAME']) === false) {
			$column_name = $row['COLUMN_NAME'];
			$update_query_string = $update_query_string . $row['COLUMN_NAME'] .  " = 'no', ";

		}
				
	}

	// preps the insert_query_string for history insert
	foreach ($lab_order_array as $key => $value) {
	
		$insert_query_string = $insert_query_string . $key . ", ";

	}


	$insert_query_string = substr($insert_query_string, 0, -2);
	$update_query_string = $update_query_string . "created_by='$username'";

	
	try {
		
	
			$query = "INSERT INTO lab_order_history ($insert_query_string) SELECT $insert_query_string FROM lab_order WHERE lab_order_id='$lab_order_id';"; 
			$conn->exec($query);
			
			$query = "UPDATE lab_order SET $update_query_string WHERE lab_order_id='$lab_order_id';"; 
			$conn->exec($query);
		
		
		// redirect user back to where they can select a lab order
		header( 'Location: select_lab_order.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_lab_order.php', $e->getMessage());
	}

	$conn = null;
