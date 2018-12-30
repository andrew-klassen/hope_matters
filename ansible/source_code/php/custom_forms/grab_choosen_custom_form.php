<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

session_start(); 

$_SESSION['choosen_form'] =  $_GET['choosen_form'];
$_SESSION['client_linked'] = 'false';

header('Location: select_add_or_change.php');
exit();
