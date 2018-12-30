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
	<link rel="stylesheet" type="text/css" href="/css/index.css">
	<link rel="stylesheet" type="text/css" href="/css/navbar.css">
	<!--<script src="/js/password_validation.js" type="text/javascript"> </script>-->
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

	<div id="Form Selection" style="width: 300px;">
        <form method="post" action="/php/custom_forms/select_custom_form.php">
            <input style="width: 300px;" type="submit" value="Form Selection">
        </form>
      </div>

	  
  </div>
  <br></br>

<!-- below is the code that generates the password change card -->
	<div class="login-card">
		
		<?php

			require('../database_credentials.php');
			session_start(); 
			echo '<h1>' . $_SESSION['choosen_form'] . '</h1>';
class get_meta_tables extends RecursiveIteratorIterator {
				function __construct($it) {
					parent::__construct($it, self::LEAVES_ONLY);
				}
				function current() {
						
						array_push($_SESSION['meta_tables'], parent::current());

				}
				
		}

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

				$choosen_form = $_SESSION['choosen_form'];
				
				$_SESSION['meta_tables'] = array();

    				$stmt = $conn->prepare("SHOW tables IN custom_forms LIKE '%_meta';");
			    	$stmt->execute();
			   	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
							
			   	foreach(new get_meta_tables(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

			   	}

			    	

			   	$meta_tables = $_SESSION['meta_tables'];
				
				$meta_tables_max = count($_SESSION['meta_tables']);
				


				for($i = 0; $i < $meta_tables_max; ++$i) {

					
					$stmt = $conn->prepare("SELECT value FROM $meta_tables[$i] WHERE attribute = 'database_table_name';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
					}
					$_SESSION['database_table_name'] = $_SESSION['temp'];

					
					$stmt = $conn->prepare("SELECT value FROM $meta_tables[$i] WHERE attribute = 'form_name';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
					}
					$_SESSION['form_name'] = $_SESSION['temp'];
	
					if ($choosen_form == $_SESSION['form_name']) {
					
						$table_name = $_SESSION['database_table_name'];
						$meta_table = $table_name . '_meta';
						break;

					}


				}









			if ($_SESSION['client_linked'] == 'false') {
				echo "<form action='/php/custom_forms/add_custom_form.php' name='password_form' onsubmit='return validate_form()' method='post'>
			
			
					<input type='submit' name='login' class='login login-submit' value='Add'>
				</form>
				<form action='/php/custom_forms/select_custom_form_individual_form.php' name='password_form' onsubmit='return validate_form()' method='post'>
					<input type='submit' name='login' class='login login-submit' value='Change'>
				</form>";

			}
			else {

				echo "<form action='/php/custom_forms/select_client_custom_form.php' name='password_form' onsubmit='return validate_form()' method='post'>
			
			
						<input type='submit' name='login' class='login login-submit' value='Add'>
					</form>
					<form action='/php/custom_forms/select_custom_form_individual_form.php' name='password_form' onsubmit='return validate_form()' method='post'>
						<input type='submit' name='login' class='login login-submit' value='Change'>
					</form>";				

			}



		?>
		
		
	</div>
	
</body>

</html>
