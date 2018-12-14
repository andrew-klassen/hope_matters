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
		<link rel='icon' href='/images/hope_matters_logo.png'>
		<link rel='stylesheet' type='text/css' href='/css/navbar.css'>
		<link rel='stylesheet' type='text/css' href='/css/add_client.css'>
		<script src="/js/add_item_validation.js" type="text/javascript"> </script>
	</head>

	
	<body style='padding-top: 70px;'>

	  <div id='container'>
		   
		  <div id='sign-out'>
			<form method='post' action='/php/dashboard.php'>
				<input type='submit' value='Dashboard'>
			</form>
		  </div>
		  
		  <div id='sign-out'>
			<form method='post' action='/php/sign_out.php'>
				<input type='submit' value='Sign Out'>
			</form>
		  </div>
		  
		  <div style="float: left;  width: 300px;">
        <form method="post" action="/php/secrets/select_secrets.php">
            <input style="width: 210px;" type="submit" value="Select Secret">
        </form>
      </div>
		  
	  </div>
	  <br></br>



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

					$secret_id = $_SESSION['choosen_secret_id'];
					
				
				
					// make database connection
					$conn = new PDO($dbconnection, $dbusername, $dbpassword);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


					$stmt = $conn->prepare("SELECT label FROM secrets WHERE secret_id='$secret_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$label = $_SESSION['temp'];
					
					
					
				
					echo " 

		

<div class='accountCard' style='width: 500px; height: 370px;'>
	
	<p style='color: black;text-align: center;'>Add Key</p>
	<b>label:</b> $label<br><br>
<form action='/php/secrets/insert_secret_key_one_time.php' name='add_secret_key' onsubmit='return validate_form()' method='post' enctype='multipart/form-data'>
	<b>Password:</b><br>
	<input style='height: 35px;' type='password' name='secret_password' autofocus onfocus='this.value = this.value'>
	<div>Key File<br><input type='file' name='key_file' id='key_file'><br><label style='font-size: 12px;'>(.txt document 4096 characters max)</label></div>
	<input  style='margin-top: 50px; margin-left: 150px; width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Add Key'>		
</form>

";


echo "
	

</div>
</body>
</html>";
$value = '';

