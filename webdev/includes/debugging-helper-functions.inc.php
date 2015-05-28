<?php
////////////////////////////////////
// debugging-helper-functions.inc.php
// This file is for holding functionality to make debugging easier/faster
// Frank van der Salm
// 5/27/2015
////////////////////////////////////

///////////////////////////////////
// VarDump - calls var_dump on a variable, but wraps it
// in paragraph tags and gives it a message before
// $a_functionName - name of function calling this.
// $a_headerMsg - message to display prior to dump
// a_var - variable to dump
/////////////////////////////////// 
function varDump($a_functionName, $a_headerMsg, $a_var)
{
	echo "<p>{$a_functionName}: var_dump of $a_headerMsg<br>";
	var_dump($a_var);
	echo "</p>";
}

?>