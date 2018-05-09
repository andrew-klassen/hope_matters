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
	<script src="/js/child_growth_validation.js" type="text/javascript"></script>
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
	  
	  <div style="float: left;  width: 300px;">
        <form method="post" action="change_child_welfare_care.php">
            <input style="width: 300px;" type="submit" value="Back to Form">
        </form>
      </div>
	  
  </div>
  <br></br>

	<!-- the login card -->
	<div class="login-card">

		<form action="update_child_growth.php" name="child_growth" onsubmit="return validate_form()" method="post">
			<?php
			
			require('../database_credentials.php');
			session_start();

			// make sure user is logged in
			login_check();
			
			$choosen_child_growth_id = $_SESSION['choosen_child_growth_id'];
			
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

			
			// make database connection
			$conn = new PDO($dbconnection, $dbusername, $dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			
			
			
			$stmt = $conn->prepare("SELECT weight FROM child_growth WHERE child_growth_id='$choosen_child_growth_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$weight = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT weight_percentile FROM child_growth WHERE child_growth_id='$choosen_child_growth_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$weight_percentile = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT height FROM child_growth WHERE child_growth_id='$choosen_child_growth_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$height = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT height_percentile FROM child_growth WHERE child_growth_id='$choosen_child_growth_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$height_percentile = $_SESSION['temp'];
			
			
			echo "Weight: <input type='text' name='child_growth_weight' value='$weight' autofocus onfocus='this.value = this.value;'>
				  Weight Percentile: <input type='number' name='child_growth_weight_percentile' value='$weight_percentile'>
				  Height: <input type='number' name='child_growth_height' value='$height'>
				  Height Percentile: <input type='number' name='child_growth_height_percentile' value='$height_percentile'>";
			
			
			?>
			<input type="submit" name="login" class="login login-submit" value="Change">
		</form>
	</div>
	
	
</body>

</html>