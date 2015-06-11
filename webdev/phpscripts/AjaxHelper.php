<?php
@include_once '../includes/debugging-helper-functions.inc.php';

session_start();
//varDump(__FILE__ . " " . __LINE__, '$_SESSION', $_SESSION);

	// get the session variable, if it exists and return it.
	if(isset($_POST['getSessionVariable'])){
 		//if the sessionVariable is set, send that back to the js as data.
 		if(isset($_SESSION[$_POST['getSessionVariable']]))
 			echo $_SESSION[$_POST['getSessionVariable']];
 		else
 			echo NULL;
 	}
 	// set the session variable.
 	else if (isset($_POST['setSessionVariable'])){
 			$_SESSION[$_POST['setSessionVariable']] = $_POST['value'];
 	}
 	// unset a session variable.
 	else if(isset($_POST['unsetSessionVariable'])){
 		unset($_SESSION[$_POST['unsetSessionVariable']]);
 	}
 	// create a new sheet in the database.  Return the id.
 	else if (isset($_POST['createSheet'])){
 		// need the database.
		require_once '../includes/mysqli_connect.inc.php';
		$dbc = SQLConnect();

 		// create the sql
		$sql = "INSERT INTO `sheet` (`SheetType`) VALUES ('".$_POST['createSheet']."')";//$_POST['createSheet']

		// update the database
		if (@mysqli_query($dbc, $sql)===TRUE){
			$id = mysqli_insert_id($dbc);
			$sql = "UPDATE `sheet`
				SET `Name`='".$_POST['createSheet'].$id."' WHERE `SheetID`=".$id;

			@mysqli_query($dbc, $sql);

			// link the new sheet to the project.
			$sql = "INSERT INTO `project|sheet` (ProjectID, SheetID)
				VALUES ('".$_SESSION['projectid']."', '".$id."')";
			@mysqli_query($dbc, $sql);

			// echo out the sheet ID so we can use it.
			echo $id;

		}
		else
			echo "ERROR2";
		
		//clean up after ourselves.
		mysqli_close($dbc);
 	}
 	else
 		echo "ERROR";
?>
