<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

session_start(); 

$_SESSION['choosen_discharge_form_id'] =  $_GET['choosen_discharge_form_id'];

header('Location: change_discharge_form.php');
exit();