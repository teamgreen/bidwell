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

	<!-- jQuery Library - Local File -->
	<script src="libs/jquery-1.11.3.min.js"></script>
	<!-- Custom jQuery UI Library - 1.11.4 -->
	<script src="libs/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
	<!-- jQuery Validate Plugin files -->
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script type="text/javascript" src="libs/additional-methods.min.js"></script>

    <!-- Font Awesome Bootstrap CDN -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>
<body>

	<div class="wrapper">

		<?php 
		$filename=basename(__FILE__);
		@require_once "includes/header.inc.php"; 
		@require_once 'includes/admin-add_reset_delete.php';
		@include_once 'includes/debugging-helper-functions.inc.php';
		?>
		<div class="post-success">Success! The password has been changed.</div>
		<div class="post-error">Error: Password could not be updated.</div>

		<div class="content">
			
			<div id="admin-tabs">
				<ul>
					<li><a href="#tab-a">Accounts</a></li>
				</ul>
				<div id="tab-a">
						<?php

							require 'includes/mysqli_connect.inc.php';

							$dbc = SQLConnect();

							if (isset($_GET["pageNum"])) {
								$pageNum = $_GET["pageNum"];
							} else {
								$pageNum = 1;
							};

							$sql_account = "SELECT COUNT(*) FROM `account`";
							$result_account = @mysqli_query($dbc, $sql_account);

							$rows = @mysqli_fetch_row($result_account);
							$totalResults = $rows[0];
							$numRows = 5;
							$lastPage = ceil($totalResults / $numRows);

							$pageNum = (int)$pageNum;
							if ($pageNum > $lastPage) {
								$pageNum = $lastPage;
							}
							if ($pageNum < 1) {
								$pageNum = 1;
							}

							$limit = 'LIMIT ' . ($pageNum - 1) * $numRows . ", " . $numRows;

							// SQL statement to select everything from account table to populate table with rows and cells		
							$sql_account = "SELECT * FROM `account` $limit";
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
									echo "<tr class=\"accountRow\" data-id=\"{$row_account['AccountID']}\">\n";
									echo "<td><input type=\"text\" class=\"admin-table\" value=\"" . $row_account['LoginName'] . "\"></td>";
									echo "<td><input type=\"text\" class=\"admin-table\" value=\"" . $row_account['Email'] . "\"></td>";
									echo "<td><input type=\"text\" class=\"admin-table\" value=\"" . $row_account['PresetName'] . "\"></td>";
									echo "<td>
											<button type=\"button\" class=\"edit-account admin-buttons\" title=\"Edit Account\"><i class=\"fa fa-pencil\"></i></button>
											<button type=\"button\" class=\"reset-pass admin-buttons\" data-accountid=\"{$row_account['AccountID']}\"title=\"Reset Password\"><i class=\"fa fa-key\"></i></button>
 											<button type=\"button\" class=\"delete-account admin-buttons\" title=\"Delete Account\"><i class=\"fa fa-trash\"></i></button>
											<button type=\"button\" class=\"save-cancel save admin-buttons\" title=\"Save Changes\"><i class=\"fa fa-floppy-o\"></i></button>
											<button type=\"button\" class=\"save-cancel cancel cancel-edit admin-buttons\" title=\"Cancel Changes\"><i class=\"fa fa-ban\"></i></button>
											</form>
										</td>";
									echo "</tr>\n";
								};

							};

							echo "</table>\n";

							echo "<div class='pagination'>\n";
							
							if ($pageNum != 1) {
								echo "<button onclick=\"window.location='{$_SERVER['PHP_SELF']}?pageNum=1';\" class=\"page-buttons\" title=\"First\">First Page</button>";
								$previous = $pageNum - 1;
								echo "<button onclick=\"window.location='{$_SERVER['PHP_SELF']}?pageNum=$previous';\" class=\"page-buttons\" title=\"Previous\"><i class=\"fa fa-arrow-left\"></i></button>";
							};

							echo "<span class='page-span'>Page $pageNum of $lastPage</span>";

							if ($pageNum != $lastPage) {
								$next = $pageNum + 1;
								echo "<button onclick=\"window.location='{$_SERVER['PHP_SELF']}?pageNum=$next';\" class=\"page-buttons\" title=\"Next\"><i class=\"fa fa-arrow-right\"></i></button>";
								echo "<button onclick=\"window.location='{$_SERVER['PHP_SELF']}?pageNum=$lastPage';\" class=\"page-buttons\" title=\"Last\">Last Page</button>";
							};

							echo "</div>";

						?>

					<div id="admin-table_dashboard">
						<button class="add-account">
							<i class="fa fa-plus"></i> Add New Account
						</button>
					</div>
				</div>
			</div>

		</div>

	<?php @require_once "includes/footer.inc.php"; ?>
		
	</div>

	<!-- JavaScript/jQuery script file -->
	<script src="js/script.js"></script>
	<script src="js/admin-valid-script.js"></script>

</body>
</html>