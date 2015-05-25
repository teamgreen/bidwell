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
					<table>
						<tr>
							<th>Project Number</th>
							<th>Project Name</th>
							<th>Location</th>
							<th>Completion Date</th>
							<th>Status</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>Portland</td>
							<td>7/12/2015</td>
							<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
						</tr>
						<tr>
							<td>2</td>
							<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>Portland</td>
							<td>7/19/2015</td>
							<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
						</tr>
						<tr>
							<td>3</td>
							<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>Portland</td>
							<td>7/27/2015</td>
							<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
						</tr>
						<tr>
							<td>4</td>
							<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>Portland</td>
							<td>8/2/2015</td>
							<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
						</tr>
					</table>
				</div>
				<div id="tab2">
					<form action="#" method="post" id="home-form">
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
									<input type="text" id="address1_owner" name="address_owner" maxlength="100">
									<input type="text" id="address2_owner" name="address_owner" maxlength="100">
								</div>
								<div>
									<label for="city_owner">City</label>
									<input type="text" id="city_owner" name="city_owner" maxlength="20">
								</div>
								<div>
									<label for="state">State</label>
									<select name="state" id="state">
										<?php 

											require 'includes/mysqli_connect.inc.php';

											$dbc = SQLConnect();

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
									<input type="text" id="address1_architect" name="address_architect" maxlength="100">
									<input type="text" id="address2_architect" name="address_architect" maxlength="100">
								</div>
								<div>
									<label for="city_architect">City</label>
									<input type="text" id="city_architect" name="city_architect" maxlength="20">
								</div>
								<!-- <div>
									<label for="state">State</label>
									<select name="state" id="state">
										<option value="ca">California</option>
										<option value="or">Oregon</option>
										<option value="wa">Washington</option>
									</select>
								</div> WA is default, pull states from table -->
								<div>
									<label for="zip_architect">Zip</label>
									<input type="text" id="zip_architect" name="zip_architect" maxlength="12">
								</div>
							</div>
						</div>
						<div>
							<p>Project Site Information</p>
							<hr>
							<div class="form-half">
								<div>
									<label>Address</label>
									<input type="text" id="address1_location" name="address_location" maxlength="100">
									<input type="text" id="address2_location" name="address_location" maxlength="100">
								</div>
								<div>
									<label for="city_location">City</label>
									<input type="text" id="city_location" name="city_location" maxlength="20">
								</div>
								<!-- <div>
									<label for="state">State</label>
									<select name="state" id="state">
										<option value="ca">California</option>
										<option value="or">Oregon</option>
										<option value="wa">Washington</option>
									</select>
								</div> WA is default, pull states from table -->
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
								<input type="submit" class="finish" id="finish" value="Finish">
							</div>
						</div>
					</div>
				</div>
				<div id="tab3">
					<table>
						<tr>
							<th>Project Number</th>
							<th>Project Name</th>
							<th>Location</th>
							<th>Completed Date</th>
							<th>Status</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>1/11/2015</td>
							<td>Closed</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>1/14/2015</td>
							<td>Closed</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>1/20/2015</td>
							<td>Closed</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>2/4/2015</td>
							<td>Closed</td>
						</tr>
					</table>
				</div>
			</div>

		</div>

	<?php @require_once "includes/footer.inc.php"; ?>

	</div>

	<!-- JavaScript/jQuery script file -->
	<script src="js/script.js"></script>
</body>
</html>
