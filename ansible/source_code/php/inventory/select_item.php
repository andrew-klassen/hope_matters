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

  
<header>Inventory</header>


<!-- begining of general info card -->
<div class="login-card">
 
 

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

class view_clients extends RecursiveIteratorIterator {
    
	function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
	// this function creates an invisible <a link> that passes the clients id to the next page
    function current() {
	
		$_SESSION['choosen_item_id'] = parent::current();
		
		// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 6 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_item_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_item.php? choosen_item_id=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
    
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


echo "<p style='color: black;text-align: center;'>Seach for item by name or ID. Use * to see all items. Click on an item to view/change it.</p>";

echo "<div style='margin-left: 370px; height: 40px;'>

<div style='float: left;'><form action='/html/create_item.html' method='post' >
		<input type='submit' value='Create Item'>
	  </form></div>

<div style='float: left; margin-left: 5px;'><form action='/html/add_item.html' method='post' >
		<input type='submit' value='Add Item'>
	  </form></div>

<div style='float: left; margin-left: 5px;'><form action='/html/remove_item.html' method='post' >
		<input type='submit' value='Remove Item'>
	  </form></div>

</div>";

$search = $_POST['search'];
$item_type = $_POST['item_type'];


// the switch statment below is used to filter items according to the selected item type 
switch ($item_type) {
	case supplies: 
		$supplies_check = 'checked';
		$query_item_type = "AND type='$item_type'";
		$query_item_type_wild = "WHERE type='$item_type'";
		break;
	case medicine: 
		$medicine_check = 'checked';
		$query_item_type = "AND type='$item_type'";
		$query_item_type_wild = "WHERE type='$item_type'";
		break;
	case equipment: 
		$equipment_check = 'checked';
		$query_item_type = "AND type='$item_type'";
		$query_item_type_wild = "WHERE type='$item_type'";
		break;
	default:
		$all_check = 'checked';
		$query_item_type = '';
		$query_item_type_wild = '';
}

// search bar
echo "<div id='searchDiv'>
	<form action='select_item.php' method='post' id='searchForm'>
		Item Types: <input type='radio' id='all' name='item_type' value='all' $all_check/>All
		<input type='radio' id='supplies' name='item_type' value='supplies' $supplies_check/>Supplies
		<input type='radio' id='medicine' name='item_type' value='medicine' $medicine_check/>Medicine
		<input type='radio' id='equipment' name='item_type' value='equipment' $equipment_check/>Equipment <br><br>
		<input style='margin-left: 90px; ' type='text' id='request_search' name='search' value='$search' autofocus onfocus='this.value = this.value;'>
		<input type='submit' id='search_submit' value='Search'>
	</form>
</div>";


// start new database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "<div id='tableCard'>";
	
	
	/******** determine if the user is searching by id, first name, or last name ********/
	
	// if searching by id
	if (ctype_digit($search)) {
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Item ID</th><th>Item</th><th>Type</th><th>Count</th><th>Value</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT inventory_id, name, type, count, value, date_format(timestamp, '%b %d %Y %h:%i %p') FROM inventory WHERE inventory_id='$search' $query_item_type;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
	}
	
	// if using a wild card
	elseif ($search == '*') {
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Item ID</th><th>Item</th><th>Type</th><th>Count</th><th>Value</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT inventory_id, name, type, count, value, date_format(timestamp, '%b %d %Y %h:%i %p') FROM inventory $query_item_type_wild ORDER BY inventory_id DESC LIMIT $wild_card_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
   
    }
	
	// if searching by name
	elseif ($search) {
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Item ID</th><th>Item</th><th>Type</th><th>Count</th><th>Value</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT inventory_id, name, type, count, value, date_format(timestamp, '%b %d %Y %h:%i %p') FROM inventory  WHERE name LIKE '%$search%' $query_item_type ORDER BY CASE WHEN name LIKE '$search' THEN 1 ELSE 2 END, inventory_id desc LIMIT $search_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
   
    }

	echo "</table>";
    echo "</div>";

?>

</div>
