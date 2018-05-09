<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<head>
	<title>Hope Matters</title>
	<link rel="icon" href="/images/hope_matters_logo.png">
	<link rel="stylesheet" type="text/css" href="/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/css/view_client.css">
	<script src="/js/master_log_stats_validation.js" type="text/javascript"></script>
</head>


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
	  
</div>
<br></br>

  
<header>Diagnosis Totals</header>


<!-- begining of general info card -->
<div class="login-card" style="height: 1540px;">
 
 

<?php

require('database_credentials.php');
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

// used to display list of diagnosis_types in the database 
class display_diagnoses extends RecursiveIteratorIterator {
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

class view_clients extends RecursiveIteratorIterator {
    
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			
			// this function creates an invisible <a link> that passes the clients id to the next page
			function current() {
			
				
				return "<td align='center' style='border-style: solid; border-color: #black; background-color: white; color: black; font-size: 30px;  '>" . "<a style='color: black; font-size: 20px; text-decoration: none; opacity: 1;'>"  . parent::current() . "</a>" . "</td>";
		  
			}
			function beginChildren() {
				echo "<tr>";
			}
			function endChildren() {
				echo "</tr>" . "\n";
			}
}


// varibles used to store the date range
$from = $_POST['from'];
$to = $_POST['to'];
$diagnosis = $_POST['diagnosis'];


// start new database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// below is the diagnosis textbox and date range
echo "<div id='searchDiv'>
<form name='date_range' action='diagnosis_totals.php' method='post' id='searchForm' onsubmit='return validate_form()'>
	<label style='margin-left: 100px;'>Diagnosis:</label><input list='diagnosis_list' name='diagnosis' value='$diagnosis' maxlength='45'> <br><br>
	<datalist id='diagnosis_list'>";
															
		$stmt = $conn->prepare("SELECT diagnosis_type FROM diagnosis_types;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new display_diagnoses(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			echo $v;
		}
														
echo "</datalist>
 
	<p style='color: black;text-align: center;'>Please provide a date range</p>
	<p style='color: black;text-align: center;'>The range provided will be used inclusively.</p>
 
 
	From: <input type='date' value='$from' name='from' autofocus onfocus='this.value = this.value;'>
	To: <input type='date' value='$to' name='to'>
	<input type='submit' value='Generate Stats'>
</form>";



/*******************************************************************
Code below allows the user to omit a date in the date range. If no 
date range is provided, then all records are acceptible.
*******************************************************************/	
if ($from == '') {
	$from = '0000-00-00';
}else {
	$from = "'" . $from . "'";
}
if ($to == '') {
	$to = 'NOW()';
}
else {
	// mysql uses the ending date in the range exclusively, so one day is added to the date
	// provided by the user to compensate
	$to = date('Y-m-d',strtotime($to . "+1 days"));
	$to = "'" . $to . "'";
}


// grab total amount of the selected diagnosis
$stmt = $conn->prepare("SELECT COUNT(*) FROM diagnoses WHERE diagnosis='$diagnosis' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$diagnosis_total = $_SESSION['temp'];


// display the total
echo "<br><br>
	<p style='color: black;text-align: center;'>Total Times Diagnosed: $diagnosis_total</p>
	<br>
	<p style='color: black;text-align: center;'>Below is a list of all the diagnosis counts that fall upon the date range. <br>If the diagnosis is not listed, then its count is 0.</p>
</div>";


// special styling for the diagnosis totals table
echo "<style>
			
			.height_weight_table{
				width:100%;
				table-layout: fixed;
				border-collapse: collapse;
				border: 2px solid #fff;
			}
			.height_weight_labels{
				padding: 20px 8px;
				text-align: center;
				font-weight: 500;
				font-size: 12px;
				font-size: 30px;
				color: #fff;
				border-style: solid;
				border-color: #black;
				background-color: white;
				color: black;
			}
			
	 </style>";
		
			echo "<div style='width: 330px; height: 1200px; overflow: auto; margin-left: 340px; margin-top: 350px;'>";
	
				echo "<table style='border: none;' class='height_weight_table'>";
				echo "<tr><th class='height_weight_labels'>Diagnosis</th><th class='height_weight_labels'>Count</th></tr>";
				
				// get the client by id
				$stmt = $conn->prepare("SELECT diagnosis, COUNT(diagnosis) FROM diagnoses WHERE timestamp between $from and $to GROUP BY diagnosis;");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				$_SESSION['counter'] = 0;
				foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				   echo $v;
				   ++$_SESSION['counter'];
				}
				
			
			echo "</table>";
			echo "</div>";

?>

</div>