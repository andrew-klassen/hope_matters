/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

function validate_form() {


	/*********** from validation ***********/
	
	var from = document.forms["date_range"]["from"].value;
	
	// only if user attemped to provide a date
	if (from != "") {
	
		// make sure date is in the correct format
		var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

		if (!regex_date.test(from))
		{	
			alert("Please enter the \"From\" date in the following format. \n\n yyyy-mm-dd");
			return false;
		}

		// break up each part of the date
		var parts   = from.split("-");
		var day     = parseInt(parts[2], 10);
		var month   = parseInt(parts[1], 10);
		var year    = parseInt(parts[0], 10);

		// make sure user provides a valid year
		if (year < 1800 || year > 2500) 
		{
			alert("The year given for the \"From\" date is invalid.");
			return false;
		}
		
		// make sure user provides a valid month
		if (month == 0 || month > 12) {
			alert("The month given for the \"From\" date is invalid.");
			return false;
		}
		

		var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

		// adjust for leap years
		if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
		{
			monthLength[1] = 29;
		}

		// make sure user provides a valid day
		if (!(day > 0 && day <= monthLength[month - 1])){
			alert("The day given for the \"From\" date is invalid.");
			return false;
		}
	}
	
	
	/*********** to validation ***********/
	
	var to = document.forms["date_range"]["to"].value;
	
	// only if user attemped to provide a date
	if (to != "") {
	
		// make sure date is in the correct format
		var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

		if (!regex_date.test(to))
		{	
			alert("Please enter the \"To\" date in the following format. \n\n yyyy-mm-dd");
			return false;
		}

		// break up each part of the date
		var parts   = to.split("-");
		var day     = parseInt(parts[2], 10);
		var month   = parseInt(parts[1], 10);
		var year    = parseInt(parts[0], 10);

		// make sure user provides a valid year
		if (year < 1800 || year > 2500) 
		{
			alert("The year given for the \"To\" date is invalid.");
			return false;
		}
		
		// make sure user provides a valid month
		if (month == 0 || month > 12) {
			alert("The month given for the \"To\" date is invalid.");
			return false;
		}
		

		var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

		// adjust for leap years
		if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
		{
			monthLength[1] = 29;
		}

		// make sure user provides a valid day
		if (!(day > 0 && day <= monthLength[month - 1])){
			alert("The day given for the \"To\" date is invalid.");
			return false;
		}
	}

}