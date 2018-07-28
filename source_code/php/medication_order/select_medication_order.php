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

  
<header>Pick a Medication Order</header>


<!-- begining of general info card -->
<div class="login-card">
  

<?php

require('../database_credentials.php');
session_start();

// make sure user is logged in
login_check();

$_SESSION['temp'] = 0;
$_SESSION['choosen_medication_order_id'] = 0;

$choosen_client_id = $_SESSION['choosen_client_id'];

// grab current search and date of birth date

$date_of_birth = $_POST['date_of_birth'];

class view_clients extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
	// this function creates an invisible <a link> that passes the referral form id to the next page
    function current() {
	
		$_SESSION['choosen_medication_order_id'] = parent::current();
		
		// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 6 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_medication_order_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_medication_order_id.php? choosen_medication_order_id=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


try {
	
	// make the database connection
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   

	echo "<p style='text-align: center;'>Click on a Medication Order.</p>";
	
	
	$order_type = $_POST['order_type'];
	
	
	if ($order_type == "no") {
		echo "<div >
		<form action='select_medication_order.php' method='post' id='searchForm'>
	  		<p style='text-align: center;'>Open orders: <input type='radio' name='order_type' value='yes' > yes <input type='radio' name='order_type' value='no' checked> no</p>
			<div style='margin-left: 470px;'><input  type='submit' id='search_submit' value='Refresh'></div>
		</form>
		</div>";

	}
	else {
		echo "<div >
			<form action='select_medication_order.php' method='post' id='searchForm'>
		  		<p style='text-align: center;'>Open orders: <input type='radio' name='order_type' value='yes' checked> yes <input type='radio' name='order_type' value='no'> no</p>
				<div style='margin-left: 470px;'><input  type='submit' id='search_submit' value='Refresh'></div>
			</form>
			</div>";
		$order_type = "yes";
		

	}
	
	

    echo "<div id='tableCard'>";
	
	
	/******** determine if the user is searching by id, first name, or last name ********/
	
	// if the client is searching by id
	
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Form ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>Age</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT medication_order_id, first_name, last_name, sex, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')), date_format(timestamp, '%b %d %Y %h:%i %p') FROM medication_order WHERE open = '$order_type' and client_id = '$choosen_client_id' ORDER BY medication_order_id DESC");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	
	

	echo "</table>";
    echo "</div>";

}


catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

?>

</div>
