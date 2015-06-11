<?php
	# this PHP code will run and all the form
	# values will be sent to the database.

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['password'])) {
			$password = $_POST['password'];

			// get a dbc connection.
			require_once '../includes/mysqli_connect.inc.php';
			$dbc = SQLConnect();

			$sql_newpass = "UPDATE `account`
						SET Password = PASSWORD('$password')
						WHERE AccountID=" . $_POST['accountid'];
			
			//var_dump($sql_newpass);
			//var_dump($dbc);

			if (mysqli_query($dbc, $sql_newpass) === FALSE) {
			 	//echo "<p>We apologize for the inconvenience but the password was not changed.</p>\n";
			 	echo "ERROR";
			}
			else {
				echo "SUCCESS";
			}

			// clean up because that's what good people do.
			mysqli_close($dbc);
		};
	};
?>
		