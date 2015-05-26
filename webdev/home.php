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
					<!--<?php
						
						// @require_once 'includes/mysqli_functions.inc.php';

						// $hasPermission = HasPermission($dbc, 2, Permission::ePROJECT_CREATE);
						// if ($hasPermission == false) {
						// 	echo "<p>We are sorry to report that you do not have the permission to create a project.</p>";
						// } else {
						// 	@include_once 'includes/project-form.inc.php';
						// };

					?>-->

					<form action="" method="post" id="home-form">
						<div class="active-form">
							<p>Project Information</p>
							<hr>
							<div class="form-half">
								<div>
									<label for="project_name">Project Name</label>
									<input type="text" id="project_name" name="project_name" maxlength="100">
								</div>
								<div>
									<label for="project_description">Project Description</label>
									<textarea id="project_description" name="project_description" rows="5" cols="25" maxlength="1000"></textarea>
								</div>
							</div>
							<div class="form-half">
								<div>
									<label for="project_due_date">Due Date</label>
									<input type="text" id="project_due_date" name="project_due_date">
								</div>
							</div>
						</div>
						<div>
							<p>Owner Information</p>
							<hr>
							<div class="form-half">
								<div>
									<label for="name_owner">Name</label>
									<input type="text" id="name_owner" name="name_owner" maxlength="200">
								</div>
								<div>
									<label for="phone_owner">Phone</label>
									<input type="text" id="phone_owner" name="phone_owner" maxlength="40">
								</div>
								<div>
									<label for="cellphone_owner">Cellphone</label>
									<input type="text" id="cellphone_owner" name="cellphone_owner" maxlength="40">
								</div>
								<div>
									<label for="email_owner">Email</label>
									<input type="email" id="email_owner" name="email_owner" maxlength="40">
								</div>
							</div>
							<div class="form-half">
								<div>
									<label>Address</label>
									<input type="text" id="address1_owner" name="address1_owner" maxlength="100">
									<input type="text" id="address2_owner" name="address2_owner" maxlength="100">
								</div>
								<div>
									<label for="city_owner">City</label>
									<input type="text" id="city_owner" name="city_owner" maxlength="20">
								</div>
								<div>
									<label for="state_owner">State</label>
									<select name="state_owner" id="state_owner">
										<option value="-">Select a State</option>
										<?php 

											// SQL statement to select everything from state table to populate options in select form element
											$sql_states = "SELECT * FROM `state`";
											$result_states = @mysqli_query($dbc, $sql_states);

											while($row_states = @mysqli_fetch_array($result_states)) {
												echo "<option value='" . $row_states['fullStateName'] . "'>" .$row_states['abbrevName'] . "</option>\n";
											}

										?>
									</select>
								</div>
								<div>
									<label for="zip_owner">Zip</label>
									<input type="text" id="zip_owner" name="zip_owner" maxlength="10">
								</div>
							</div>
						</div>
						<div>
							<p>Architect Information</p>
							<hr>
							<div class="form-half">
								<div>
									<label for="name_architect">Name</label>
									<input type="text" id="name_architect" name="name_architect" maxlength="200">
								</div>
								<div>
									<label for="phone_architect">Phone</label>
									<input type="text" id="phone_architect" name="phone_architect" maxlength="40">
								</div>
								<div>
									<label for="cellphone_architect">Cellphone</label>
									<input type="text" id="cellphone_architect" name="cellphone_architect" maxlength="40">
								</div>
								<div>
									<label for="email_architect">Email</label>
									<input type="email" id="email_architect" name="email_architect" maxlength="100">
								</div>
							</div>
							<div class="form-half">
								<div>
									<label>Address</label>
									<input type="text" id="address1_architect" name="address1_architect" maxlength="100">
									<input type="text" id="address2_architect" name="address2_architect" maxlength="100">
								</div>
								<div>
									<label for="city_architect">City</label>
									<input type="text" id="city_architect" name="city_architect" maxlength="20">
								</div>
								<div>
									<label for="state_architect">State</label>
									<select name="state_architect" id="state_architect">
										<option value="-">Select a State</option>
										<?php 

											// SQL statement to select everything from state table to populate options in select form element
											$sql_states = "SELECT * FROM `state`";
											$result_states = @mysqli_query($dbc, $sql_states);

											while($row_states = @mysqli_fetch_array($result_states)) {
												echo "<option value='" . $row_states['fullStateName'] . "'>" .$row_states['abbrevName'] . "</option>\n";
											}

										?>
									</select>
								</div>
								<div>
									<label for="zip_architect">Zip</label>
									<input type="text" id="zip_architect" name="zip_architect" maxlength="12">
								</div>
							</div>
						</div>
						<div>
							<p>Project Location Information</p>
							<hr>
							<div class="form-half">
								<div>
									<label>Address</label>
									<input type="text" id="address1_location" name="address1_location" maxlength="100">
									<input type="text" id="address2_location" name="address2_location" maxlength="100">
								</div>
								<div>
									<label for="city_location">City</label>
									<input type="text" id="city_location" name="city_location" maxlength="20">
								</div>
								<div>
									<label for="state_location">State</label>
									<select name="state_location" id="state_location">
										<option value="-">Select a State</option>
										<?php 

											// SQL statement to select everything from state table to populate options in select form element
											$sql_states = "SELECT * FROM `state`";
											$result_states = @mysqli_query($dbc, $sql_states);

											while($row_states = @mysqli_fetch_array($result_states)) {
												echo "<option value='" . $row_states['fullStateName'] . "'>" .$row_states['abbrevName'] . "</option>\n";
											}

										?>
									</select>
								</div>
								<div>
									<label for="zip_location">Zip</label>
									<input type="text" id="zip_location" name="zip_location" maxlength="12">
								</div>
							</div>
							<div class="form-half">
								<div>
									<label for="project_notes">Project Notes</label>
									<textarea id="project_notes" name="project_notes" rows="5" cols="25" maxlength="4000"></textarea>
								</div>
								<div>
									<input type="submit" id="submit" value="Finish">
								</div>
							</div>
						</div>
					</form>
					<div id="home-form_dashboard">
						<hr>
						<p>Completion Percentage</p>
						<div id="progress-bar"></div>
						<div id="progress-buttons">
							<div class="active">
								<span>Page 1 of 4</span>
								<input type="button" class="next" id="next1" value="Next" onclick="nextDiv('#next1')">
							</div>
							<div>
								<input type="button" class="prev" id="prev1" value="Previous" onclick="prevDiv('#prev1')">
								<span>Page 2 of 4</span>
								<input type="button" class="next" id="next2" value="Next" onclick="nextDiv('#next2')">
							</div>
							<div>
								<input type="button" class="prev" id="prev2" value="Previous" onclick="prevDiv('#prev2')">
								<span>Page 3 of 4</span>
								<input type="button" class="next" id="next3" value="Next" onclick="nextDiv('#next3')">
							</div>
							<div>
								<input type="button" class="prev" id="prev3" value="Previous" onclick="prevDiv('#prev3')">
								<span>Page 4 of 4</span>
							</div>
						</div>
					</div>
					<?php

						require 'includes/mysqli_functions.inc.php';

						# If the above form has been submitted,
						# this PHP code will run and all the form
						# values will be sent to the database.

						if($_SERVER['REQUEST_METHOD'] === 'POST') {

							$projectName = assignIfNotEmpty('project_name', 'Project');
							$projectDescription = assignIfNotEmpty('project_description', 'Here is the project description.');
							$projectDueDate = assignIfNotEmpty('project_due_date', 'TBD');

							$ownerName = assignIfNotEmpty('name_owner', 'TBD');
							$ownerPhone = assignIfNotEmpty('phone_owner', 'TBD');
							$ownerCellphone = assignIfNotEmpty('cellphone_owner', 'TBD');
							$ownerEmail = assignIfNotEmpty('email_owner', 'TBD');
							$ownerAddress1 = assignIfNotEmpty('address1_owner', 'TBD');
							$ownerAddress2 = assignIfNotEmpty('address2_owner', 'TBD');
							$ownerCity = assignIfNotEmpty('city_owner', 'TBD');
							$ownerState = assignIfNotEmpty('state_owner', 'TBD');
							$ownerZip = assignIfNotEmpty('zip_owner', 'TBD');

							$architectName = assignIfNotEmpty('name_architect', 'TBD');
							$architectPhone = assignIfNotEmpty('phone_architect', 'TBD');
							$architectCellphone = assignIfNotEmpty('cellphone_architect', 'TBD');
							$architectEmail = assignIfNotEmpty('email_architect', 'TBD');
							$architectAddress1 = assignIfNotEmpty('address1_architect', 'TBD');
							$architectAddress2 = assignIfNotEmpty('address2_architect', 'TBD');
							$architectCity = assignIfNotEmpty('city_architect', 'TBD');
							$architectState = assignIfNotEmpty('state_architect', 'TBD');
							$architectZip = assignIfNotEmpty('zip_architect', 'TBD');

							$locationAddress1 = assignIfNotEmpty('address1_location', 'TBD');
							$locationAddress2 = assignIfNotEmpty('address2_location', 'TBD');
							$locationCity = assignIfNotEmpty('city_location', 'TBD');
							$locationState = assignIfNotEmpty('state_location', 'TBD');
							$locationZip = assignIfNotEmpty('zip_location', 'TBD');
							$projectNotes = assignIfNotEmpty('project_notes', 'Here are the project notes.');

							$sql_form_project = "INSERT INTO `project` (ProjectName, ProjectDescription, ProjectDueDate, Owner, OwnerPhone, OwnerCellPhone, OwnerEmail, Architect, ArchitectPhone, ArchitectCellPhone, ArchitectEmail, ProjectNotes)
										VALUES ('$projectName', '$projectDescription', '$projectDueDate', '$ownerName', '$ownerPhone', '$ownerCellphone', '$ownerEmail', '$architectName', '$architectPhone', '$architectCellphone', '$architectEmail', '$projectNotes')";
							$result_form_project = @mysqli_query($dbc, $sql_form_project);

							$num_rows_form_project = @mysqli_num_rows($result_form_project);
							if ($num_rows_form_project == 0) {
							 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
							 	echo "Project Information\n</p>";
							};

							addAddress($ownerName, $ownerAddress1, $ownerAddress2, $ownerCity, $ownerState, $ownerZip, 'Owner Address Information');

							# use SQL to retrieve addressId from Owner info
							# and insert same value for OwnerAddress ID to 
							# project table
							addAddressID($ownerName, 'Owner Address ID');

							addAddress($architectName, $architectAddress1, $architectAddress2, $architectCity, $architectState, $architectZip, 'Architect Address Information');

							# use SQL to retrieve addressId from Architect info
							# and insert same value for ArchitectAddress ID to 
							# project table
							addAddressID($architectName, 'Architect Address ID');

							addAddress($locationAddress1, $locationAddress2, $locationCity, $locationState, $locationZip, 'Location Address Information');

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
