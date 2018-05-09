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

  
<header>Master Log Stats</header>


<!-- begining of general info card -->
<div class="login-card" style="height: 1230px;">
 
 

<?php

require('database_credentials.php');
session_start();

// make sure user is logged in
login_check();
master_log_check();

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

// varibles used to store the date range
$from = $_POST['from'];
$to = $_POST['to'];

echo "<p style='color: black;text-align: center;'>Please provide a date range</p>";
echo "<p style='color: black;text-align: center;'>The range provided will be used inclusively.</p>";

// search bar
echo "<div id='searchDiv'>
<form name='date_range' action='master_log_stats.php' method='post' id='searchForm' onsubmit='return validate_form()'>
  	From: <input type='date' value='$from' name='from' autofocus onfocus='this.value = this.value;'>
	To: <input type='date' value='$to' name='to'>
	<input type='submit' value='Generate Stats'>
</form>
</div>";


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


// start new database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



/***************************** begining of first table *****************************/
					
$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='dental' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$dental_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='dental' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$dental_total_billed =  $_SESSION['temp'];
if ($dental_total_billed == '') {
	$dental_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='dental' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$dental_total_paid = $_SESSION['temp'];
if ($dental_total_paid == '') {
	$dental_total_paid = 0;
}


$dental_total_owes =  ($dental_total_billed - $dental_total_paid);
$dental_total_billed =  $dental_total_billed;
$dental_total_paid =  $dental_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='inquiry' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$inquiry_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='inquiry' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$inquiry_total_billed =  $_SESSION['temp'];
if ($inquiry_total_billed == '') {
	$inquiry_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='inquiry' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$inquiry_total_paid = $_SESSION['temp'];
if ($inquiry_total_paid == '') {
	$inquiry_total_paid = 0;
}


$inquiry_total_owes =  ($inquiry_total_billed - $inquiry_total_paid);
$inquiry_total_billed =  $inquiry_total_billed;
$inquiry_total_paid =  $inquiry_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='laboratory' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$laboratory_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='laboratory' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$laboratory_total_billed =  $_SESSION['temp'];
if ($laboratory_total_billed == '') {
	$laboratory_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='laboratory' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$laboratory_total_paid = $_SESSION['temp'];
if ($laboratory_total_paid == '') {
	$laboratory_total_paid = 0;
}


$laboratory_total_owes =  ($laboratory_total_billed - $laboratory_total_paid);
$laboratory_total_billed =  $laboratory_total_billed;
$laboratory_total_paid =  $laboratory_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='mch_anc' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_anc_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='mch_anc' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_anc_total_billed =  $_SESSION['temp'];
if ($mch_anc_total_billed == '') {
	$mch_anc_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='mch_anc' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_anc_total_paid = $_SESSION['temp'];
if ($mch_anc_total_paid == '') {
	$mch_anc_total_paid = 0;
}


$mch_anc_total_owes =  ($mch_anc_total_billed - $mch_anc_total_paid);
$mch_anc_total_billed =  $mch_anc_total_billed;
$mch_anc_total_paid =  $mch_anc_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='mch_cwc' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_cwc_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='mch_cwc' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_cwc_total_billed =  $_SESSION['temp'];
if ($mch_cwc_total_billed == '') {
	$mch_cwc_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='mch_cwc' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_cwc_total_paid = $_SESSION['temp'];
if ($mch_cwc_total_paid == '') {
	$mch_cwc_total_paid = 0;
}


$mch_cwc_total_owes =  ($mch_cwc_total_billed - $mch_cwc_total_paid);
$mch_cwc_total_billed =  $mch_cwc_total_billed;
$mch_cwc_total_paid =  $mch_cwc_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='mch_delivery' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_delivery_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='mch_delivery' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_delivery_total_billed =  $_SESSION['temp'];
if ($mch_delivery_total_billed == '') {
	$mch_delivery_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='mch_delivery' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_delivery_total_paid = $_SESSION['temp'];
if ($mch_delivery_total_paid == '') {
	$mch_delivery_total_paid = 0;
}


$mch_delivery_total_owes =  ($mch_delivery_total_billed - $mch_delivery_total_paid);
$mch_delivery_total_billed =  $mch_delivery_total_billed;
$mch_delivery_total_paid =  $mch_delivery_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='mch_fp' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_fp_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='mch_fp' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_fp_total_billed =  $_SESSION['temp'];
if ($mch_fp_total_billed == '') {
	$mch_fp_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='mch_fp' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_fp_total_paid = $_SESSION['temp'];
if ($mch_fp_total_paid == '') {
	$mch_fp_total_paid = 0;
}


$mch_fp_total_owes =  ($mch_fp_total_billed - $mch_fp_total_paid);
$mch_fp_total_billed =  $mch_fp_total_billed;
$mch_fp_total_paid =  $mch_fp_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='optometry' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$optometry_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='optometry' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$optometry_total_billed =  $_SESSION['temp'];
if ($optometry_total_billed == '') {
	$optometry_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='optometry' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$optometry_total_paid = $_SESSION['temp'];
if ($optometry_total_paid == '') {
	$optometry_total_paid = 0;
}


$optometry_total_owes =  ($optometry_total_billed - $optometry_total_paid);
$optometry_total_billed =  $optometry_total_billed;
$optometry_total_paid =  $optometry_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='payment_rec' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$payment_rec_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='payment_rec' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$payment_rec_total_billed =  $_SESSION['temp'];
if ($payment_rec_total_billed == '') {
	$payment_rec_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='payment_rec' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$payment_rec_total_paid = $_SESSION['temp'];
if ($payment_rec_total_paid == '') {
	$payment_rec_total_paid = 0;
}


$payment_rec_total_owes =  ($payment_rec_total_billed - $payment_rec_total_paid);
$payment_rec_total_billed =  $payment_rec_total_billed;
$payment_rec_total_paid =  $payment_rec_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='pharmacy' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$pharmacy_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='pharmacy' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$pharmacy_total_billed =  $_SESSION['temp'];
if ($pharmacy_total_billed == '') {
	$pharmacy_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='pharmacy' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$pharmacy_total_paid = $_SESSION['temp'];
if ($pharmacy_total_paid == '') {
	$pharmacy_total_paid = 0;
}


$pharmacy_total_owes =  ($pharmacy_total_billed - $pharmacy_total_paid);
$pharmacy_total_billed =  $pharmacy_total_billed;
$pharmacy_total_paid =  $pharmacy_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='referral' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$referral_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='referral' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$referral_total_billed =  $_SESSION['temp'];
if ($referral_total_billed == '') {
	$referral_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='referral' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$referral_total_paid = $_SESSION['temp'];
if ($referral_total_paid == '') {
	$referral_total_paid = 0;
}


$referral_total_owes =  ($referral_total_billed - $referral_total_paid);
$referral_total_billed =  $referral_total_billed;
$referral_total_paid =  $referral_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='screening_dm' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_dm_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='screening_dm' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_dm_total_billed =  $_SESSION['temp'];
if ($screening_dm_total_billed == '') {
	$screening_dm_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='screening_dm' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_dm_total_paid = $_SESSION['temp'];
if ($screening_dm_total_paid == '') {
	$screening_dm_total_paid = 0;
}


$screening_dm_total_owes =  ($screening_dm_total_billed - $screening_dm_total_paid);
$screening_dm_total_billed =  $screening_dm_total_billed;
$screening_dm_total_paid =  $screening_dm_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='screening_gyn' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_gyn_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='screening_gyn' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_gyn_total_billed =  $_SESSION['temp'];
if ($screening_gyn_total_billed == '') {
	$screening_gyn_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='screening_gyn' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_gyn_total_paid = $_SESSION['temp'];
if ($screening_gyn_total_paid == '') {
	$screening_gyn_total_paid = 0;
}


$screening_gyn_total_owes =  ($screening_gyn_total_billed - $screening_gyn_total_paid);
$screening_gyn_total_billed =  $screening_gyn_total_billed;
$screening_gyn_total_paid =  $screening_gyn_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='screening_htn' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_htn_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='screening_htn' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_htn_total_billed =  $_SESSION['temp'];
if ($screening_htn_total_billed == '') {
	$screening_htn_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='screening_htn' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_htn_total_paid = $_SESSION['temp'];
if ($screening_htn_total_paid == '') {
	$screening_htn_total_paid = 0;
}


$screening_htn_total_owes =  ($screening_htn_total_billed - $screening_htn_total_paid);
$screening_htn_total_billed =  $screening_htn_total_billed;
$screening_htn_total_paid =  $screening_htn_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='screening_other' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_other_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='screening_other' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_other_total_billed =  $_SESSION['temp'];
if ($screening_other_total_billed == '') {
	$screening_other_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='screening_other' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_other_total_paid = $_SESSION['temp'];
if ($screening_other_total_paid == '') {
	$screening_other_total_paid = 0;
}


$screening_other_total_owes =  ($screening_other_total_billed - $screening_other_total_paid);
$screening_other_total_billed =  $screening_other_total_billed;
$screening_other_total_paid =  $screening_other_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='tb_injection' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$tb_injection_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='tb_injection' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$tb_injection_total_billed =  $_SESSION['temp'];
if ($tb_injection_total_billed == '') {
	$tb_injection_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='tb_injection' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$tb_injection_total_paid = $_SESSION['temp'];
if ($tb_injection_total_paid == '') {
	$tb_injection_total_paid = 0;
}


$tb_injection_total_owes =  ($tb_injection_total_billed - $tb_injection_total_paid);
$tb_injection_total_billed =  $tb_injection_total_billed;
$tb_injection_total_paid =  $tb_injection_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='treatment' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$treatment_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='treatment' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$treatment_total_billed =  $_SESSION['temp'];
if ($treatment_total_billed == '') {
	$treatment_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='treatment' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$treatment_total_paid = $_SESSION['temp'];
if ($treatment_total_paid == '') {
	$treatment_total_paid = 0;
}


$treatment_total_owes =  ($treatment_total_billed - $treatment_total_paid);
$treatment_total_billed =  $treatment_total_billed;
$treatment_total_paid =  $treatment_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='vct' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$vct_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='vct' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$vct_total_billed =  $_SESSION['temp'];
if ($vct_total_billed == '') {
	$vct_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='vct' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$vct_total_paid = $_SESSION['temp'];
if ($vct_total_paid == '') {
	$vct_total_paid = 0;
}


$vct_total_owes =  ($vct_total_billed - $vct_total_paid);
$vct_total_billed =  $vct_total_billed;
$vct_total_paid =  $vct_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='ultrasound' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$ultrasound_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='ultrasound' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$ultrasound_total_billed =  $_SESSION['temp'];
if ($ultrasound_total_billed == '') {
	$ultrasound_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='ultrasound' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$ultrasound_total_paid = $_SESSION['temp'];
if ($ultrasound_total_paid == '') {
	$ultrasound_total_paid = 0;
}


$ultrasound_total_owes =  ($ultrasound_total_billed - $ultrasound_total_paid);
$ultrasound_total_billed =  $ultrasound_total_billed;
$ultrasound_total_paid =  $ultrasound_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='general' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$general_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE department='general' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$general_total_billed =  $_SESSION['temp'];
if ($general_total_billed == '') {
	$general_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE department='general' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$general_total_paid = $_SESSION['temp'];
if ($general_total_paid == '') {
	$general_total_paid = 0;
}


$general_total_owes =  ($general_total_billed - $general_total_paid);
$general_total_billed =  $general_total_billed;
$general_total_paid =  $general_total_paid;




echo "<style>.stats{border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 22px;}</style>";

echo "<div style='margin-top: 80px;'>
	<table>
		<tr>
			<th>Department</th>
			<th>Encounters</th>
			<th>Total Billed</th>
			<th>Total Paid</th>
			<th>Total Owes</th>
		</tr>
		<tr>
			<td class='stats'>Dental</td>
			<td class='stats'>$dental_encounters</td>
			<td class='stats'>$dental_total_billed</td>
			<td class='stats'>$dental_total_paid</td>
			<td class='stats'>$dental_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Inquiry</td>
			<td class='stats'>$inquiry_encounters</td>
			<td class='stats'>$inquiry_total_billed</td>
			<td class='stats'>$inquiry_total_paid</td>
			<td class='stats'>$inquiry_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Laboratory</td>
			<td class='stats'>$laboratory_encounters</td>
			<td class='stats'>$laboratory_total_billed</td>
			<td class='stats'>$laboratory_total_paid</td>
			<td class='stats'>$laboratory_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>MCH/ANC</td>
			<td class='stats'>$mch_anc_encounters</td>
			<td class='stats'>$mch_anc_total_billed</td>
			<td class='stats'>$mch_anc_total_paid</td>
			<td class='stats'>$mch_anc_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>MCH/CWC</td>
			<td class='stats'>$mch_cwc_encounters</td>
			<td class='stats'>$mch_cwc_total_billed</td>
			<td class='stats'>$mch_cwc_total_paid</td>
			<td class='stats'>$mch_cwc_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>MCH/Delivery</td>
			<td class='stats'>$mch_delivery_encounters</td>
			<td class='stats'>$mch_delivery_total_billed</td>
			<td class='stats'>$mch_delivery_total_paid</td>
			<td class='stats'>$mch_delivery_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>MCH/FP</td>
			<td class='stats'>$mch_fp_encounters</td>
			<td class='stats'>$mch_fp_total_billed</td>
			<td class='stats'>$mch_fp_total_paid</td>
			<td class='stats'>$mch_fp_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Optometry</td>
			<td class='stats'>$optometry_encounters</td>
			<td class='stats'>$optometry_total_billed</td>
			<td class='stats'>$optometry_total_paid</td>
			<td class='stats'>$optometry_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Payment/Rec'd</td>
			<td class='stats'>$payment_rec_encounters</td>
			<td class='stats'>$payment_rec_total_billed</td>
			<td class='stats'>$payment_rec_total_paid</td>
			<td class='stats'>$payment_rec_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Pharmacy</td>
			<td class='stats'>$pharmacy_encounters</td>
			<td class='stats'>$pharmacy_total_billed</td>
			<td class='stats'>$pharmacy_total_paid</td>
			<td class='stats'>$pharmacy_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Referral</td>
			<td class='stats'>$referral_encounters</td>
			<td class='stats'>$referral_total_billed</td>
			<td class='stats'>$referral_total_paid</td>
			<td class='stats'>$referral_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Screening_DM</td>
			<td class='stats'>$screening_dm_encounters</td>
			<td class='stats'>$screening_dm_total_billed</td>
			<td class='stats'>$screening_dm_total_paid</td>
			<td class='stats'>$screening_dm_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Screening/GYN</td>
			<td class='stats'>$screening_gyn_encounters</td>
			<td class='stats'>$screening_gyn_total_billed</td>
			<td class='stats'>$screening_gyn_total_paid</td>
			<td class='stats'>$screening_gyn_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Screening/HTN</td>
			<td class='stats'>$screening_htn_encounters</td>
			<td class='stats'>$screening_htn_total_billed</td>
			<td class='stats'>$screening_htn_total_paid</td>
			<td class='stats'>$screening_htn_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Screening/OTHER</td>
			<td class='stats'>$screening_other_encounters</td>
			<td class='stats'>$screening_other_total_billed</td>
			<td class='stats'>$screening_other_total_paid</td>
			<td class='stats'>$screening_other_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>TB Injection</td>
			<td class='stats'>$tb_injection_encounters</td>
			<td class='stats'>$tb_injection_total_billed</td>
			<td class='stats'>$tb_injection_total_paid</td>
			<td class='stats'>$tb_injection_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Treatment</td>
			<td class='stats'>$treatment_encounters</td>
			<td class='stats'>$treatment_total_billed</td>
			<td class='stats'>$treatment_total_paid</td>
			<td class='stats'>$treatment_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>VCT</td>
			<td class='stats'>$vct_encounters</td>
			<td class='stats'>$vct_total_billed</td>
			<td class='stats'>$vct_total_paid</td>
			<td class='stats'>$vct_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Ultrasound</td>
			<td class='stats'>$ultrasound_encounters</td>
			<td class='stats'>$ultrasound_total_billed</td>
			<td class='stats'>$ultrasound_total_paid</td>
			<td class='stats'>$ultrasound_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>General</td>
			<td class='stats'>$general_encounters</td>
			<td class='stats'>$general_total_billed</td>
			<td class='stats'>$general_total_paid</td>
			<td class='stats'>$general_total_owes</td>
		</tr>
	</table>
</div>";



/***************************** begining of second table *****************************/


$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$total_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$total_total_billed =  $_SESSION['temp'];
if ($total_total_billed == '') {
	$total_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$total_total_paid = $_SESSION['temp'];
if ($total_total_paid == '') {
	$total_total_paid = 0;
}


$total_total_owes =  ($total_total_billed - $total_total_paid);
$total_total_billed =  $total_total_billed;
$total_total_paid =  $total_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE (department='mch_anc' or department='mch_cwc' or department='mch_delivery' or department='mch_fp') and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_total_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE (department='mch_anc' or department='mch_cwc' or department='mch_delivery' or department='mch_fp') and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_total_billed =  $_SESSION['temp'];
if ($mch_total_billed == '') {
	$mch_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE (department='mch_anc' or department='mch_cwc' or department='mch_delivery' or department='mch_fp') and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$mch_total_paid = $_SESSION['temp'];
if ($mch_total_paid == '') {
	$mch_total_paid = 0;
}


$mch_total_owes =  ($mch_total_billed - $mch_total_paid);
$mch_total_billed =  $mch_total_billed;
$mch_total_paid =  $mch_total_paid;




$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE (department='screening_dm' or department='screening_gyn' or department='screening_htn' or department='screening_other') and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_total_encounters = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT SUM(billed) FROM master_log WHERE (department='screening_dm' or department='screening_gyn' or department='screening_htn' or department='screening_other') and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_total_billed =  $_SESSION['temp'];
if ($screening_total_billed == '') {
	$screening_total_billed = 0;
}


$stmt = $conn->prepare("SELECT SUM(paid) FROM master_log WHERE (department='screening_dm' or department='screening_gyn' or department='screening_htn' or department='screening_other') and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$screening_total_paid = $_SESSION['temp'];
if ($screening_total_paid == '') {
	$screening_total_paid = 0;
}


$screening_total_owes =  ($screening_total_billed - $screening_total_paid);
$screening_total_billed =  $screening_total_billed;
$screening_total_paid =  $screening_total_paid;



$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE revisit='yes' and timestamp between $from and $to;");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$revisit_encounters = $_SESSION['temp'];



echo "<div style='margin-top: 50px;'>
	<table>
		<tr>
			<td class='stats'>Total</td>
			<td class='stats'>$total_encounters</td>
			<td class='stats'>$total_total_billed</td>
			<td class='stats'>$total_total_paid</td>
			<td class='stats'>$total_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>MCH Total</td>
			<td class='stats'>$mch_total_encounters</td>
			<td class='stats'>$mch_total_billed</td>
			<td class='stats'>$mch_total_paid</td>
			<td class='stats'>$mch_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Screening Total</td>
			<td class='stats'>$screening_total_encounters</td>
			<td class='stats'>$screening_total_billed</td>
			<td class='stats'>$screening_total_paid</td>
			<td class='stats'>$screening_total_owes</td>
		</tr>
		<tr>
			<td class='stats'>Revisits</td>
			<td class='stats'>$revisit_encounters</td>
		</tr>
	</table>
</div>";

?>

</div>