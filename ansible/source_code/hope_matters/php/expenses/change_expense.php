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
		  
		  <div style="float: left;  width: 250px;">
        <form method="post" action="/php/expenses/select_expense.php">
            <input style="width: 250px;" type="submit" value="Select Expense">
        </form>
      </div>
		  
	  </div>
	  <br></br>


<div class='accountCard' style="width: 500px; height: 500px;">
  
	<p style='color: black;text-align: center;'>Change Expense</p>
	
	<form action='/php/expenses/update_expense.php' name='add_item' onsubmit='return validate_form()' method='post'>
	
			  <div style='width: 400px;  margin-left: 50px; margin-top: 10px; float: left;'>
				<b>Name:</b><br>
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

					$expense_id = $_SESSION['choosen_expense_id'];
					
				
					// make database connection
					$conn = new PDO($dbconnection, $dbusername, $dbpassword);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


					$stmt = $conn->prepare("SELECT name FROM expenses WHERE expense_id='$expense_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$name = $_SESSION['temp'];
					
					
					$stmt = $conn->prepare("SELECT amount FROM expenses WHERE expense_id='$expense_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$amount = $_SESSION['temp'];
					
					
					$stmt = $conn->prepare("SELECT tag FROM expenses WHERE expense_id='$expense_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$tag = $_SESSION['temp'];
				
				
					$stmt = $conn->prepare("SELECT notes FROM expenses WHERE expense_id='$expense_id';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$notes = $_SESSION['temp'];
				
				
				
					echo "<input style='height: 35px;' type='text' name='name' value='$name' maxlength='45' autofocus onfocus='this.value = this.value;'>
					
					<b>Amount (shillings):</b><br>
					<input style='height: 35px;' name='amount' type='number' value='$amount'>
					<b>Tag:</b><br>
					<input style='height: 35px;' type='text' name='tag' placeholder='(Optional)' value='$tag'>
					<b>Notes:</b><br>
					<textarea name='notes' style='width: 400px; height: 100px; margin-top: 5px;'  maxlength='255'>$notes</textarea>";
				?>
				<input style='margin-left: 100px; margin-top: 20px; width: 200px;' type='submit' name='submit_button' class='submitbtn' value='Update Expense'>
			  </div>
		  </form>
		  
		
  </div> 
</body>
</html>
