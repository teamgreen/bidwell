
	<div id="add-reset_bg"></div>
	<div id="add-dialog">
		<form action="admin.php" method="post" id="add-form">
			<p>Add New Account</p>
			<hr>
			<div class="form-half">
				<div>
					<label for="add_username">Username</label>
					<input type="text" name="add_username" id="add_username" class="ui-widget-content ui-corner-all">
				</div>
				<div>
					<label for="add_email">Email</label>
					<input type="email" name="add_email" id="add_email" class="ui-widget-content ui-corner-all">
				</div>
			</div>
			<div class="form-half">
				<div>
					<label for="add_password">Password</label>
					<input type="password" name="add_password" id="add_password" class="ui-widget-content ui-corner-all">
				</div>
				<div>
					<label for="add_confirm_password">Confirm Password</label>
					<input type="password" name="add_confirm_password" id="add_confirm_password" class="ui-widget-content ui-corner-all">
				</div>
				<div>
					<label for="add_preset">Preset</label>
					<select name="add_preset" id="add_preset">
						<option value="">--Select a Preset--</option>
						<option value="Admin">Admin</option>
						<option value="BidPreparer">Bid Preparer</option>
						<option value="BidSupervisor">Bid Supervisor</option>
						<option value="Executive">Executive</option>
						<option value="Guest">Guest</option>
						<option value="LoanOfficer">Loan Officer</option>
						<option value="SuperUser">Super User</option>
						<option value="Custom">Custom</option>
					</select>
				</div>
			</div>
			<div>
				<div id="permissions">
					<div class="form-half">
						<label>Create Own Projects
							<input type="checkbox" name="add_permission" value="1">
						</label>
						<label>View Internal Sheets
							<input type="checkbox" name="add_permission" value="2">
						</label>
						<label>View External Sheets
							<input type="checkbox" name="add_permission" value="4">
						</label>
						<label>View Any Project
							<input type="checkbox" name="add_permission" value="8">
						</label>
						<label>Edit Any Project
							<input type="checkbox" name="add_permission" value="16">
						</label>
						<label>Delete Own Projects
							<input type="checkbox" name="add_permission" value="32">
						</label>
						<label>Delete Any Project
							<input type="checkbox" name="add_permission" value="64">
						</label>
						<label>Approve Own Projects
							<input type="checkbox" name="add_permission" value="128">
						</label>
						<label>Approve Any Project
							<input type="checkbox" name="add_permission" value="256">
						</label>
						<label>Assign Own Projects
							<input type="checkbox" name="add_permission" value="512">
						</label>
					</div>
					<div class="form-half">
						<label>Assign Any Project
							<input type="checkbox" name="add_permission" value="1024">
						</label>
						<label>Transfer Own Projects
							<input type="checkbox" name="add_permission" value="2048">
						</label>
						<label>Transfer Any Project
							<input type="checkbox" name="add_permission" value="4096">
						</label>
						<label>See Internal Comments
							<input type="checkbox" name="add_permission" value="8192">
						</label>
						<label>See External Comments
							<input type="checkbox" name="add_permission" value="16384">
						</label>
						<label>Make Internal Comments
							<input type="checkbox" name="add_permission" value="32768">
						</label>
						<label>Make External Comments
							<input type="checkbox" name="add_permission" value="65536">
						</label>
						<label>Manage non-Admin, non-Greenwell, non-Temp Accounts
							<input type="checkbox" name="add_permission" value="262144">
						</label>
						<label>Manage Temp Accounts
							<input type="checkbox" name="add_permission" value="524288">
						</label>
					</div>
				</div>
			</div>
			<div class="submit-button">
				<input type="submit" id="add-submit" form="add-form" value="Submit">
				<input type="button" id="add-cancel" value="Cancel">
			</div>
		</form>
		<?php

			# If the above form has been submitted,
			# this PHP code will run and all the form
			# values will be sent to the database.

			if($_SERVER['REQUEST_METHOD'] === 'POST') {

				if($_POST['add_preset'] !== 'Custom') {

					$username = $_POST['add_username'];
					$email = $_POST['add_email'];
					$preset = $_POST['add_preset'];
					$password = $_POST['add_password'];
					$passdate = date('Y-m-d');

					$sql_add = "INSERT INTO `account` (LoginName, Email, PresetName, Password, PasswordDate)
								VALUES ('$username', '$email', '$preset', '$password', '$passdate')";
					$result_add = @mysqli_query($dbc, $sql_add);

					$num_rows_add = @mysqli_num_rows($result_add);
					if ($num_rows_add == 0) {
					 	echo "<p>We apologize for the inconvenience but a new account could not be added.</p>\n";
					};

					$_POST = array(); // should clear all fields

				} else {

					$username = $_POST['add_username'];
					$email = $_POST['add_email'];
					$preset = $_POST['add_preset'];
					$password = $_POST['add_password'];
					$passdate = date('Y-m-d');

					$sql_add = "INSERT INTO `account` (LoginName, Email, PresetName, Password, PasswordDate)
								VALUES ('$username', '$email', '$preset', '$password', '$passdate')";
					$result_add = @mysqli_query($dbc, $sql_add);

					$num_rows_add = @mysqli_num_rows($result_add);
					if ($num_rows_add == 0) {
					 	echo "<p>We apologize for the inconvenience but a new account could not be added.</p>\n";
					};

					$sql_p_id = "SELECT AccountID FROM `account` WHERE LoginName = '$username'";
					$result_p_id = @mysqli_query($dbc, $sql_p_id);

					$num_rows_p_id = @mysqli_num_rows($result_p_id);
					if ($num_rows_p_id == 0) {
					 	echo "<p>We apologize for the inconvenience but the account ID could not be retrieved</p>\n";
					};

					while($row_p_id = @mysqli_fetch_array($result_p_id)) {
						$p_id = $row_p_id['AccountID'];
					};

					if (is_array($_POST['add_permission'])) {
						foreach ($_POST['add_permission'] as $value) {
							$sql_permission = "INSERT INTO `account|permission` (PermissionID) VALUES ('$value') WHERE AccountID = '$p_id'";
							$result_permission = @mysqli_query($dbc, $sql_permission);

							$num_rows_permission = @mysqli_num_rows($result_permission);
							if ($num_rows_permission == 0) {
							 	echo "<p>We apologize for the inconvenience but a permission was not added.</p>\n";
							};
						};
					} else {
						$permissions = $_POST['add_permission'];

						$sql_permission = "INSERT INTO `account|permission` (PermissionID) VALUES ('$permissions') WHERE AccountID = '$p_id'";
						$result_permission = @mysqli_query($dbc, $sql_permission);

						$num_rows_permission = @mysqli_num_rows($result_permission);
						if ($num_rows_permission == 0) {
						 	echo "<p>We apologize for the inconvenience but a permission was not added.</p>\n";
						};
					};

					$_POST = array(); // should clear all fields

					header('location:admin.php');
					exit;

				};

			};

		?>
	</div>
	<div id="reset-dialog">
		<?php
			
			if (isset($_GET['accountid'])) {
				$pass_id = $_GET['accountid'];
				$sql_pass = "SELECT Password FROM `account` WHERE AccountID = '$pass_id'";
				$result_pass = @mysqli_query($dbc, $sql_pass);
				$row_pass = @mysqli_fetch_assoc($result_pass);
				$old_pass = $row_pass['Password'];
			};

			var_dump($_GET);
			exit;
		

			print_r('<pre>$_GET:');
			print_r($_GET);
			print_r('</pre>');

		?>
		<form action="admin.php" method="post" id="pass-form">
			<p>Reset Password</p>
			<hr>
			<div>
				<label for="new_password">Password</label>
				<input type="password" name="new_password" id="new_password" value="<?php echo $old_pass; ?>" class="text ui-widget-content ui-corner-all">
			</div>
			<div>
				<label for="new_confirm_password">Confirm Password</label>
				<input type="password" name="new_confirm_password" id="new_confirm_password" value="<?php echo $old_pass; ?>" class="text ui-widget-content ui-corner-all">
			</div>
			<div class="submit-button">
				<input type="submit" id="reset-submit" form="pass-form" value="Submit">
				<input type="button" id="reset-cancel" value="Cancel">
			</div>
		</form>
		<?php

			# If the above form has been submitted,
			# this PHP code will run and all the form
			# values will be sent to the database.

			if($_SERVER['REQUEST_METHOD'] === 'POST') {

				$password = $_POST['new_password'];

				$sql_newpass = "UPDATE `account`
							SET Password = '$password'
							WHERE AccountID = '$pass_id'";
				$result_newpass = @mysqli_query($dbc, $sql_newpass);

				$num_rows_newpass = @mysqli_num_rows($result_newpass);
				if ($num_rows_newpass === 0) {
				 	echo "<p>We apologize for the inconvenience but the password was not changed.</p>\n";
				};

				$_POST = array(); // should clear all fields

				header('location:admin.php');
				exit;

			};

		?>
	</div>
	<div id="delete-dialog">
		<form action="admin.php" method="post" id="delete-form">
			<p>Delete Account</p>
			<hr>
			<div>
				<p>Are you sure you want to delete this account? This action cannot be undone.</p>
			</div>
			<div class="submit-button">
				<input type="submit" id="delete-submit" form="delete-form" value="Submit">
				<input type="button" id="delete-cancel" value="Cancel">
			</div>
		</form>
		<?php

			if (isset($_GET['id'])) {
				$delete_id = $_GET['id'];
			};

			# If the above form has been submitted,
			# this PHP code will run and all the form
			# values will be sent to the database.

			if($_SERVER['REQUEST_METHOD'] === 'POST') {

				$sql_delete = "DELETE FROM `account` WHERE AccountID = '$delete_id' LIMIT 1";

				$result_delete = @mysqli_query($dbc, $sql_delete);

				$num_rows_delete = @mysqli_num_rows($result_delete);
				if ($num_rows_delete === 0) {
				 	echo "<p>We apologize for the inconvenience but this account has not been deleted.</p>\n";
				};

				$_POST = array(); // should clear all fields

				header('location:admin.php');
				exit;
				
			};

		?>
	</div>