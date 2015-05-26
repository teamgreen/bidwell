<!DOCTYPE html>
<html lang="en">
<head>

	<!-- 
	
	///////////////////////////////////////
	// Admin Page
	// Authored by Alex Chaudoin
	// Created 5/15/2015
	// Purpose: To provide a page where
	// 			the admin can access other
	//			accounts and change 
	//			system settings as well.
	///////////////////////////////////////

	-->

	<meta charset="UTF-8">
	<title>Admin | Bid-Well</title>
	
	<!-- Main Stylesheet and Admin Page Stylesheet -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/admin-style.css">
	<!-- Custom jQuery UI Library Stylesheets - 1.11.4 -->
	<link rel="stylesheet" href="libs/jquery-ui-1.11.4.custom/jquery-ui.min.css">
	<link rel="stylesheet" href="libs/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css">

	<!-- jQuery Library - Google CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Custom jQuery UI Library - 1.11.4 -->
	<script src="libs/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
</head>
<body>

	<div class="wrapper">

	<?php @require_once "includes/header.inc.php"; ?>

		<div class="content">
			
			<div id="admin-tabs">
				<ul>
					<li><a href="#tab-a">Accounts</a></li>
					<li><a href="#tab-b">System Settings</a></li>
				</ul>
				<div id="tab-a">
						<?php
		
							require 'includes/mysqli_connect.inc.php';

							$dbc = SQLConnect();

							// SQL statement to select everything from account table to populate table with rows and cells		
							$sql_account = "SELECT * FROM `account`";
							$result_account = @mysqli_query($dbc, $sql_account);

							$num_rows_account = @mysqli_num_rows($result_account);
							if ($num_rows_account == 0) {
								echo "<p>Currently there are no accounts in this tab.</p>";
								echo "<p>Care to create a new account by clicking 'New' below?</p>";
							} else {

								echo "<table>\n";
								echo "<tr>\n";
								echo "<th>Account ID</th>";
								echo "<th>Username</th>";
								echo "<th>Email</th>";
								echo "<th>Preset</th>";
								echo "<th>Password</th>";
								echo "</tr>\n";

								while($row_account = @mysqli_fetch_array($result_account)) {
									echo "<tr>\n";
									echo "<td>" . $row_account['AccountID'] . "</td>";
									echo "<td>" . $row_account['LoginName'] . "</td>";
									echo "<td>" . $row_account['Email'] . "</td>";
									echo "<td>" . $row_account['PresetName'] . "<span class=\"ui-icon ui-icon-info\" title=\"" . $row_account['PresetName'] . "\"></span></td>";
									echo "<td>" . $row_account['Password'] . "</td>";
									echo "</tr>\n";
								};

							};

							echo "</table>\n";

						?>
					<div id="admin-table_dashboard">
						<input type="reset" class="reset" href="#" value="Reset">
						<input type="button" class="new-edit" href="#" value="New"><!--will change-->
						<input type="button" class="delete" href="#" value="Delete">
					</div>
				</div>
				<div id="tab-b">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate obcaecati porro eum repudiandae possimus repellat cumque asperiores magni architecto esse sed minima dolorum deserunt, quo animi quod omnis, earum! Veniam.</p>
				</div>
			</div>

		</div>

		<div id="add-account" title="Add a new account">
			<form>
				<fieldset>
					<label for="name">Username</label>
					<input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all">
					<label for="name">Email</label>
					<input type="email" name="email" id="email" class="text ui-widget-content ui-corner-all">
					<label for="name">Password</label>
					<input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all">
					<label for="name">Confirm Password</label>
					<input type="password" name="confirm-password" id="confirm-password" class="text ui-widget-content ui-corner-all">
				</fieldset>
			</form>
		</div>

		<div id="edit-account" title="Edit an account">
			<form>
				<fieldset>
					<label for="name">Username</label>
					<input type="text" name="username" id="username" value="Lorem Ipsum" class="text ui-widget-content ui-corner-all">
					<label for="name">Email</label>
					<input type="email" name="email" id="email" value="email@gmail.com" class="text ui-widget-content ui-corner-all">
					<label for="name">Password</label>
					<input type="password" name="password" id="password" value="***********" class="text ui-widget-content ui-corner-all">
					<label for="name">Confirm Password</label>
					<input type="password" name="confirm-password" id="confirm-password" value="***********" class="text ui-widget-content ui-corner-all">
				</fieldset>
			</form>
		</div>

	<?php @require_once "includes/footer.inc.php"; ?>
		
	</div>

	<!-- JavaScript/jQuery script file -->
	<script src="js/script.js"></script>

</body>
</html>