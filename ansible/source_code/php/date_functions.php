<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

session_start();

// function returns age of client based on date of birth
function get_age_from_date_of_birth($date_of_birth) {
	
	// makes the given birth date formatible
	$date_of_birth_year = DateTime::createFromFormat('Y-m-d', $date_of_birth);
	
	// get date of birth, assuming client hasn't had their birth day this year
	$age = date('Y') - $date_of_birth_year->format('Y') - 1;
	
	// if client's birth day was in a previous month, add one to age
	if ($date_of_birth_year->format('m') < date('m')){
		++$age;
	}
	
	// if client's birth day is in current month, then compare dates
	elseif ($date_of_birth_year->format('m') == date('m')) {
		if ($date_of_birth_year->format('d') <= date('d')){
			++$age;
		}
	}
	
	return $age;
	
}

// function returns true if current year is leap year
function is_leap_year($year) {
	return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year % 400) == 0)));
}