<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

session_start(); 

echo $_SESSION['choosen_child_welfare_care'] =  $_GET['choosen_child_welfare_care'];

header('Location: change_child_welfare_care.php');
exit();