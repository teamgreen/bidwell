<!DOCTYPE html>
<html lang="en">
<head>

	<!-- 
	
	///////////////////////////////////////
	// Home Page
	// Authored by Alex Chaudoin
	// Created 5/15/2015
	// Purpose: To provide a page where
	// 			the user can access their
	//			current and completed 
	//			projects, as well as
	//			create a new project.
	///////////////////////////////////////

	-->

	<meta charset="UTF-8">
	<title>Home | Bid-Well</title>
	
	<!-- Main Stylesheet and Home Page Stylesheet -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/home-style.css">
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

			<div id="home-tabs">
				<ul>
					<li><a href="#tab1">Current Projects</a></li>
					<li><a href="#tab2">New Project</a></li>
					<li><a href="#tab3">Completed Projects</a></li>
				</ul>
				<div id="tab1">
					<!-- test PHP function to read account permissions
					<?php
	
						// require 'includes/mysqli_connect.inc.php';

						// $dbc = SQLConnect();

						// $sql_test = "SELECT * FROM `account|permission`";
						// $result_test = @mysqli_query($dbc, $sql_test);

						// while($row_test = @mysqli_fetch_array($result_test)) {
						// 	testPermissions($row_test['AccountID'], $row_test['PermissionID']);
						// }

						// function testPermissions($accountID, $permissionID) {
						// 	if ($accountPermission === $permissionID) {
						// 		return 1;
						// 	} else {
						// 		return 0;
						// 	};
						// }

					?> -->
					<?php
		
						require 'includes/mysqli_connect.inc.php';

						$dbc = SQLConnect();

						// SQL statement to select everything from project table to populate table with rows and cells		
						$sql_project = "SELECT * FROM `project`";
						$result_project = @mysqli_query($dbc, $sql_project);

						$num_rows_project = @mysqli_num_rows($result_project);
						if ($num_rows_project == 0) {
							echo "<p>Currently there are no projects in this tab.</p>";
							echo "<p>Care to create a new project in the next tab?</p>";
						} else {
							echo "<table>\n";
							echo "<tr>\n";
							echo "<th>Project Number</th>";
							echo "<th>Project Name</th>";
							echo "<th>Location</th>";
							echo "<th>Completion Date</th>";
							echo "<th>Status</th>";
							echo "</tr>\n";

							while($row_project = @mysqli_fetch_array($result_project)) {
								echo "<tr>\n";
								echo "<td>" . $row_project['ProjectID'] . "</td>";
								echo "<td>" . $row_project['ProjectName'] . "<span class=\"ui-icon ui-icon-info\" title=\"" . $row_project['ProjectName'] . "\"></span></td>";
								echo "<td>" . $row_project['SiteAddressID'] . "</td>";
								echo "<td>" . $row_project['ProjectDueDate'] . "</td>";
								echo "<td>" . $row_project['ProjectStatusID'] . "<span class=\"ui-icon ui-icon-info\" title=\"" . $row_project['ProjectStatusID'] . "\"></span></td>";
								echo "</tr>\n";
							}

							echo "</table>\n";
						};

					?>
				</div>
				<div id="tab2">
					<?php
						
						@require_once 'includes/mysqli_functions.inc.php';

						$hasPermission = HasPermission($dbc, 2, Permission::ePROJECT_CREATE);
						if ($hasPermission == false) {
							echo "<p>We are sorry to report that you do not have the permission to create a project.</p>";
						} else {
							@include_once 'includes/project-form.inc.php';
						};

					?>
				</div>
				<div id="tab3">
					<?php

						// SQL statement to select everything from project table to populate table with rows and cells		
						$sql_completed_project = "SELECT * FROM `project`";
						$result_completed_project = @mysqli_query($dbc, $sql_completed_project);

						$num_rows_completed_project = @mysqli_num_rows($result_completed_project);
						if ($num_rows_completed_project == 0) {
							echo "<p>Currently there are no completed projects in this tab.</p>";
							echo "<p>Care to create a new project in the previous tab?</p>";
						} else {
							echo "<table>\n";
							echo "<tr>\n";
							echo "<th>Project Number</th>";
							echo "<th>Project Name</th>";
							echo "<th>Location</th>";
							echo "<th>Completed Date</th>";
							echo "<th>Status</th>";
							echo "</tr>\n";

							while($row_completed_project = @mysqli_fetch_array($result_completed_project)) {
								echo "<tr>\n";
								echo "<td>" . $row_completed_project['ProjectID'] . "</td>";
								echo "<td>" . $row_completed_project['ProjectName'] . "<span class=\"ui-icon ui-icon-info\" title=\"" . $row_completed_project['ProjectName'] . "\"></span></td>";
								echo "<td>" . $row_completed_project['SiteAddressID'] . "</td>";
								echo "<td>" . $row_completed_project['ProjectDueDate'] . "</td>";
								echo "<td>" . $row_completed_project['ProjectStatusID'] . "<span class=\"ui-icon ui-icon-info\" title=\"" . $row_completed_project['ProjectStatusID'] . "\"></span></td>";
								echo "</tr>\n";
							}

							echo "</table>\n";
						};

					?>
				</div>
			</div>

		</div>

	<?php @require_once "includes/footer.inc.php"; ?>

	</div>

	<!-- JavaScript/jQuery script file -->
	<script src="js/script.js"></script>
</body>
</html>
