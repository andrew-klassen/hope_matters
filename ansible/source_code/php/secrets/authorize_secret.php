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


<div class='accountCard' style="width: 700px; height: 540px;">
  
	<p style='color: black;text-align: center;'>Authorize Secret</p>
	
	<form action='/php/secrets/validate_secret_password.php' name='authorized_secret' onsubmit='return validate_form()' method='post' enctype='multipart/form-data' >
	
			  <div style='width: 700px;  margin-left: 50px; margin-top: 10px; float: left;'>
				<b>Label:</b>
				
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
					
					
					$stmt = $conn->prepare("SELECT description FROM secrets WHERE secret_id='$secret_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$description = $_SESSION['temp'];
					
				
					echo " $label <br><br>

					<b>Description:</b><br>
					<textarea name='notes' style='width: 600px; height: 200px; margin-top: 5px;'  maxlength='255' disabled>$description</textarea>
					<br><b>Password:</b><br>
					<input style='width: 600px;height: 35px;' type='password' name='secret_password' maxlength='200' autofocus onfocus='this.value = this.value'>
					<div>Key File<br><input type='file' name='key_file' id='key_file'><br><label style='font-size: 12px;'>(.txt document 3072 characters max)</label></div>";
				?>
				
		  
</div>

	<div style='margin-left: 50px;float: left;width: 700px; height: 50px; margin-top: 20px;'><input style='float: left; width: 200px;' type='submit' name='submit_button' class='submitbtn' value='View Secret'>
			  
	</form>

	<form action='/php/secrets/validate_secret_password_auto.php' name='authorized_secret' onsubmit='return validate_form()' method='post'>
		<input style=' width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Auto Authorize'>
	</form>

	<form action='/php/secrets/validate_secret_password_one_time.php' name='authorized_secret' onsubmit='return validate_form()' method='post'>
		<input style='width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Create Key'>
	</form>
		
  </div> 
</body>
</html>
