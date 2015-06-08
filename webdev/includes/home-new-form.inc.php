
					<form action="home.php" method="post" id="home-form">
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
										<option value="">Select a State</option>
										<?php 

											// SQL statement to select everything from state table to populate options in select form element
											$sql_states = "SELECT * FROM `state`";
											$result_states = @mysqli_query($dbc, $sql_states);

											while($row_states = @mysqli_fetch_array($result_states)) {
												echo "<option value='"  .$row_states['abbrevName']. "'>" . $row_states['fullStateName'] . "</option>\n";
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
										<option value="">Select a State</option>
										<?php 

											// SQL statement to select everything from state table to populate options in select form element
											$sql_states = "SELECT * FROM `state`";
											$result_states = @mysqli_query($dbc, $sql_states);

											while($row_states = @mysqli_fetch_array($result_states)) {
												echo "<option value='" . $row_states['abbrevName'] . "'>" .$row_states['fullStateName'] . "</option>\n";
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
										<option value="">Select a State</option>
										<?php 

											// SQL statement to select everything from state table to populate options in select form element
											$sql_states = "SELECT * FROM `state`";
											$result_states = @mysqli_query($dbc, $sql_states);

											while($row_states = @mysqli_fetch_array($result_states)) {
												echo "<option value='" . $row_states['abbrevName'] . "'>" .$row_states['fullStateName'] . "</option>\n";
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
							</div>
						</div>
					</form>
					<div id="home-form_dashboard">
						<hr>
						<p>Form Progress</p>
						<div id="progress-bar"></div>
						<div id="progress-buttons">
							<div class="active">
								<span>Page 1 of 4</span>
								<button class="next form-buttons" id="next1" value="Next"><i class="fa fa-arrow-right"></i></button>
							</div>
							<div>
								<button class="prev form-buttons" id="prev1" value="Previous" onclick="prevDiv('#prev1')"><i class="fa fa-arrow-left"></i></button>
								<span>Page 2 of 4</span>
								<button class="next form-buttons" id="next2" value="Next"><i class="fa fa-arrow-right"></i></button>
							</div>
							<div>
								<button class="prev form-buttons" id="prev2" value="Previous" onclick="prevDiv('#prev2')"><i class="fa fa-arrow-left"></i></button>
								<span>Page 3 of 4</span>
								<button class="next form-buttons" id="next3" value="Next"><i class="fa fa-arrow-right"></i></button>
							</div>
							<div>
								<button class="prev form-buttons" id="prev3" value="Previous" onclick="prevDiv('#prev3')"><i class="fa fa-arrow-left"></i></button>
								<span>Page 4 of 4</span>
								<button type="submit" id="submit" form="home-form" value="Submit"><i class="fa fa-paper-plane"></i> Submit</button>
							</div>
						</div>
					</div>
					<?php

						# If the above form has been submitted,
						# this PHP code will run and all the form
						# values will be sent to the database.

						if($_SERVER['REQUEST_METHOD'] == 'POST') {

							$projectName = assignIfNotEmpty('project_name', 'Project');
							$projectDescription = assignIfNotEmpty('project_description', 'Here is the project description.');
							$projectCurrentDate = date('Y-m-d');
							$projectDueDate = assignIfNotEmpty('project_due_date', 'TBD');
							$projectDueDate = rearrangeDate($projectDueDate);
				
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

							$sql_form_project = "INSERT INTO `project` (ProjectName, ProjectDescription, ProjectDateEntered, ProjectDueDate, Owner, OwnerPhone, OwnerCellPhone, OwnerEmail, Architect, ArchitectPhone, ArchitectCellPhone, ArchitectEmail, ProjectNotes)
										VALUES ('$projectName', '$projectDescription', '$projectCurrentDate', '$projectDueDate', '$ownerName', '$ownerPhone', '$ownerCellphone', '$ownerEmail', '$architectName', '$architectPhone', '$architectCellphone', '$architectEmail', '$projectNotes')";

							$result_form_project = @mysqli_query($dbc, $sql_form_project);

							$num_rows_form_project = @mysqli_num_rows($result_form_project);
							if ($num_rows_form_project === 0) {
							 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
							 	echo "Project Information\n</p>";
							};

							// Add Owner Address
							$sql_o = "INSERT INTO `address` (Address1, Address2, City, State, ZipCode)
									VALUES ('$ownerAddress1', '$ownerAddress2', '$ownerCity', '$ownerState', '$ownerZip')";
							$result_o = @mysqli_query($dbc, $sql_o);

							$num_rows_o = @mysqli_num_rows($result_o);
							if ($num_rows_o === 0) {
							 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
							 	echo "Owner Address\n</p>";
							};

							// Add Owner Address ID
							$sql_o_id = "UPDATE `project` 
										SET OwnerAddressID = (
											SELECT AddressID FROM `address` WHERE ZipCode = '$ownerZip')
										WHERE project.ProjectName = '$projectName'";
							$result_o_id = @mysqli_query($dbc, $sql_o_id);

							$num_rows_o_id = @mysqli_num_rows($result_o_id);
							if ($num_rows_o_id === 0) {
							 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
							 	echo "Owner Address ID\n</p>";
							};

							// Add Architect Address
							$sql_a = "INSERT INTO `address` (Address1, Address2, City, State, ZipCode)
									VALUES ('$architectAddress1', '$architectAddress2', '$architectCity', '$architectState', '$architectZip')";
							$result_a = @mysqli_query($dbc, $sql_a);

							$num_rows_a = @mysqli_num_rows($result_a);
							if ($num_rows_a === 0) {
							 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
							 	echo "Architect Address\n</p>";
							};

							// Add Architect Address ID 
							$sql_a_id = "UPDATE `project` 
										SET ArchitectAddressID = (
											SELECT AddressID FROM `address` WHERE ZipCode = '$architectZip')
										WHERE project.ProjectName = '$projectName'";
							$result_a_id = @mysqli_query($dbc, $sql_a_id);

							$num_rows_a_id = @mysqli_num_rows($result_a_id);
							if ($num_rows_a_id === 0) {
							 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
							 	echo "Architect Address ID\n</p>";
							};

							// Add Location Address
							$sql_l = "INSERT INTO `address` (Address1, Address2, City, State, ZipCode)
									VALUES ('$locationAddress1', '$locationAddress2', '$locationCity', '$locationState', '$locationZip')";
							$result_l = @mysqli_query($dbc, $sql_l);

							$num_rows_l = @mysqli_num_rows($result_l);
							if ($num_rows_l === 0) {
							 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
							 	echo "Location Address\n</p>";
							};

							// Add Location Address ID
							$sql_l_id = "UPDATE `project` 
										SET SiteAddressID = (
											SELECT AddressID FROM `address` WHERE ZipCode = '$locationZip')
										WHERE project.ProjectName = '$projectName'";
							$result_l_id = @mysqli_query($dbc, $sql_l_id);

							$num_rows_l_id = @mysqli_num_rows($result_l_id);
							if ($num_rows_l_id === 0) {
							 	echo "<p>We apologize for the inconvenience, but the following information has not been received:\n";
							 	echo "Location Address ID\n</p>";
							};

							$_POST = array(); // should clear all fields

							header('location:home.php');
							
						};
		
					?>
