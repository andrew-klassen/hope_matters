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


<div class='accountCard' style="width: 700px; height: 670px;">
  
	<p style='color: black;text-align: center;'>Secret</p>
	
	<form action='/php/secrets/delete_secret.php' name='authorized_secret' onsubmit='return validate_form()' method='post'>
	
			  <div style='width: 400px;  margin-left: 50px; margin-top: 10px; float: left;'>
				<b>Label:</b>
				<?php
					require('../crypto_settings.php');
					session_start();

					// make sure user is logged in
					login_check();
					

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
					$value = $_SESSION['value'];
				
				
					// make database connection
					$conn = new PDO($dbconnection_secret, $dbusername_secret, $dbpassword_secret);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


					$stmt = $conn->prepare("SELECT label, description FROM secrets WHERE secret_id = :secret_id;");
					$stmt->execute(array('secret_id' => $secret_id));
					$secret_row = $stmt->fetch(PDO::FETCH_ASSOC);

					$label = $secret_row['label'];
					$description = $secret_row['description'];

					$privilege = $_SESSION['privilege'];
					
				
					echo " $label <br><br>

					<b>Description:</b><br>
					<textarea name='notes' style='width: 600px; height: 200px; margin-top: 5px;'  maxlength='255' disabled>$description</textarea>
					<b>Value:</b><br>
					<textarea name='value' style='width: 600px; height: 200px; margin-top: 5px;'  maxlength='255' disabled>$value</textarea>
			<div style='width: 700px;'><br><b>Warning: Deleting this key will permanently remove it for all users.</b></div>";
				

				// disable delete button if not an admin
				if ($privilege == 'admin') {
					echo "<input style='background-color: red; margin-left: 200px; margin-top: 20px; width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Delete Secret'>";
				}
				else {
					echo "<input style='background-color: grey; margin-left: 200px; margin-top: 20px; width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Delete Secret' disabled>";
				}


		echo "
		       </div>
		  </form>

		
</div>";

			// only allow admin keys to create other keys or give users permission to create a key
			if ($privilege == 'admin') {

				echo "<div class='accountCard' style='width: 700px; height: 400px;'>
				        <p style='color: black;text-align: center;'>Add Key</p>
					<form action='/php/secrets/insert_secret_key.php' name='add_secret_key' onsubmit='return validate_form()' method='post' enctype='multipart/form-data'>
						<b>Password:</b><br>
						<input style='height: 35px;' type='password' name='secret_password' maxlength='200' autofocus onfocus='this.value = this.value'>
						<div>Key File<br><input type='file' name='key_file' id='key_file'><br><label style='font-size: 12px;'>(.txt document 3072 characters max)</label></div>
						<br><br><b>OR</b><br><br>
						<b>Username:</b><input list='clinician_list' name='username' maxlength='20'> <br>
					 	
						<datalist id='clinician_list'>";							
								
							$stmt = $conn->prepare("SELECT username FROM accounts;");
							$stmt->execute();
							$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
							foreach(new display_clinicians(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
								echo $v;
							}

							echo "<option value='Server Admins'> (special user)";
							echo "<option value='Everyone'> (special user)";
									
				echo "		</datalist>

				        	<br><br><input type='radio' id='privilege' name='privilege' value='admin' />Admin
				        	<input type='radio' id='privilege' name='privilege' value='read' checked />Read-Only<br>
				        	<input  style='margin-top: 50px; margin-left: 250px; width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Add Key'>		
					</form>"; 
			}


echo "
	

</div>
</body>
</html>";
$value = '';
