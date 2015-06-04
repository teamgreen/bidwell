
		<form action="admin.php" method="post" id="pass-form">
			<p>Reset Password</p>
			<hr>
			<?php
				
				var_dump($_GET['id']);
				var_dump($dbc);

				if(isset($_GET['id'])) {
					$pass_id = $_GET['id'];	
				} else {
					echo "ERROR";
				}	

				$sql_pass = "SELECT Password FROM `account` WHERE AccountID = '$pass_id'";
				$result_pass = @mysqli_query($dbc, $sql_pass);
				$row_pass = @mysqli_fetch_assoc($result_pass);
				$old_pass = $row_pass['Password'];

			?>
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
			</div>
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