			
					<?php

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

							addAddress($ownerName, $ownerAddress1, $ownerAddress2, $ownerCity, $ownerState, $ownerZip);

							addAddress($architectName, $architectAddress1, $architectAddress2, $architectCity, $architectState, $architectZip);

							addAddress($locationAddress1, $locationAddress2, $locationCity, $locationState, $locationZip);

							// header('Location: project.php');
							// exit();
						};
		
					?>