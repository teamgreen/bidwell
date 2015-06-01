
		<div id="add-account" title="Add a new account">
			<form action="admin.php" method="post" id="add-form">
				<fieldset>
					<label for="add_username">Username</label>
					<input type="text" name="add_username" id="add_username" class="text ui-widget-content ui-corner-all">
					<label for="add_email">Email</label>
					<input type="email" name="add_email" id="add_email" class="text ui-widget-content ui-corner-all">
					<label for="company">Company</label>
					<input type="text" name="company" id="company" value="<?php echo $admin_company; ?>" class="text ui-widget-content ui-corner-all" disabled="true">
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
					<div id="permissions">
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
					<label for="add_password">Password</label>
					<input type="password" name="add_password" id="add_password" class="text ui-widget-content ui-corner-all">
					<label for="add_confirm_password">Confirm Password</label>
					<input type="password" name="add_confirm_password" id="add_confirm_password" class="text ui-widget-content ui-corner-all">
				</fieldset>
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

						$sql_add = "INSERT INTO `account` (LoginName, Email, PresetName, Password)
									VALUES ('$username', '$email', $preset, '$password')";
						$result_add = @mysqli_query($dbc, $sql_add);

						$num_rows_add = @mysqli_num_rows($result_add);
						if ($num_rows_add === 0) {
						 	echo "<p>We apologize for the inconvenience but a new account could not be added.</p>\n";
						};

						$_POST = array(); // should clear all fields

					} else {

						$username = $_POST['add_username'];
						$email = $_POST['add_email'];
						$preset = $_POST['add_preset'];

						if (is_array($_POST['add_permission'])) {
							foreach ($_POST['add_permission'] as $value) {
								$sql_permission = "INSERT INTO `account|permission` (PermissionID) VALUES ('$value'"; // do I need WHERE account = ?
								$result_permission = @mysqli_query($dbc, $sql_permission);

								$num_rows_permission = @mysqli_num_rows($result_permission);
								if ($num_rows_permission === 0) {
								 	echo "<p>We apologize for the inconvenience but a permission was not added.</p>\n";
								};
							};
						} else {
							$permissions = $_POST['add_permission'];
						};

						$password = $_POST['add_password'];

						$sql_add = "INSERT INTO `account` (LoginName, Email, PresetName, Password)
									VALUES ('$username', '$email', $preset, '$password')";
						$result_add = @mysqli_query($dbc, $sql_add);

						$num_rows_add = @mysqli_num_rows($result_add);
						if ($num_rows_add === 0) {
						 	echo "<p>We apologize for the inconvenience but a new account could not be added.</p>\n";
						};

						$_POST = array(); // should clear all fields

					};

					?>

					<script type="text/javascript">
						newURL = document.location.href;

						<?php header("Location: " . $newURL); ?>
					</script>
					<?php

				};

			?>
		</div>

		<div id="edit-account" title="Edit an account">
			<form action="admin.php" method="post" id="edit-form">
				<fieldset>
					<?php

						if (isset($_GET['id'])) {
							$_SESSION['id'] = $_GET['id'];
						};	

						$sql_edit = "SELECT * FROM `account` INNER JOIN `company` ON account.CompanyID = company.CompanyID WHERE account.AccountID = '{$_SESSION['id']}'";
						$result_edit = @mysqli_query($dbc, $sql_edit);

						$num_rows_edit = @mysqli_num_rows($result_edit);
						if ($num_rows_edit > 0) {
							while($row_edit = @mysqli_fetch_array($result_edit)) {
								$username = $row_edit['LoginName'];
								$email = $row_edit['Email'];
								$company = $row_edit['CompanyName'];
							};
						};

					?>
					<label for="edit_username">Username</label>
					<input type="text" name="edit_username" id="edit_username" value="<?php echo $username; ?>" class="text ui-widget-content ui-corner-all">
					<label for="edit_email">Email</label>
					<input type="email" name="edit_email" id="edit_email" value="<?php echo $email; ?>" class="text ui-widget-content ui-corner-all">
					<label for="company">Company</label>
					<input type="text" name="company" id="company" value="<?php echo $company; ?>" class="text ui-widget-content ui-corner-all" disabled="true">
					<div>
						<label>Preset
							<input type="checkbox" name="edit_preset" id="edit_preset" value="<?php echo $preset; ?>" class="text ui-widget-content ui-corner-all">
						</label>
					</div>
				</fieldset>
			</form>
			<?php

				# If the above form has been submitted,
				# this PHP code will run and all the form
				# values will be sent to the database.

				if($_SERVER['REQUEST_METHOD'] === 'POST') {

					$username = $_POST['edit_username'];
					$email = $_POST['edit_email'];
					$preset = $_POST['edit_preset'];
					$password = $_POST['edit_password'];

					$sql_add = "UPDATE `account` (LoginName, Email, PresetName, Password)
								VALUES ('$username', '$email', $preset, '$password')";
					$result_edit = @mysqli_query($dbc, $sql_edit);

					$num_rows_edit = @mysqli_num_rows($result_edit);
					if ($num_rows_edit === 0) {
					 	echo "<p>We apologize for the inconvenience but the account was not changed.</p>\n";
					};

					$_POST = array(); // should clear all fields

					?>

					<script type="text/javascript">
						newURL = document.location.href;

						<?php header("Location: " . $newURL); ?>
					</script>
					<?php

				};

			?>
		</div>

		<div id="edit-pass" title="Reset Password">
			<form action="admin.php" method="post" id="pass-form">
				<fieldset>
					<?php
							
						$pass_id = $_GET['id'];	

						$sql_pass = "SELECT Password FROM `account` WHERE AccountID = '$pass_id'";
						$result_pass = @mysqli_query($dbc, $sql_pass);
						if ($num_rows_pass > 0) {
							while($row_pass = @mysqli_fetch_array($result_pass)) {
								$old_pass = $row_pass['Password'];
							};
						};

					?>
					<label for="new_password">Password</label>
					<input type="password" name="new_password" id="new_password" value="<?php echo $old_pass; ?>" class="text ui-widget-content ui-corner-all">
					<label for="new_confirm_password">Confirm Password</label>
					<input type="password" name="new_confirm_password" id="new_confirm_password" value="<?php echo $old_pass; ?>" class="text ui-widget-content ui-corner-all">
				</fieldset>
			</form>
			<?php

				# If the above form has been submitted,
				# this PHP code will run and all the form
				# values will be sent to the database.

				if($_SERVER['REQUEST_METHOD'] === 'POST') {

					$password = $_POST['new_password'];

					$sql_newpass = "UPDATE `account` (Password)
								VALUES ('$password')
								WHERE AccountID = '$pass_id'";
					$result_enewpass = @mysqli_query($dbc, $sql_enewpass);

					$num_rows_enewpass = @mysqli_num_rows($result_enewpass);
					if ($num_rows_enewpass === 0) {
					 	echo "<p>We apologize for the inconvenience but the account was not changed.</p>\n";
					};

					$_POST = array(); // should clear all fields

					?>

					<script type="text/javascript">
						newURL = document.location.href;

						<?php header("Location: " . $newURL); ?>
					</script>
					<?php

				};

			?>
		</div>
		
		<div id="add-success" title="Success">
			<p>You successfully created a new account!</p>
		</div>

		<div id="edit-success" title="Success">
			<p>You successfully edited the account!</p>
		</div>

		<div id="pass-success" title="Success">
			<p>You successfully reset your password!</p>
		</div>