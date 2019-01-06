/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

function validate_form() {

	var child_particulars = document.forms["child_welfare_care"]["child_particulars"].value;
	
	if (child_particulars == ""){

		alert("You need to provide the child particulars date.");
		return false;

	}
	
	var child_name = document.forms["child_welfare_care"]["child_name"].value;
	var child_gender = document.forms["child_welfare_care"]["child_gender"].value;
	var child_date_of_birth = document.forms["child_welfare_care"]["child_date_of_birth"].value;
	
	if (child_date_of_birth == ""){

		alert("You need to provide the child\'s date of birth.");
		return false;

	}
	
	var first_seen = document.forms["child_welfare_care"]["first_seen"].value;
	
	if (first_seen == ""){

		alert("You need to provide the first seen date.");
		return false;

	}
	
	var birth_place = document.forms["child_welfare_care"]["birth_place"].value;
	

	/*********** child particulars validation ***********/

    // make sure date is in the correct format
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

    if (!regex_date.test(child_particulars))
    {	
		alert("Please enter the child particulars in the following format. \n\n yyyy-mm-dd");
        return false;
    }

    // break up each part of the date
    var parts   = child_particulars.split("-");
    var day     = parseInt(parts[2], 10);
    var month   = parseInt(parts[1], 10);
    var year    = parseInt(parts[0], 10);

    // make sure user provides a valid year
    if (year < 1800 || year > 2500) 
    {
		alert("The year given for the child particulars is invalid.");
        return false;
    }
	
	// make sure user provides a valid month
	if (month == 0 || month > 12) {
		alert("The month given for the child particulars is invalid.");
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
		alert("The day given for the child particulars is invalid.");
        return false;
	}
	
	/***********************************************/
	
	
	if (child_name == "") {
		alert("You forgot to provide the child's name.");
		return false;
	}
	
	if (child_gender == "") {
		alert("You forgot to provide the child's gender.");
		return false;
	}
	
	if (child_date_of_birth == "") {
		alert("You forgot to provide the child's date of birth.");
		return false;
	}
	
	/*********** first seen validation ***********/

    // make sure date is in the correct format
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

    if (!regex_date.test(first_seen))
    {	
		alert("Please enter the first seen date in the following format. \n\n yyyy-mm-dd");
        return false;
    }

    // break up each part of the date
    var parts   = first_seen.split("-");
    var day     = parseInt(parts[2], 10);
    var month   = parseInt(parts[1], 10);
    var year    = parseInt(parts[0], 10);

    // make sure user provides a valid year
    if (year < 1800 || year > 2500) 
    {
		alert("The year given for first seen is invalid.");
        return false;
    }
	
	// make sure user provides a valid month
	if (month == 0 || month > 12) {
		alert("The month given for first seen is invalid.");
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
		alert("The day given for first seen is invalid.");
        return false;
	}
	
	/***********************************************/
	
	if (birth_place == "") {
		alert("You forgot to provide the birth place of the child.");
		return false;
	}
	
	
	/*********** first seen validation ***********/

    // make sure date is in the correct format
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

    if (!regex_date.test(notification_date))
    {	
		alert("Please enter the birth notification date in the following format. \n\n yyyy-mm-dd");
        return false;
    }

    // break up each part of the date
    var parts   = notification_date.split("-");
    var day     = parseInt(parts[2], 10);
    var month   = parseInt(parts[1], 10);
    var year    = parseInt(parts[0], 10);

    // make sure user provides a valid year
    if (year < 1800 || year > 2500) 
    {
		alert("The year given for birth notification is invalid.");
        return false;
    }
	
	// make sure user provides a valid month
	if (month == 0 || month > 12) {
		alert("The month given for birth notification is invalid.");
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
		alert("The day given for birth notification is invalid.");
        return false;
	}
	
	/***********************************************/
	
	
}

function growth_validation() {

	var child_growth_weight = document.forms["growth"]["child_growth_weight"].value;
	var child_growth_weight_percentile = document.forms["growth"]["child_growth_weight_percentile"].value;
	var child_growth_height = document.forms["growth"]["child_growth_height"].value;
	var child_growth_height_percentile = document.forms["growth"]["child_growth_height_percentile"].value;

	
	if (child_growth_weight == "") {
		alert("You forgot to provide the weight.");
		return false;
	}
	
	if (child_growth_weight_percentile == "") {
		alert("You forgot to provide the weight percentile.");
		return false;
	}
	
	if (child_growth_height == "") {
		alert("You forgot to provide the height.");
		return false;
	}
	
	if (child_growth_height_percentile == "") {
		alert("You forgot to provide the height percentile.");
		return false;
	}

}