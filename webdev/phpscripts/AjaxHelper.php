<?php
@include_once '../includes/debugging-helper-functions.inc.php';

session_start();
//varDump(__FILE__ . " " . __LINE__, '$_SESSION', $_SESSION);

	if($_POST['getSessionVariable']){
 		//if the sessionVariable is set, send that back to the js as data.
 		if(isset($_SESSION[$_POST['getSessionVariable']]))
 			echo $_SESSION[$_POST['getSessionVariable']];
 		else
 			echo NULL;
 	}
 	else if ($_POST['setSessionVariable']){
 			$_SESSION[$_POST['setSessionVariable']] = $_POST['value'];
 	}

?>