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

  
<header>&nbsp;&nbsp;Expenses</header>


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
	
		$_SESSION['choosen_expense_id'] = parent::current();
		
		// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 5 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_expense_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_expense.php? choosen_expense_id=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
    
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


echo "<p style='color: black;text-align: center;'>Seach for expense by name or ID. Use * to see all items. Click on an expense to view/change it.</p>";

echo "<div style='margin-left: 460px;'><form action='/html/add_expense.html' method='post' >
		<input type='submit' value='Add Expense'>
	  </form></div>";

$search = $_POST['search'];
$from = $_POST['from'];
$to = $_POST['to'];



// search bar
echo "<div id='searchDiv' >
	<form action='select_expense.php' method='post' id='searchForm'>
		From: <input type='date' value='$from' name='from' >
		To: <input type='date' value='$to' name='to'><br>
		<div style='margin-top: 10px;'>
			<input style='margin-left: 95px;' type='text' id='request_search' name='search' value='$search' autofocus onfocus='this.value = this.value;'>
			<input type='submit' id='search_submit' value='Search' autofocus onfocus='this.value = this.value;'>
		</div>
	</form>
</div>";


/*******************************************************************
Code below allows the user to omit a date in the date range. If no 
date range is provided, then all records are acceptible.
*******************************************************************/	
if ($from == '') {
	$from = "'0000-00-00 00:00:00'";
}else {
	$from = "'" . $from . " 00:00:00'";
}
if ($to == '') {
	$to = "CONCAT(CURDATE(), ' 23:59:59')";
}
else {
	$to = "'" . $to . " 23:59:59'";
}



// start new database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


echo "<div id='tableCard'>";
	
	/******** determine if the user is searching by id, first name, or last name ********/
	
	// if searching by id
	if (ctype_digit($search)) {
		 
		$stmt = $conn->prepare("SELECT amount FROM expenses WHERE expense_id='$search' AND timestamp between $from and $to;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$total = $_SESSION['temp'];
		
		echo "<div style='margin-bottom: 5px;'><b>Total: </b>" . $total . '</div>';
		
		
		echo "<table style='border: none;'>";
		echo "<tr><th>Expense ID</th><th>Expense</th><th>Tag</th><th>Amount</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT expense_id, name, tag, amount, date_format(timestamp, '%b %d %Y %h:%i %p') FROM expenses WHERE expense_id='$search' AND timestamp between $from and $to;");
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
	
		$stmt = $conn->prepare("SELECT SUM(amount) FROM expenses WHERE timestamp between $from and $to ORDER BY expense_id DESC;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$total = $_SESSION['temp'];
		
		echo "<div style='margin-bottom: 5px;'><b>Total: </b>" . $total . '</div>';
		
		
		echo "<table style='border: none;'>";
		echo "<tr><th>Expense ID</th><th>Expense</th><th>Tag</th><th>Amount</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT expense_id, name, tag, amount, date_format(timestamp, '%b %d %Y %h:%i %p') FROM expenses WHERE timestamp between $from and $to ORDER BY expense_id DESC LIMIT $wild_card_limit;");
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
		
		$stmt = $conn->prepare("SELECT SUM(amount) FROM expenses  WHERE name LIKE '%$search%' AND timestamp between $from and $to ORDER BY CASE WHEN name LIKE '%$search%' THEN 1 ELSE 2 END, expense_id desc LIMIT $search_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$total = $_SESSION['temp'];
		
		echo "<div style='margin-bottom: 5px;'><b>Total: </b>" . $total . '</div>';
	
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Expense ID</th><th>Expense</th><th>Tag</th><th>Amount</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT expense_id, name, tag, amount, date_format(timestamp, '%b %d %Y %h:%i %p') FROM expenses  WHERE name LIKE '%$search%' AND timestamp between $from and $to ORDER BY CASE WHEN name LIKE '%$search%' THEN 1 ELSE 2 END, expense_id desc LIMIT $search_limit;");
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