<?php

/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen

*/

session_start();


function make_json_readable($json_string) {

	

	$pad = false;
	$padding = 0;
	$dont_skip = true;
	$regex = '~"[^"]*"(*SKIP)(*F)|\s+~';
	
	$json_string = preg_replace($regex, "", $json_string);
	$json_string = str_replace("\r", '', $json_string);
	$json_string = str_replace("\n", '', $json_string);
	$json_string = str_replace("\t", '', $json_string);

	for ($i = 0; $i < strlen($json_string); ++$i){



		


		if ($dont_skip) {
			if ($pad && $i != '}') {
				$json_string = substr($json_string, 0, $i) . str_repeat(' ', $padding) . substr($json_string, ($i), strlen($json_string));
				$pad = false;
				
				
			}
			
		
			switch ($json_string[$i]) {
				case '{':
					$json_string = substr($json_string, 0, $i) . "{\r" . substr($json_string, ($i + 1), strlen($json_string));
					$padding += 8;
					$i += 1;
					$pad = true;
					break;

				case '}':
					$padding -= 8;
					
					$json_string = substr($json_string, 0, $i) . "\r" .  str_repeat(' ', $padding) . "}" . substr($json_string, ($i + 1), strlen($json_string));
					
					
					//$pad = true;
					
					
					$i += (1 + $padding);

				

					break;

				case '[':
					$json_string = substr($json_string, 0, $i) . "[\r" . substr($json_string, ($i + 1), strlen($json_string));
					$padding += 8;
					$i += 1;
					$pad = true;
					break;

				case ']':
					$padding -= 8;
					
					$json_string = substr($json_string, 0, $i) . "\r" .  str_repeat(' ', $padding) . "]" . substr($json_string, ($i + 1), strlen($json_string));
					
					
					
					//$pad = true;
					
					
					$i += (1 + $padding);

				

					break;


				case ',':
					$json_string = substr($json_string, 0, $i) . ",\r" . substr($json_string, ($i + 1), strlen($json_string));
					$pad = true;
					$i += 1;
					break;

				case ':':
					$json_string = substr($json_string, 0, $i) . " : " . substr($json_string, ($i + 1), strlen($json_string));
					
					$i += 2;
					
					break;

				
			
			}

			

		}


		if ($json_string[$i] == "\"") {
			$dont_skip = ! $dont_skip;

		}

    		
	}
	

	

	return $json_string;
}













/*


	
$form_body = preg_replace($regex, "", $current_json_form);
$form_body = str_replace("\r", '', $form_body);
$form_body = str_replace("\n", '', $form_body);
$form_body = str_replace("\t", '', $form_body);



$start = strpos($form_body,"\"body\":{")+8;
$end = strlen($form_body) - 2;
$form_body = substr($form_body, $start, $end - $start);
$form_body = str_replace("\"", '', $form_body);

echo $form_body . '<br>';


$key_array = array();
$value_array = array();
$start_index = 0;


for ($i = 0; $i < strlen($form_body); ++$i) {	
	if ($form_body[$i] == ':') {

		

		if ( substr($form_body, $start_index, $i - $start_index) == 'radio_button_group') {
			
			++$start_index;
			$radio_string = substr($form_body, $start_index, strlen($form_body)- $start_index);
			echo $radio_string = substr($radio_string, 0, strpos($radio_string, ']'));
			$radio_start_index = 0;
			//exit();
			$key_array_max = count($key_array) ;
			$value_array_max = count($value_array) ;
			$key_array[$key_array_max] = array();
			$value_array[$value_array_max] = array();
			
			for ($j = 0; $j < strlen($radio_string); ++$j) {
				if ($radio_string[$j] == ':') {

					array_push($key_array[$key_array_max], substr($radio_string, $radio_start_index, $j - $radio_start_index));
					
					$radio_start_index = $j + 1;	
					

				}
				else if ($radio_string[$j] == ',') {
					
					array_push($value_array[$value_array_max], substr($radio_string, $radio_start_index, $j - $radio_start_index));
					
					$radio_start_index = $j + 1;
					
				}
				else if ($radio_string[$j] == '[') {
					$value_array[$value_array_max][1] = array();
					echo '<br>' . substr($radio_string, $j + 1, strlen($radio_string) - $j) . '<br>';

					$value_array[$value_array_max][1] = explode(',', substr($radio_string, $j + 1, strlen($radio_string) - $j));
					$i += strlen($radio_string);
					break;

				}
			}
		}
		else {
			array_push($key_array, substr($form_body, $start_index, $i - $start_index));
			$start_index = $i + 1;	
		
		}



		

	}
	else if ($form_body[$i] == ',') {
		
		array_push($value_array, substr($form_body, $start_index, $i - $start_index));
		$start_index = $i + 1;
		
		
		
	}
	
}

echo "<pre>";
print_r($key_array);
echo "</pre>";

echo "<pre>";
print_r($value_array);
echo "</pre>";





*/

