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
				

				$_SESSION['table_columns'] = array();

    				$stmt = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'custom_forms' AND TABLE_NAME = '$table_name';");
			    	$stmt->execute();
			   	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
							
			   	foreach(new get_table_columns(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

			   	}
				$table_columns = $_SESSION['table_columns'];



				$table_columns_max = count($_SESSION['table_columns']);		

				
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

				for($i = 0; $i < $table_columns_max; ++$i) {
					
					if ($table_columns[$i] == $start_column) {
						$start_found = true;
					}
					else if ($table_columns[$i] == 'timestamp') {
						break;
					}

					if ($start_found) {

						$stmt = $conn->prepare("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'custom_forms' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$table_columns[$i]';");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						
						}
						$current_column_type = $_SESSION['temp'];
						
						$column_label = ucfirst($table_columns[$i]);
						$column_label = str_replace('_', ' ', $column_label);
						$current_column = $table_columns[$i];

						switch ($current_column_type) {
						    case 'varchar(50)':
							array_push($form_array,"<div style='height: 50px;'>$column_label: <input style='height: 35px; width: 500px;' type='text' name='$current_column' maxlength='50' $auto_focus></div>");
							break;
						    case 'tinytext':
							array_push($form_array,"<div style='height: 200px;'>$column_label: <br><textarea style='height: 150px; width: 500px;' name='$current_column' maxlength='255' $auto_focus></textarea></div>");
							break;
						    case 'text':
							array_push($form_array,"<div style='height: 300px;'>$column_label: <br><textarea style='height: 250px; width: 800px;' name='$current_column' maxlength='5000' $auto_focus></textarea></div>");
							break;
						    
						}

						if(substr( $current_column_type, 0, 4 ) === "enum") {
						
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




					if($focused && $start_found) {
						$first_column = false;
						$auto_focus = '';
						$focused = false;
						
						
					}

					}
				}

echo "<div class='accountCard' style='float: left; width: 885px; position: relative;'>
	
		<form name='custom_form' action='insert_custom_form.php' onsubmit='return validate_form()' method='post'>";


echo "<p class='p'style='color: black;font-weight:100; text-align: center;'>$choosen_form</p>";






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
