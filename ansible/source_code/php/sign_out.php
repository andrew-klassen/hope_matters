<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

session_start();

// wipe the login info for security reasons
$_SESSION['account_id'] = '';
$_SESSION['username'] = '';
$_SESSION['master_log_access'] = '';

// redirect user to home page
header("Location: ../index.html");
exit();