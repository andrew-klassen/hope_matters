<?php

require('database_credentials.php');
include ('Net/SSH2.php');

echo "<script src='/js/storage_error_conformation.js' type='text/javascript'> </script>";

echo "<p style='color: red;font-size: 30px;'>Something is wrong with the server's storage</p>";
echo "Please review the storage report below. If a hard drive has failed act on it <b>immediately</b>.<br>";
echo '*****************************************************************************';

echo '</br>' . '</br>';

echo 'Drive #' . str_repeat('&nbsp;', 20) .'Status' . '<br>' .
	 '-----------------------------------------' . '<br>';

// make the ssh connection to the host OS
$ssh_connection = new Net_SSH2(SERVER_WITH_STORAGE_ARRAY);
if (!$ssh_connection->login(USERNAME, PASSWORD)) {
	exit('Login Failed');
}


// get status information pertaining to drive 1
$hard_drive_1 = $ssh_connection->exec('/opt/MegaRAID/storcli/storcli64 /c0 show all | grep ^64:0');
if (substr($hard_drive_1, 12, 4) == 'Onln') {
	$hard_drive_1 = '1: '. str_repeat('&nbsp;', 28) . substr($hard_drive_1, 12, 5) . '<br>';
}
else {
	$hard_drive_1 = '1: '. str_repeat('&nbsp;', 28) . "<lable style='color: red;'>" .substr($hard_drive_1, 12, 5) . '</lable>' . '<br>';
}


// get status information pertaining to drive 2
$hard_drive_2 = $ssh_connection->exec('/opt/MegaRAID/storcli/storcli64 /c0 show all | grep ^64:1');
if (substr($hard_drive_2, 12, 4) == 'Onln') {
	$hard_drive_2 = '2: '. str_repeat('&nbsp;', 28) . substr($hard_drive_2, 12, 5) . '<br>';
}
else {
	$hard_drive_2 = '2: '. str_repeat('&nbsp;', 28) . "<lable style='color: red;'>" .substr($hard_drive_2, 12, 5) . '</lable>' . '<br>';
}


// get status information pertaining to drive 1
$hard_drive_3 = $ssh_connection->exec('/opt/MegaRAID/storcli/storcli64 /c0 show all | grep ^64:2');
if (substr($hard_drive_3, 12, 4) == 'Onln') {
	$hard_drive_3 = '3: '. str_repeat('&nbsp;', 28) . substr($hard_drive_3, 12, 5) . '<br>';
}
else {
	$hard_drive_3 = '3: '. str_repeat('&nbsp;', 28) . "<lable style='color: red;'>" .substr($hard_drive_3, 12, 5) . '</lable>' . '<br>';
}


// display each hard drive's status
echo $hard_drive_1;
echo $hard_drive_2;
echo $hard_drive_3;

echo '<br><br>';

echo 'Status Codes' . '<br>' .
	 '-----------------------' . '<br>';
	 
echo 'DHS-Dedicated Hot Spare' . '<br>' .
	 'UGood-Unconfigured Good' . '<br>' .
	 'GHS-Global Hotspare' . '<br>' .
	 'UBad-Unconfigured Bad' . '<br>' .
	 'Onln-Online' . '<br>' .
	 'Rbld-drive is being rebuilt' . '<br>' .
	 'Offln-Offline' . '<br>' .
	 '&lt;no status&gt;-drive does not exist or is not plugged in' . '<br>' . '<br>' . '<br>';
	 
	 
echo 'Configuration Details' . '<br>' .
	 '----------------------------------' . '<br>' .
	 'RAID Controller: LSI 9240-8i' . '<br>' .
	 'Drive 1: WD2005FBYZ-01YCBB1' . '<br>' .
	 'Drive 2: WD2005FBYZ-01YCBB1' . '<br>' .
	 'Drive 3: WD2005FBYZ-01YCBB1' . '<br>' . '<br>';
	 
echo '*****************************************************************************' . '<br>' .
	 "<form  action='dashboard.php' onsubmit='confirm_storage_error()'>
		<input type='submit' value='Go to Dashboard'>
	  </form>";