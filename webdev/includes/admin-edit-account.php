	
		<form action="admin.php" method="post" id="edit-form">
			<p>Edit Account</p>
			<hr>
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
			<div class="form-half">
				<label for="edit_username">Username</label>
				<input type="text" name="edit_username" id="edit_username" value="<?php echo $username; ?>" class="text ui-widget-content ui-corner-all">
				<label for="edit_email">Email</label>
				<input type="email" name="edit_email" id="edit_email" value="<?php echo $email; ?>" class="text ui-widget-content ui-corner-all">
			</div>
			<div class="form-half">
				<label for="company">Company</label>
				<input type="text" name="company" id="company" value="<?php echo $company; ?>" class="text ui-widget-content ui-corner-all" disabled="true">
				<div>
					<label for="edit_preset">Preset</label>
					<select name="edit_preset" id="edit_preset">
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
				<div id="edit_permissions">
					<div class="form-half">
						<label>Create Own Projects
							<input type="checkbox" name="edit_permission" value="1">
						</label>
						<label>View Internal Sheets
							<input type="checkbox" name="edit_permission" value="2">
						</label>
						<label>View External Sheets
							<input type="checkbox" name="edit_permission" value="4">
						</label>
						<label>View Any Project
							<input type="checkbox" name="edit_permission" value="8">
						</label>
						<label>Edit Any Project
							<input type="checkbox" name="edit_permission" value="16">
						</label>
						<label>Delete Own Projects
							<input type="checkbox" name="edit_permission" value="32">
						</label>
						<label>Delete Any Project
							<input type="checkbox" name="edit_permission" value="64">
						</label>
						<label>Approve Own Projects
							<input type="checkbox" name="edit_permission" value="128">
						</label>
						<label>Approve Any Project
							<input type="checkbox" name="edit_permission" value="256">
						</label>
						<label>Assign Own Projects
							<input type="checkbox" name="edit_permission" value="512">
						</label>
					</div>
					<div class="form-half">
						<label>Assign Any Project
							<input type="checkbox" name="edit_permission" value="1024">
						</label>
						<label>Transfer Own Projects
							<input type="checkbox" name="edit_permission" value="2048">
						</label>
						<label>Transfer Any Project
							<input type="checkbox" name="edit_permission" value="4096">
						</label>
						<label>See Internal Comments
							<input type="checkbox" name="edit_permission" value="8192">
						</label>
						<label>See External Comments
							<input type="checkbox" name="edit_permission" value="16384">
						</label>
						<label>Make Internal Comments
							<input type="checkbox" name="edit_permission" value="32768">
						</label>
						<label>Make External Comments
							<input type="checkbox" name="edit_permission" value="65536">
						</label>
						<label>Manage non-Admin, non-Greenwell, non-Temp Accounts
							<input type="checkbox" name="edit_permission" value="262144">
						</label>
						<label>Manage Temp Accounts
							<input type="checkbox" name="edit_permission" value="524288">
						</label>
					</div>
				</div>
			</div>
			<div class="submit-button">
				<input type="submit" id="edit-submit" form="edit-form" value="Submit">
			</div>
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