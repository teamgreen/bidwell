<?php
session_start();
# If the above form has been submitted,
# this PHP code will run and all the form
# values will be sent to the database.

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// get a dbc connection.
	require_once '../includes/mysqli_connect.inc.php';
	$dbc = SQLConnect();

	// handle the account table.
	$username = $_POST['add_username'];
	$email = $_POST['add_email'];
	$preset = $_POST['add_preset'];
	$password = $_POST['add_password'];
	$passdate = date('Y-m-d');
	$companyid = $_SESSION['companyid'];

	$sql_add = "INSERT INTO `account` (LoginName, Email, PresetName, Password, PasswordDate, CompanyID)
				VALUES ('$username', '$email', '$preset', PASSWORD('$password'), '$passdate', '$companyid')";

	if(@mysqli_query($dbc, $sql_add)===FALSE) {
		mysqli_close($dbc);
		exit("ERROR0");
	}

	if($preset !== 'Custom') {
		mysqli_close($dbc);
		exit("SUCCESS");
	}else { // we have more to do

		// get the primary key of the entry we just added.
		$p_id = mysqli_insert_id($dbc);

		if (is_array($_POST['add_permission'])) {
			foreach ($_POST['add_permission'] as $value) {
				$sql_permission = "INSERT INTO `account|permission` (PermissionID) VALUES ('$value') WHERE AccountID = '$p_id'";
				
				if (mysqli_query($dbc, $sql_permission) === FALSE) {
					mysqli_close($dbc);
				 	exit("ERROR1");
				}
			}
		} else {
			$permissions = $_POST['add_permission'];

			$sql_permission = "INSERT INTO `account|permission` (PermissionID) VALUES ('$permissions') WHERE AccountID = '$p_id'";

			if (@mysqli_query($dbc, $sql_permission) === FALSE) {
				mysqli_close($dbc);
			 	exit("ERROR2");
			};
		};
		echo "SUCCESS";
	};

	// clean up because that's what good people do.
	mysqli_close($dbc);
};
?>