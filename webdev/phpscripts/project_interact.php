<?php
@include_once '../includes/debugging-helper-functions.inc.php';

session_start();
// varDump(__FILE__ . " " . __LINE__, '$_POST', $_POST);
 	if($_POST['action'])
 	{
 		if(isset($_SESSION['loginname']))
 			echo $_SESSION['loginname'];
// 		switch ($_POST['action']){
// 			case 'newline':
// 				var_dump($GLOBALS['project']);
// 				$GLOBALS['project']->addNewLineToSheet();
// 			break;
// 		}
 	}
?>