<?php


function query_format($string) {

	$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

	$string = str_replace($search, $replace, $string);

        return $string;

}

$test = "asdf\"df'sdfd'sdf";
echo query_format($test);
