<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<!DOCTYPE html>
<html>

<head>
<title>Hope Matters</title>
	<link rel="icon" href="/images/hope_matters_logo.png">
	<link rel="stylesheet" type="text/css" href="/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/css/add_client.css">
	<link rel="stylesheet" type="text/css" href="/css/optometry.css">
	<script src="/js/optometry_validation.js" type="text/javascript"> </script> 
</head>

<body style="padding-top: 70px;">

  <!-- nav bar -->
  <div id="container">
	   
	  <div id="sign-out">
        <form method="post" action="/php/dashboard.php">
            <input type="submit" value="Dashboard">
        </form>
      </div>
	  
	  <div id="sign-out">
        <form method="post" action="/php/sign_out.php">
            <input type="submit" value="Sign Out">
        </form>
      </div>
	  
	  <div style="float: left;  width: 400px;">
        <form method="post" action="/php/custom_forms/select_add_or_change.php">
            <input style="width: 400px;" type="submit" value="Back to Form Dashboard">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- all divs are within this div, it keeps the divs centered -->
<div style="width:970px; margin: 0 auto; ">
  	
	
<?php

		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_client_id =  1;$_SESSION['choosen_client_id'];
		$username = $_SESSION['username'];
		$choosen_form = $_SESSION['choosen_form'];
		$today = date("Y-m-d"); 
		
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
		
		// used to display list of clinicians in the database 
		class display_clinicians extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			function current() {
					
				return "<option value='" . parent::current() . "'>";
			}
			function beginChildren() {
				echo "<tr>";
			}
			function endChildren() {
				echo "</tr>" . "\n";
			}
		}

		class get_meta_tables extends RecursiveIteratorIterator {
				function __construct($it) {
					parent::__construct($it, self::LEAVES_ONLY);
				}
				function current() {
						
						array_push($_SESSION['meta_tables'], parent::current());

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

		
		// create database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		

		// grab first name
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		// grab occupation
		$stmt = $conn->prepare("SELECT occupation FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$occupation = $_SESSION['temp'];
		

		if ($_SESSION['client_linked'] == 'true') {
		
		// get the client's age
		$age = get_age_from_date_of_birth($date_of_birth);

			echo "<div class='accountCard' style='float: left;  width: 885px; height: 150px;' >
		<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>";		

			// display general info
			echo "<div style=' padding-left: 10px; float: left;'>";
			echo '<b>Client ID:</b>' . "<br>" . "<br>";
			echo '<b>Sex:</b>' . "<br>" . "<br>";
			echo "</div>";
			
			echo "<div style=' float: left;padding-left: 20px;width: 50px;'>";
			echo $choosen_client_id . "<br>" . "<br>";
			echo $sex;
			echo "</div>";
			
			echo "<div style=' float: left;padding-left: 30px;'>";
			echo '<b>First Name:</b>' . "<br>" . "<br>";
			echo '<b>Last Name:</b>' . "<br>" . "<br>";
			echo "</div>";
			
			echo "<div style=' float: left;padding-left: 15px; width: 170px;'>";
			echo $first_name . "<br>" . "<br>";
			echo $last_name;
			echo "</div>";
			
			echo "<div style=' float: left;padding-left: 30px;'>";
			echo '<b>Today\'s Date:</b>' . "<br>" . "<br>";
			echo '<b>Age:</b>' . "<br>" . "<br>";
			echo "</div>";
			
			echo "<div style=' float: left;padding-left: 15px;width: 180px;'>";
			echo date("m/d/Y") . "<br>" . "<br>";
			echo $age . "<br>" . "<br>";
			echo "</div>";
			
			echo "<div style=' float: left; padding-left: 10px; width: 442px;'>";
			echo '<b>Residence:</b>' . '<lable style="padding-left: 5px;">' . $location . '</lable>';
			echo "</div>";
			
			echo "<div style=' float: left;padding-left: 30px; width: 350px;'>";
			echo '<b>Occupation:</b>' . '<lable style="padding-left: 25px;">' . $occupation . '</lable>';
			echo "</div>";
			
			echo '</div>';

		}


				$conn = new PDO($dbconnection_custom, $dbusername, $dbpassword);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 						
				
				$table_name = $_SESSION['database_table_name'];
				$meta_table = $table_name . '_meta';
				

				// get all columns of the table
				$_SESSION['table_columns'] = array();

    				$stmt = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'custom_forms' AND TABLE_NAME = '$table_name';");
			    	$stmt->execute();
			   	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
							
			   	foreach(new get_table_columns(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

			   	}
				$table_columns = $_SESSION['table_columns'];
				
				
				// this include meta columns into the table columns array
				$stmt = $conn->prepare("SELECT attribute FROM $meta_table WHERE attribute LIKE 'column_%';");
			    	$stmt->execute();
			   	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
							
			   	foreach(new get_table_columns_meta(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										
					$temp_column_meta = array();
					$temp_column_meta = explode("_", $v);
					array_splice( $table_columns, $temp_column_meta[1], 0, $v);
					unset($temp_column_meta);
					
			   	}
					
				$_SESSION['table_columns'] = $table_columns;		
				$table_columns_max = count($_SESSION['table_columns']);	


				// get the tables start column
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

				// iterate through all table's columns
				for($i = 0; $i < $table_columns_max; ++$i) {
					
					if ($table_columns[$i] == $start_column) {
						$start_found = true;
					}
					else if ($table_columns[$i] == 'timestamp') {
						break;
					}
					
					
					// skip until start column, columns like client_id and date of birth don't need form fields
					if ($start_found) {
						
						$column_label = html_format($table_columns[$i]);
						$current_column = query_format($table_columns[$i]);
						$html_name = html_name_format($table_columns[$i]);
						

						$stmt = $conn->prepare("SELECT COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'custom_forms' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$current_column';");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
							
						}
						$current_column_default = $_SESSION['temp'];


						$stmt = $conn->prepare("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'custom_forms' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$current_column';");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						
						}
						$current_column_type = $_SESSION['temp'];
						
						
						// below in for in the event that the column is meta
						$attribute_value = '';
						$_SESSION['temp'] = '';
						

						$stmt = $conn->prepare("SELECT `value` FROM $meta_table WHERE attribute REGEXP  '^column_{$i}_.*$' LIMIT 1;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						
						}
						$attribute_value = $_SESSION['temp'];

						
						$stmt = $conn->prepare("SELECT `attribute` FROM $meta_table WHERE attribute REGEXP  '^column_{$i}_.*$' LIMIT 1;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						
						}
						$attribute_name = $_SESSION['temp'];
						

						if ($attribute_value != '') {
							$attribute_name_array = array();
							$attribute_name_array = explode("_", $attribute_name);
							
							// meta columns are stored in the following format column_<number>_<main_attribute>_<sub-attribute>
							switch ($attribute_name_array[2]) {
								case 'image':
									switch ($attribute_name_array[3]) {
										case 'small':
											array_push($form_array, "<div style='height: 100px; '><img style='height: 100px; width: 100px; ' src='$attribute_value' alt='unable to load image'></div>");
											break;
										case 'medium':
											array_push($form_array, "<div style='height: 300px; '><img style='height: 300px; width: 300px; ' src='$attribute_value' alt='unable to load image'></div>");
											break;
										case 'large':
											array_push($form_array, "<div style='height: 800px; '><img style='height: 800px; width: 800px; ' src='$attribute_value' alt='unable to load image'></div>");
											break;
										case 'large-short':
											array_push($form_array, "<div style='height: 400px; '><img style='height: 400px; width: 800px; ' src='$attribute_value' alt='unable to load image'></div>");
											break;
									}
									break;
								case 'image-upload':
									switch ($attribute_name_array[3]) {
										case 'small':
											array_push($form_array, "<div style='padding-left: 110px;height: 100px;'><img style='height: 100px; width: 100px; ' src='$attribute_value' alt='unable to load image'></div>");
											break;
										case 'medium':
											array_push($form_array, "<div style='height: 300px;'><img style='height: 300px; width: 300px; ' src='$attribute_value' alt='unable to load image'></div>");
											break;
										case 'large':
											array_push($form_array, "<div style='height: 800px;'><img style='height: 800px; width: 800px; ' src='$attribute_value' alt='unable to load image'></div>");
											break;
										case 'large-short':
											array_push($form_array, "<div style='height: 400px;'><img style='height: 400px; width: 800px; ' src='$attribute_value' alt='unable to load image'></div>");
											break;

									}
									break;
								case 'text':
									array_push($form_array,"<div style='height: 50px;margin-top: 10px;'><p style='font-size:18px;'>$attribute_value</p></div>");
									break;

								case 'bold':
									array_push($form_array,"<div style='height: 50px;margin-top: 10px;'><p style='font-size:18px;'><b>$attribute_value</b></p></div>");
									break;
								case 'textbox':
									$textbox_array_temp = "<div style='width: 800px;height: 50px;'>";
									++$i;
									
									do {

										$current_column = $table_columns[$i];
										$html_name = html_name_format($table_columns[$i]);
										$column_label = str_replace("_{$attribute_value}", '', $current_column);
										$column_label =  html_format($column_label);


										$textbox_array_temp = $textbox_array_temp . "<div style='height: 50px; float: left;margin-left: 15px;'>$column_label: <input style='height: 35px; width: 100px;' type='text' name='$html_name' maxlength='25' $auto_focus></div>";
										++$i;
										
									} while (strpos($table_columns[$i], $attribute_value) !== false);
										
										--$i;	
										$textbox_array_temp = $textbox_array_temp . "</div>";
										array_push($form_array, $textbox_array_temp);
									
									break;

							}

							continue;

						}
						
						// checkbox
						else if ($current_column_type == "enum('yes','no')") {
						
							array_push($form_array, "<div style='height: 40px;'><input type='hidden' name='$html_name' value='no'><input type='checkbox' name='$html_name' value='yes' >$column_label </div>"); 						
						}

						// radio_button_group
						else if(substr( $current_column_type, 0, 4 ) === "enum") {
						
							$temp_html = "<div style='height: 50px;'>$column_label: ";
							$current_column_type = substr($current_column_type, 5);
							$current_column_type = substr($current_column_type, 0, -1);
							$current_column_type = str_replace('\'', '', $current_column_type);
							$current_column_type = str_replace(',', ' ', $current_column_type);

							$radio_button_array = explode(' ', $current_column_type);
							foreach ($radio_button_array as &$current_button) {
							
								$temp_html = $temp_html . "<input type='radio' name='$current_column' value='$current_button' checked>$current_button ";

							}

							$temp_html = $temp_html . "</div>";
							array_push($form_array, $temp_html);

						}
											
						
						switch ($current_column_type) {

						    case 'varchar(50)':
							
							array_push($form_array,"<div style='height: 50px;'>$column_label: <input style='height: 35px; width: 500px;' type='text' name='$html_name' maxlength='50' $auto_focus></div>");
							break;
						    case 'int(11)':
							array_push($form_array,"<div style='height: 50px;'>$column_label: <input style='height: 35px; width: 150px;' type='number' value='0' name='$html_name' $auto_focus></div>");
							break;
						    case 'text':
						    	array_push($form_array,"<div style='height: 300px;'> $column_label: <br><textarea style='height: 250px; width: 800px;' name='$html_name' maxlength='5000' $auto_focus></textarea></div>");
							break;
						    case 'tinytext':
							array_push($form_array,"<div style='height: 200px;'>$column_label: <br><textarea style='height: 150px; width: 500px;' name='$html_name' maxlength='255' $auto_focus></textarea></div>");
							break;
						    case 'date':
							array_push($form_array,"<div style='margin-top: 15px;height: 50px;'>$column_label: <input style='height: 25px; width: 150px;' type='date' value='$today' name='$html_name' $auto_focus></div>");
							break;
						    case 'varchar(1000)':
							array_push($form_array,"<div style='margin-top: 10px;margin-left: 80px;height: 80px;'>Add/Change Image <br><input type='file' name='$html_name' id='$html_name'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label></div>");
							break;
						    
						}
						
						
						// set curror to first field on the form
						if($focused && $start_found) {
							
							$first_column = false;
							$auto_focus = '';
							$focused = false;
							
						}

					}
				}

echo "<div class='accountCard' style='float: left; width: 885px; position: relative;'>
      <form name='custom_form' action='insert_custom_form.php' onsubmit='return validate_form()' method='post' enctype='multipart/form-data'>
      <p class='p'style='color: black;font-weight:100; text-align: center;'>$choosen_form</p>";
				
				// echo out all html elements
				$form_array_max = count($form_array);
				for($i = 0; $i < $form_array_max; ++$i) {
					
					echo $form_array[$i];		
			
				}

?>
			
			<div style="width: 200px; margin-left: 350px; margin-top: 50px;">		
				<input type="submit" name="submit_button" class="submitbtn" value="Submit">
			</div>
			
		</form>
		
	</div>
	
 </div>
  
</body>
</html>
