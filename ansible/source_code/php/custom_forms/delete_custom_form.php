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

$conn = new PDO($dbconnection_custom, $dbusername_custom, $dbpassword_custom);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		
$table_name = $_POST['form'];
$table_name_meta = $table_name . '_meta';
$table_name_history = $table_name . '_history';

// removes all uploaded files
rrmdir("/var/www/html/uploaded_images/custom_forms/{$table_name}");


try {		
			
		$query = "DROP TABLE IF EXISTS $table_name;"; 
		$conn->exec($query);

		$query = "DROP TABLE IF EXISTS $table_name_meta;"; 
		$conn->exec($query);

		$query = "DROP TABLE IF EXISTS $table_name_history;"; 
		$conn->exec($query);

		header( 'Location: /php/custom_forms/select_delete_custom_form.php');
		exit();

}


catch(PDOException $e) {
	create_database_error($query, 'select_delete_custom_form.php', $e->getMessage());
}

$conn = null;
