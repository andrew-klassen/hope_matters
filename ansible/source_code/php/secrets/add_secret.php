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
		<script src="/js/secret_key_file_generate.js" type="text/javascript"> </script>
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


<div class='accountCard' style="width: 700px; height: 790px;">
  
	<p style='color: black;text-align: center; padding-bottom: 0px;'>New Secret</p>
	<div><form onsubmit='generate_key()'>
	<input style='margin-left: 250px; margin-top: 20px; width: 200px;' type='submit' name='submit_button' value='Generate Keyfile'>

</form></div>
	<form action='/php/secrets/insert_secret.php' name='add_secret' onsubmit='return validate_form()' method='post' enctype='multipart/form-data' >
	
			  <div style='width: 400px;  margin-left: 50px; margin-top: 10px; float: left;'>
				<?php
					require('../crypto_settings.php');
					session_start();

					// make sure user is logged in
					login_check();
					

					echo " 
			
					<b>Label:</b><br>
					<input style='height: 35px; width: 600px;' type='text' name='label' maxlength='50' autofocus onfocus='this.value = this.value'>
					<b>Description:</b><br>
					<textarea name='description' style='width: 600px; height: 200px; margin-top: 5px;'  maxlength='255' ></textarea>
					<b>Value:</b><br>
					<textarea name='value' style='width: 600px; height: 200px; margin-top: 5px;'  maxlength='5000' ></textarea>
					<b>Password:</b><br>
					<input style='height: 35px; width: 600px;' type='password' name='secret_password' maxlength='200'>
					
					<div>Key File<br><input type='file' name='key_file' id='key_file'><br><label style='font-size: 12px;'>(.txt document 3072 characters max)</label></div>

					<input style='margin-left: 200px; margin-top: 20px; width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Add Secret'>
			  </div>
	</form>

		  
		
  </div> 
</body>
</html>";
