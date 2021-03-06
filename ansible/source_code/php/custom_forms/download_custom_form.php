<?php

/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen

*/



require('../database_credentials.php');
require('../json_functions.php');

session_start();
				
login_check();

$conn = new PDO($dbconnection_custom, $dbusername_custom, $dbpassword_custom);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


class grab_value extends RecursiveIteratorIterator {
	function __construct($it) {
		parent::__construct($it, self::LEAVES_ONLY);
	}
	function current() {
		$_SESSION['temp'] = parent::current();
	}
	function beginChildren() {
				
	}
	function endChildren() {
				
	}

}

class get_table_columns extends RecursiveIteratorIterator {
	function __construct($it) {
		parent::__construct($it, self::LEAVES_ONLY);
	}
	function current() {			
		array_push($_SESSION['table_columns'], parent::current());
	}
		
}

class get_table_columns_meta extends RecursiveIteratorIterator {
	function __construct($it) {
		parent::__construct($it, self::LEAVES_ONLY);
	}
	function current() {
		return parent::current();

	}
			
}


$form_name = $_SESSION['choosen_form'];
$table_name = database_format($form_name);
$meta_table = $table_name . '_meta';
$file_name = $table_name . '.json';


// anything echo'ed below this lines will appear in the json download
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=$file_name");


				$stmt = $conn->prepare("SELECT value FROM $meta_table WHERE attribute = 'client_linked';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$client_linked = $_SESSION['temp'];

				// begining of json string
				$json_object = "{\"form_name\": \"$form_name\", \"meta\": {\"client_linked\": $client_linked }, \"body\": {";

				// gets the tables columns
				$_SESSION['table_columns'] = array();

    				$stmt = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'custom_forms' AND TABLE_NAME = '$table_name';");
			    	$stmt->execute();
			   	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
							
			   	foreach(new get_table_columns(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

			   	}
				$table_columns = $_SESSION['table_columns'];


				// include meta tables
				$stmt = $conn->prepare("SELECT attribute FROM $meta_table WHERE attribute LIKE 'column_%';");
			    	$stmt->execute();
			   	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
							
			   	foreach(new get_table_columns_meta(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										
					
					$temp_column_meta = array();
					$temp_column_meta = explode("_", $v);
					array_splice( $table_columns, $temp_column_meta[1], 0, $v);
					unset($temp_column_meta);
					
			   	}


				$table_columns_max = count($table_columns);		
				
				$stmt = $conn->prepare("SELECT value FROM $meta_table WHERE attribute = 'start_column';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$start_column = $_SESSION['temp'];
				$_SESSION['start_column'] = $start_column;


				$start_found = false;
				$first_column = true;
				$auto_focus = "autofocus onfocus='this.value=this.value'";
				$form_array = array();
				$focused = true;

				// iterate through all columns
				for($i = 0; $i < $table_columns_max; ++$i) {
					
					if ($table_columns[$i] == $start_column) {
						$start_found = true;
					}
					else if ($table_columns[$i] == 'timestamp') {
						break;
					}

					if ($start_found) {

						$attribute_value = '';
						$_SESSION['temp'] = '';

						$stmt = $conn->prepare("SELECT `value` FROM $meta_table WHERE attribute LIKE 'column_{$i}_%' LIMIT 1;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						
						}
						$attribute_value = $_SESSION['temp'];


						if (substr( $table_columns[$i], 0, 7 ) == "column_") {

							$temp_column_array = array();
							$temp_column_array = explode('_', $table_columns[$i]);

							switch ($temp_column_array[2]) {
								case 'image':
									switch ($temp_column_array[3]) {
										case 'small':
											$json_object = $json_object . "\"" . $attribute_value . "\" : \"image_small\",";
											break;
										case 'medium':
											$json_object = $json_object . "\"" . $attribute_value . "\" : \"image_medium\",";
											break;
										case 'large':
											$json_object = $json_object . "\"" . $attribute_value . "\" : \"image_large\",";
											break;
										case 'large-short':
											$json_object = $json_object . "\"" . $attribute_value . "\" : \"image_large-short\",";
											break;
									}
									break;
								case 'text':
									$json_object = $json_object . "\"" . $attribute_value . "\" : \"text\",";
									break;

								case 'bold':
									$json_object = $json_object . "\"" . $attribute_value . "\" : \"bold_text\",";
									break;

								case 'image-upload':
																	
									switch ($temp_column_array[3]) {
										case 'small':
											$json_object = $json_object . "\"" . $attribute_value . "\" : \"image-upload_small\",";
											break;
										case 'medium':
											$json_object = $json_object . "\"" . $attribute_value . "\" : \"image-upload_medium\",";
											break;
										case 'large':
											$json_object = $json_object . "\"" . $attribute_value . "\" : \"image-upload_large\",";
											break;
										case 'large-short':
											$json_object = $json_object . "\"" . $attribute_value . "\" : \"image-upload_large-short\",";
											break;
									}
									break;
								case 'textbox':
									$json_object = $json_object . "\"{$attribute_value}\":{\"type\":\"textbox_array\",\"labels\":[";
									++$i;
									do {
										
										$current_column = $table_columns[$i];
										$column_label = str_replace("_{$attribute_value}", '', $current_column);
										$column_label = html_format($column_label);
										
										$json_object = $json_object . "\"$column_label\",";

										++$i;
										
									} while (strpos($table_columns[$i], $attribute_value) !== false);
										
										--$i;			
										$json_object = substr($json_object, 0, -1);														
										$json_object = $json_object . "]},";
										
									break;

							}
							
							continue;

						}
						
						$column_label = html_format($table_columns[$i]);
						$current_column = query_format($table_columns[$i]);


						$stmt = $conn->prepare("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'custom_forms' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$current_column';");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						
						}
						$current_column_type = $_SESSION['temp'];

						
						switch ($current_column_type) {

						    case 'varchar(50)':
							$json_object = $json_object . "\"" . $column_label . "\" : \"textbox\",";
							break;
						    case 'int(11)':
							$json_object = $json_object . "\"" . $column_label . "\" : \"integer\",";
							break;
						    case 'tinytext':
							$json_object = $json_object . "\"" . $column_label . "\" : \"textarea\",";
							break;
						    case 'text':
							$json_object = $json_object . "\"" . $column_label . "\" : \"textarea_large\",";
							break;
						    case 'date':
							$json_object = $json_object . "\"" . $column_label . "\" : \"date\",";
							break;
						    
						}

						if ($current_column_type == "enum('yes','no')") {

							$json_object = $json_object . "\"" . $column_label . "\" : \"checkbox\",";
						
						}
						
						else if(substr( $current_column_type, 0, 4 ) === "enum") {
						
							$current_column_type = substr($current_column_type, 5);
							$current_column_type = substr($current_column_type, 0, -1);
							$current_column_type = str_replace('\'', '', $current_column_type);
							$current_column_type = str_replace(',', ' ', $current_column_type);
							
							$radio_json_temp = '';
							$radio_button_array = explode(' ', $current_column_type);
							foreach ($radio_button_array as &$current_button) {
							
								$radio_json_temp = $radio_json_temp . "\"" . $current_button . "\",";

							}

							$radio_json_temp = substr($radio_json_temp, 0, -1);
							$json_object = $json_object . "\"" . $column_label . "\"" . " : { \"type\" : \"radio_button_group\", \"buttons\" : " . "[" . $radio_json_temp . "]},";
							
						}

						if($focused && $start_found) {

							$first_column = false;
							$auto_focus = '';
							$focused = false;
							
						}

					}
				}


$json_object = substr($json_object, 0, -1);
$json_object = $json_object . "}}";
$json_object = make_json_readable($json_object);


// displays the json
echo $json_object;
echo $content;
