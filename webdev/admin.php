
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
	<!-- jQuery Validate Plugin files -->
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script type="text/javascript" src="libs/additional-methods.min.js"></script>
</head>
<body>

	<div class="wrapper">

	<?php @require_once "includes/header.inc.php"; ?>

		<div class="content">
			
			<div id="admin-tabs">
				<ul>
					<li><a href="#tab-a">Accounts</a></li>
					<li><a href="#tab-b">Add/Change Accounts</a></li>
					<li><a href="#tab-c">System Settings</a></li>
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
								echo "<th>Username</th>";
								echo "<th>Email</th>";
								echo "<th>Preset</th>";
								echo "<th>Modify Account</th>";
								echo "</tr>\n";

								while($row_account = @mysqli_fetch_array($result_account)) {
									echo "<tr>\n";
									echo "<td>" . $row_account['LoginName'] . "</td>";
									echo "<td>" . $row_account['Email'] . "</td>";
									echo "<td>" . $row_account['PresetName'] . "</td>";
									echo "<td>
											<a href=\"id=" . $row_account['AccountID'] . "\"><input type=\"button\" class=\"edit-account\" href=\"#\" value=\"Edit Account\"></a>
											<a href=\"id=" . $row_account['AccountID'] . "\"><input type=\"button\" class=\"reset-pass\" href=\"#\" value=\"Password Reset\"></a>
											<a href=\"id=" . $row_account['AccountID'] . "\"><input type=\"button\" class=\"delete-acc\" href=\"#\" value=\"Delete Account\" disabled></a>
										</td>";
									echo "</tr>\n";
								};

							};

							echo "</table>\n";

							// $admin_company = retrieved [CompanyName] from login info
							// return $admin_company;

						?>

					<div id="admin-table_dashboard">
						<input type="button" class="new-account" href="#" value="Add New Account">
					</div>
				</div>
				<div id="tab-b">
					<?php @include_once 'includes/admin-forms.php'; ?>
				</div>
				<div id="tab-c">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate obcaecati porro eum repudiandae possimus repellat cumque asperiores magni architecto esse sed minima dolorum deserunt, quo animi quod omnis, earum! Veniam.</p>
				</div>
			</div>

		</div>
		
		<!-- For success dialogs -->
		<?php @include_once 'includes/admin-dialogs.php'; ?>
		<!-- For success dialogs -->

	<?php @require_once "includes/footer.inc.php"; ?>
		
	</div>

	<!-- JavaScript/jQuery script file -->
	<script src="js/script.js"></script>
	<script src="js/admin-valid-script.js"></script>

</body>
</html>