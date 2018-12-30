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





$conn = new PDO($dbconnection_custom, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$choosen_custom_form_id = $_SESSION['choosen_custom_form_id'];
$username = $_SESSION['username'];
$table_name = $_SESSION['database_table_name'];
$table_name_history = $table_name . '_history';
$table_id = $table_name . '_id';
$table_columns_temp = $_SESSION['table_columns'];
$table_columns_temp_max = count($_SESSION['table_columns']);

$start_found = false;

$table_columns = array();

for($i = 0; $i < $table_columns_temp_max; ++$i) {

	//echo $table_columns_temp[$i];
	if ($table_columns_temp[$i] == $_SESSION['start_column']) {
		$start_found = true;

	}
	if ($table_columns_temp[$i] == 'timestamp') {
		break;
	}
	else if ($start_found){
		array_push($table_columns, $table_columns_temp[$i]);

	}
	
	
}
$column_array = array();

$table_columns_max = count($table_columns);
for($i = 0; $i < $table_columns_max; ++$i) {
		array_push($column_array, $table_columns[$i]);
		$insert_columns = $insert_columns . $table_columns[$i] . ', '; 
		$current_column = $table_columns[$i];
		$update_values = $update_values .  $current_column ." = '" . $_POST[$current_column] . "'" . ', ';
		
}

$update_values = substr($update_values, 0, -2);
$insert_columns = substr($insert_columns, 0, -2);


foreach ($column_array as $current_column) {
	

	$stmt = $conn->prepare("SELECT $current_column FROM $table_name WHERE $table_id='$choosen_custom_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$previous_value = $_SESSION['temp'];


	$insert_values = $insert_values . "'" . $previous_value . "', ";

}


$stmt = $conn->prepare("SELECT timestamp FROM $table_name WHERE $table_id='$choosen_custom_form_id'");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
}
$previous_value = $_SESSION['temp'];


$insert_values = $insert_values . "'" . $previous_value . "', ";



$stmt = $conn->prepare("SELECT created_by FROM $table_name WHERE $table_id='$choosen_custom_form_id'");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
}
$previous_value = $_SESSION['temp'];


$insert_values = $insert_values . "'" . $previous_value . "', ";





$insert_values = substr($insert_values, 0, -2);



echo $insert_columns . '<br>';
echo $insert_values . '<br>';




	try {		
		$query = "INSERT INTO $table_name_history ($insert_columns, timestamp, created_by, $table_id) VALUES ($insert_values, $choosen_custom_form_id);"; 
		$conn->exec($query);

		$query = "UPDATE $table_name SET $update_values, created_by = '$username' WHERE $table_id = '$choosen_custom_form_id';";
		$conn->exec($query);
			
		
	
		// redirect user back to where they can add more secrets
		header( 'Location: /php/custom_forms/select_add_or_change.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_custom_form.php', $e->getMessage());
	}

$conn = null;
