<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('../database_credentials.php');
require('../file_upload.php');
require('../json_functions.php');

session_start();

// make sure user is logged in
login_check();

// grab json contents
$json_object = read_json_file('json_file');

$username = $_SESSION['username'];
$json_form_array = array();
$brace_count = 0;
$left_brace_index = 0;
$right_brace_index = 0;
$closed = false;
$left_brace_found = false;


// loop below breaks up the json forms and puts them into an array, one form per element
for ($i = 0; $i < strlen($json_object); ++$i){
	if ($json_object[$i] == '{') {
		if ( ! $left_brace_found) {
			$left_brace_index = $i;
			$left_brace_found = true;
		}
		++$brace_count;		
	}
	else if ($json_object[$i] == '}') {
		$right_brace_index = $i;
		--$brace_count;
		if ($brace_count == 0) {
			array_push($json_form_array, substr($json_object, $left_brace_index, $right_brace_index - $left_brace_index + 1));
			$left_brace_found = false;
			
			
		}
	}
}


$conn = new PDO($dbconnection_custom, $dbusername_custom, $dbpassword_custom);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$regex = '~"[^"]*"(*SKIP)(*F)|\s+~';

// for every json form
foreach ($json_form_array as $current_json_form) {

	// places current json form onto associative array
	$current_json_form = json_decode($current_json_form, true);
	$form_name = $current_json_form['form_name'];

	$database_table_name = database_format($form_name);
	$table_id = $database_table_name . '_id';
	$table_id_unique = $table_id . '_UNIQUE';

	$client_linked = $current_json_form['meta']['client_linked'];

	$meta_table_name = $database_table_name . '_meta';
	$meta_id = $meta_table_name . '_id';
	$meta_id_unique = $meta_id . '_UNIQUE';

	$history_table_name = $database_table_name . '_history';
	$history_id = $history_table_name . '_id';
	$history_id_unique = $history_id . '_UNIQUE';

	// create custom form image directories
	mkdir("/var/www/html/uploaded_images/custom_forms/{$database_table_name}", 0777);
	mkdir("/var/www/html/uploaded_images/custom_forms/{$database_table_name}/static", 0777);
	mkdir("/var/www/html/uploaded_images/custom_forms/{$database_table_name}/in_use", 0777);
	mkdir("/var/www/html/uploaded_images/custom_forms/{$database_table_name}/no_longer_used", 0777);


	// below is the not form specific, top half of the table create query
	$meta_table_create_query = "CREATE TABLE `$meta_table_name` (
	  `$meta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `attribute` varchar(100) DEFAULT NULL,
	  `value` varchar(1000) DEFAULT NULL,
	  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`$meta_id`),
	  UNIQUE KEY `$meta_id_unique` (`$meta_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

	$main_table_create_query = "CREATE TABLE `$database_table_name` (`$table_id` int(11) unsigned NOT NULL AUTO_INCREMENT,";
	$history_table_create_query = "CREATE TABLE `$history_table_name` (`$history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
									   `$table_id` int(11) unsigned NOT NULL,";

	if ($client_linked) {

		 $main_table_create_query = $main_table_create_query . "`client_id` int(11) DEFAULT NULL,
		  `first_name` varchar(25) DEFAULT NULL,
		  `last_name` varchar(25) DEFAULT NULL,
		  `location` varchar(45) DEFAULT NULL,
		  `date_of_birth` date DEFAULT NULL,
		  `sex` enum('male','female') DEFAULT NULL,";

		$history_table_create_query = $history_table_create_query . "`client_id` int(11) DEFAULT NULL,
		  `first_name` varchar(25) DEFAULT NULL,
		  `last_name` varchar(25) DEFAULT NULL,
		  `location` varchar(45) DEFAULT NULL,
		  `date_of_birth` date DEFAULT NULL,
		  `sex` enum('male','female') DEFAULT NULL,";

	}

	
	// for every form specific column
	$start_column_found = false;
	$meta_attributes = array();
	$meta_values = array();
	$counter = 0;


	// iterate through contents of file
	foreach ($current_json_form['body'] as $form_element => $value) {

		$original_form_element = $form_element;
		$form_element = database_format($form_element);

		if (! $start_column_found) {
			
			if ($client_linked) {
				$counter += 7;
				
			}
			else {
				$counter += 1;
			}

			if ($value == 'text') {
				$start_column = "column_{$counter}_text";
			}
			else if ($value == 'bold_text') {
				$start_column = "column_{$counter}_bold_text";

			}
			else if ($value == 'image_small') {
				$start_column = "column_{$counter}_image_small";
			}
			else if ($value == 'image_medium') {
				$start_column = "column_{$counter}_image_medium";
			}
			else if ($value == 'image_large') {
				$start_column = "column_{$counter}_image_large";
			}
			else if ($value == 'image_large-short') {
				$start_column = "column_{$counter}_image_large-short";
			}
			else if ($value == 'image-upload_small') {
				$start_column = "column_{$counter}_image-upload_small";
			}
			else if ($value == 'image-upload_medium') {
				$start_column = "column_{$counter}_image-upload_medium";
			}
			else if ($value == 'image-upload_large') {
				$start_column = "column_{$counter}_image-upload_large";
			}
			else if ($value == 'image-upload_large-short') {
				$start_column = "column_{$counter}_image-upload_large-short";
			}
			else if (is_array($value)) {
				
				switch ($current_json_form['body'][$original_form_element]['type']) {

					
					case 'textbox_array':
						$start_column = "column_{$counter}_textbox_array";
						
						break;
				}

			}
			else {

				$start_column = $form_element;

			}

			$start_column_found = true;

		}

		
		switch ($value) {
		    case 'textbox':
			
			$main_table_create_query = $main_table_create_query . "`$form_element` varchar(50) DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element` varchar(50) DEFAULT NULL,";
			break;

		    case 'textarea':
			
			$main_table_create_query = $main_table_create_query . "`$form_element` tinytext DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element` tinytext DEFAULT NULL,";
			break;

		    case 'date':
			
			$main_table_create_query = $main_table_create_query . "`$form_element` date DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element` date DEFAULT NULL,";
			break;

		    case 'integer':
			
			$main_table_create_query = $main_table_create_query . "`$form_element` int(11) DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element` int(11) DEFAULT NULL,";
			break;

		    case 'text':
			
			array_push($meta_values, "$original_form_element");
			array_push($meta_attributes, "column_{$counter}_text");
			break;

		    case 'bold_text':
			
			array_push($meta_values, "$original_form_element");
			array_push($meta_attributes, "column_{$counter}_bold_text");
			break;

		    case 'textarea_large':
			
			$main_table_create_query = $main_table_create_query . "`$form_element` text DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element` text DEFAULT NULL,";
			break;
			
		    case 'checkbox':
			
			$main_table_create_query = $main_table_create_query . "`$form_element` enum('yes','no') DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element` enum('yes','no') DEFAULT NULL,";
			break;

		    case 'image_small':
			
			rename("/var/www/html/uploaded_images/custom_forms/{$username}/{$form_element}", "/var/www/html/uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_values, "../../uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_attributes, "column_{$counter}_image_small");
			break;

		    case 'image_medium':
			
			rename("/var/www/html/uploaded_images/custom_forms/{$username}/{$form_element}", "/var/www/html/uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_values, "../../uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_attributes, "column_{$counter}_image_medium");
			break;

		    case 'image_large':
			
			rename("/var/www/html/uploaded_images/custom_forms/{$username}/{$form_element}", "/var/www/html/uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_values, "../../uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_attributes, "column_{$counter}_image_large");
			break;


		    case 'image_large-short':
			
			rename("/var/www/html/uploaded_images/custom_forms/{$username}/{$form_element}", "/var/www/html/uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_values, "../../uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_attributes, "column_{$counter}_image_large-short");
			break;

		    case 'image-upload_small':
			
			rename("/var/www/html/uploaded_images/custom_forms/{$username}/{$form_element}", "/var/www/html/uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_values, "../../uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_attributes, "column_{$counter}_image-upload_small");

			$form_element_format = strtok($form_element, '.');

			$main_table_create_query = $main_table_create_query . "`$form_element_format` varchar(1000) DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element_format` varchar(1000) DEFAULT NULL,";
			++$counter;
			break;

		     case 'image-upload_medium':
			
			rename("/var/www/html/uploaded_images/custom_forms/{$username}/{$form_element}", "/var/www/html/uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_values, "../../uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_attributes, "column_{$counter}_image-upload_medium");

			$form_element_format = strtok($form_element, '.');

			$main_table_create_query = $main_table_create_query . "`$form_element_format` varchar(1000) DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element_format` varchar(1000) DEFAULT NULL,";
			++$counter;
			break;

	            case 'image-upload_large':
			
			rename("/var/www/html/uploaded_images/custom_forms/{$username}/{$form_element}", "/var/www/html/uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_values, "../../uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_attributes, "column_{$counter}_image-upload_large");

			$form_element_format = strtok($form_element, '.');

			$main_table_create_query = $main_table_create_query . "`$form_element_format` varchar(1000) DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element_format` varchar(1000) DEFAULT NULL,";
			++$counter;
			break;


		    case 'image-upload_large-short':
			
			rename("/var/www/html/uploaded_images/custom_forms/{$username}/{$form_element}", "/var/www/html/uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_values, "../../uploaded_images/custom_forms/{$database_table_name}/static/{$form_element}");
			array_push($meta_attributes, "column_{$counter}_image-upload_large-short");

			$form_element_format = strtok($form_element, '.');

			$main_table_create_query = $main_table_create_query . "`$form_element_format` varchar(1000) DEFAULT NULL,";
			$history_table_create_query = $history_table_create_query . "`$form_element_format` varchar(1000) DEFAULT NULL,";
			++$counter;
			break;

		}

		if (is_array($value)) {

			switch ($current_json_form['body'][$original_form_element]['type']) {
				case 'radio_button_group':

					$radio_enum_array = "enum(";
					foreach($current_json_form['body'][$original_form_element]['buttons'] as $current_radio_element => $current_radio_element_value) {
						$radio_enum_array = $radio_enum_array . "'" . $current_radio_element_value . "', ";
					}
					$radio_enum_array = substr($radio_enum_array, 0, -2);
					$radio_enum_array = $radio_enum_array . ')';			

					$form_element_format = strtok($form_element, '.');

					$main_table_create_query = $main_table_create_query . "`$form_element_format` $radio_enum_array DEFAULT NULL,";
					$history_table_create_query = $history_table_create_query . "`$form_element_format` $radio_enum_array DEFAULT NULL,";	
					break;

				case 'textbox_array':
					
					array_push($meta_values, "$form_element");
					array_push($meta_attributes, "column_{$counter}_textbox_array");

					foreach($current_json_form['body'][$original_form_element]['labels'] as $current_label => $current_label_value) {

						$current_label_value = database_format($current_label_value);
						$temp_label = $current_label_value . '_' . $form_element;
						$main_table_create_query = $main_table_create_query . "`$temp_label` varchar(25) DEFAULT NULL,";
						$history_table_create_query = $history_table_create_query . "`$temp_label` varchar(25) DEFAULT NULL,";

					}

					$textbox_array_count = count($current_json_form['body'][$original_form_element]['labels']);
					$counter += $textbox_array_count;
					break;
			
			}		

		}
		
		++$counter;

	}


	// end of the create query
	$main_table_create_query = $main_table_create_query . "`timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  `created_by` varchar(20) DEFAULT NULL,
	  PRIMARY KEY (`$table_id`),
	  UNIQUE KEY `$table_id_unique` (`$table_id`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;";


	$history_table_create_query = $history_table_create_query . "`timestamp` timestamp DEFAULT CURRENT_TIMESTAMP,
	  `created_by` varchar(20) DEFAULT NULL,
	  PRIMARY KEY (`$history_id`),
	  UNIQUE KEY `$history_id_unique` (`$history_id`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;";


	if ($client_linked) {
		$client_linked = 'true';
	}
	else {
		$client_linked = 'false';
	}


	try {		
			
		$query = "$main_table_create_query"; 
		$conn->exec($query);

		$query = "$history_table_create_query"; 
		$conn->exec($query);

		$query = "$meta_table_create_query"; 
		$conn->exec($query);
			
		$query = "INSERT INTO `$meta_table_name` (`attribute`, `value`) VALUES ('form_name', '$form_name');"; 
		$conn->exec($query);

		$query = "INSERT INTO `$meta_table_name` (`attribute`, `value`) VALUES ('client_linked', '$client_linked');"; 
		$conn->exec($query);

		$query = "INSERT INTO `$meta_table_name` (`attribute`, `value`) VALUES ('database_table_name', '$database_table_name');"; 
		$conn->exec($query);

		$query = "INSERT INTO `$meta_table_name` (`attribute`, `value`) VALUES ('start_column', '$start_column');"; 
		$conn->exec($query);	

		$meta_max = count($meta_values);
		for ($i = 0; $i < $meta_max; ++$i) {
			$query = "INSERT INTO `$meta_table_name` (`attribute`, `value`) VALUES ('$meta_attributes[$i]', '$meta_values[$i]');"; 
			$conn->exec($query);
		}
		
		// remove empty temp directory, all static images should be moved out of it at this point
		rmdir("/var/www/html/uploaded_images/custom_forms/{$username}");	

	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_new_custom_form.php', $e->getMessage());
	}

}

$conn = null;

header( 'Location: /php/custom_forms/select_custom_form.php');
exit();
