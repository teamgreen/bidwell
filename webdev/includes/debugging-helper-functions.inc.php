<?php
////////////////////////////////////
// debugging-helper-functions.inc.php
// This file is for holding functionality to make debugging easier/faster
// Frank van der Salm
// 5/27/2015
////////////////////////////////////

///////////////////////////////////
// varDump - calls var_dump on a variable, but wraps it
// in paragraph tags and gives it a message before
// $a_functionName - name of function calling this.  Be smart, use __FUNCTION__
// $a_varName - name of the variable
// a_var - variable to dump
/////////////////////////////////// 
function varDump($a_functionName, $a_varName, $a_var)
{
	echo "<p>{$a_functionName}: var_dump of $a_varName<br>";
	var_dump($a_var);
	echo "</p>";
}

///////////////////////////////////
// varValue - displays value of a variable, but wraps it
// in paragraph tags and gives it a message before
// $a_functionName - name of function calling this.  Be smart, use __FUNCTION__
// $a_varName - name of the variable.
// a_var - variable to dump
/////////////////////////////////// 
function varValue($a_functionName, $a_varName, $a_var)
{
	echo "<p>{$a_functionName}:";
	echo "Value of $a_varName is $a_var";
	echo "</p>";
}

?>