
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
				<input type="button" id="add-submit" value="Submit">
				<input type="button" id="add-cancel" value="Cancel">
			</div>
		</form>
	</div>
	<div id="reset-dialog">
		<form action="admin.php" method="post" id="pass-form">
			<p>Reset Password</p>
			<hr>
			<div>
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all">
			</div>
			<div>
				<label for="confirm_password">Confirm Password</label>
				<input type="password" name="confirm_password" id="confirm_password" class="text ui-widget-content ui-corner-all">
			</div>
			<div class="submit-button">
				<input type="button" id="reset-submit" data-accountid="0" form="pass-form" value="Submit">
				<input type="button" id="reset-cancel" value="Cancel">
			</div>
		</form>
	</div>
	<div id="delete-dialog">
		<form action="admin.php" method="post" id="delete-form">
			<p>Delete Account</p>
			<hr>
			<div>
				<p class="delete-warning">Are you sure you want to delete this account? This action cannot be undone.</p>
			</div>
			<div class="submit-button">
				<input type="submit" id="delete-submit" form="delete-form" value="Submit">
				<input type="button" id="delete-cancel" value="Cancel">
			</div>
		</form>
		<?php

			# If the above form has been submitted,
			# this PHP code will run and all the form
			# values will be sent to the database.

			if($_SERVER['REQUEST_METHOD'] === 'POST') {

				if (isset($_POST['accountid'])) {
					$delete_id = $_POST['accountid'];
				};

				$sql_delete = "DELETE FROM `account` WHERE AccountID = '$delete_id' LIMIT 1";

				$result_delete = @mysqli_query($dbc, $sql_delete);

				$num_rows_delete = @mysqli_num_rows($result_delete);
				if ($num_rows_delete === 0) {
				 	echo "<p>We apologize for the inconvenience but this account has not been deleted.</p>\n";
				};

				$_POST = array(); // should clear all fields

				header('location:admin.php');
			};
		?>
	</div>