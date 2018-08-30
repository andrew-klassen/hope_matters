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
        <form method="post" action="/php/inventory/select_item.php">
            <input style="width: 200px;" type="submit" value="Select Item">
        </form>
      </div>
		  
	  </div>
	  <br></br>


<div class='accountCard' style="width: 500px; height: 500px;">
  
	<p style='color: black;text-align: center;'>Change Item</p>
	
	<form action='/php/inventory/update_item.php' name='add_item' onsubmit='return validate_form()' method='post'>
	
			  <div style='width: 400px;  margin-left: 50px; margin-top: 10px; float: left;'>
				<b>Item Name:</b><br>
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

					$inventory_id = $_SESSION['choosen_item_id'];
				
				
				
					// make database connection
					$conn = new PDO($dbconnection, $dbusername, $dbpassword);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


					$stmt = $conn->prepare("SELECT name FROM inventory WHERE inventory_id='$inventory_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$name = $_SESSION['temp'];
					
					
					$stmt = $conn->prepare("SELECT type FROM inventory WHERE inventory_id='$inventory_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$type = $_SESSION['temp'];
					
					
					$stmt = $conn->prepare("SELECT count FROM inventory WHERE inventory_id='$inventory_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$count = $_SESSION['temp'];
					
					
					$stmt = $conn->prepare("SELECT value FROM inventory WHERE inventory_id='$inventory_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$value = $_SESSION['temp'];
				
				
					$stmt = $conn->prepare("SELECT notes FROM inventory WHERE inventory_id='$inventory_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$notes = $_SESSION['temp'];
				
				
					// select current department on drop down menu
					switch ($type){
						case 'supplies':
							$supplies_selected = 'selected=\'selected\'';
							break;
						case 'medicine':
							$medicine_selected = 'selected=\'selected\'';
							break;
						case 'equipment':
							$equipment_selected = 'selected=\'selected\'';
							break;
					}
				
				
					echo "<input style='height: 35px;' type='text' name='name' value='$name' maxlength='45' autofocus onfocus='this.value = this.value;'>
					<div style='margin-top: 10px;'><b>Item Type:</b>
						<select name='type' method='post'>
								<option value='supplies' $supplies_selected>Supplies</option>
								<option value='medicine' $medicine_selected>Medicine</option>
								<option value='equipment' $equipment_selected>Equipment</option>
						</select>
					</div><br>
					<b>Count:</b><br>
					<input style='height: 35px;' name='count' type='number' value='$count'>
					<b>Value:</b><br>
					<input style='height: 35px;' type='number' name='value' value='$value'>
					<b>Notes:</b><br>
					<textarea name='notes' style='width: 400px; height: 100px; margin-top: 5px;'  maxlength='255'>$notes</textarea>";
				?>
				<input style='margin-left: 100px; margin-top: 20px; width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Update Item'>
			  </div>
		  </form>
		  
		
  </div> 
</body>
</html>
