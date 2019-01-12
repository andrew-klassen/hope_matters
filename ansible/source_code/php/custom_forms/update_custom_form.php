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


$conn = new PDO($dbconnection_custom, $dbusername_custom, $dbpassword_custom);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$choosen_custom_form_id = $_SESSION['choosen_custom_form_id'];
$username = $_SESSION['username'];
$table_name = $_SESSION['database_table_name'];
$table_name_history = $table_name . '_history';
$table_id = $table_name . '_id';
$table_columns_temp = $_SESSION['table_columns'];
$table_columns_temp_max = count($_SESSION['table_columns']);
$start_found = false;


// gets all the non specific form columns
$table_columns = array();
for($i = 0; $i < $table_columns_temp_max; ++$i) {

	if ($table_columns_temp[$i] == $_SESSION['start_column']) {
		$start_found = true;

	}
	if ($table_columns_temp[$i] == 'timestamp') {
		break;
	}
	else if ($start_found){

		if ( ! strstr( $table_columns_temp[$i], 'column_' )) {
			array_push($table_columns, $table_columns_temp[$i]);
		}

	}
	
}

$column_array = array();


// use column data for update queries
$table_columns_max = count($table_columns);
for($i = 0; $i < $table_columns_max; ++$i) {

	array_push($column_array, $table_columns[$i]);
	$insert_columns = $insert_columns  . '`' . $table_columns[$i] . '`, '; 
	$current_column = query_format($table_columns[$i]);
	$html_name = html_name_format($table_columns[$i]);


	$stmt = $conn->prepare("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'custom_forms' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$current_column';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						
	}
	$current_column_type = $_SESSION['temp'];


	// if column is upload image
	if ($current_column_type == 'varchar(1000)' ) {

		$temp_image_name = $_FILES[$current_column]['name'];

		$stmt = $conn->prepare("SELECT $current_column FROM $table_name WHERE $table_id='$choosen_custom_form_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
							
		}
		$previous_image_path = $_SESSION['temp'];

		
		if ($temp_image_name != '') {
		
			$image_path = upload_file($current_column, $temp_image_name, 'change_custom_form.php', "../../uploaded_images/custom_forms/{$table_name}/in_use/");
			$previous_file_name = basename($previous_image_path);

			// move old image to archive folder			
			rename($previous_image_path, "../../uploaded_images/custom_forms/{$table_name}/no_longer_used/{$previous_file_name}");
		
		}
		else {
			$image_path = $previous_image_path;
		}

		$update_values = $update_values . '`' .  $table_columns[$i] ."` = '" . $image_path . "'" . ', ';
	}
	else {
	
		$update_values = $update_values . '`' . $table_columns[$i] ."` = '" . query_format($_POST[$html_name]) . "'" . ', ';
	}
	
}


// remove ending comma
$update_values = substr($update_values, 0, -2);
$insert_columns = substr($insert_columns, 0, -2);


// pepare insert query, used to archive the forms previous state
foreach ($column_array as $current_column) {	
		
	$stmt = $conn->prepare("SELECT `$current_column` FROM $table_name WHERE $table_id='$choosen_custom_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$previous_value = $_SESSION['temp'];

	$insert_values = $insert_values . "'" . query_format($previous_value) . "', ";

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


// remove ending comma
$insert_values = $insert_values . "'" . $previous_value . "', ";
$insert_values = substr($insert_values, 0, -2);


	try {		

		$query = "INSERT INTO $table_name_history ($insert_columns, timestamp, created_by, $table_id) VALUES ($insert_values, $choosen_custom_form_id);"; 
		$conn->exec($query);

		$query = "UPDATE $table_name SET $update_values, created_by = '$username' WHERE $table_id = '$choosen_custom_form_id';";
		$conn->exec($query);
			
		header( 'Location: /php/custom_forms/select_add_or_change.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'update_custom_form.php', $e->getMessage());
	}

$conn = null;
