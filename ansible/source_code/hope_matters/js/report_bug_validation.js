/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

function validate_form() {

	var severity_level = document.forms["report_bug"]["severity_level"].value;
	var location = document.forms["report_bug"]["location"].value;
	var description = document.forms["report_bug"]["description"].value;
	

	if (severity_level == "") {
		alert("You need to specify how severe the bug is.");
		return false;
	}
	
	if (location == "") {
		alert("You need to provide the location of the bug.");
		return false;
	}
	
	if (description == "") {
		alert("Please provide a description of the bug.");
		return false;
	}
	
}