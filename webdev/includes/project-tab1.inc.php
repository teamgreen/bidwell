<!-- //////////////////////////////////////
// Project Page Tab 1 Include Page
// Authored by Adam Duthie
// Purpose: To provide a page where
// 			the user can access project
// 			information, project descriptions 
//			and create/edit Internal/External
//			Bid sheets as well as Change Bids
//			for projects.
//
//			
// Project Page Tab 1 Include Page 
// Created: by Adam Duthie on 5/26 @ 2PM 
// Updated: 
//////////////////////////////////////// -->


	<form action="" method="post" id="project-tab1-form">	
	<div class="active-form">
		<h3>Project Name: <?php echo $project->getProjectName(); ?></h3>
		<div class="left"><p>Project Owner: <input class="project-tab1-inputs" type="text" name="project_name" id="project_name" value='<?php echo $project->getOwner(); ?>'></p><p>Due Date: <input class="project-tab1-inputs" type="text" id="project_due_date" name="project_due_date" value='<?php echo $project->getProjectDueDate(); ?>'></p></div>
		<div ></div>	
		<div><p class="left">Project Status: <input class="project-tab1-inputs" type="text" id="project_status_id" name="project_status_id" value='<?php echo $project->getProjectStatusId();?>'></p></div>
	 	<div><p class="left">Description: </p><p><textarea class="project-tab1-textarea" id="project_description" name="project_description"  ><?php echo $project->getProjectDescription(); ?></textarea></p>
	 	</div>
 	</div>
	<!-- <hr> -->
	<div class='border-top-div'>
		<h3>Owner Information</h3>
		<div>
			<div>
				<p class="left">Name: <input class="project-tab1-inputs" type="text" id="name_owner" name="name_owner" maxlength="200" value='<?php echo $project->getOwner();?>'></p>
				<!-- <input type="text" id="name_owner" name="name_owner" maxlength="200"> -->
			</div>
			<div>
				<p class="left">Phone: <input class="project-tab1-inputs" type="text" id="phone_owner" name="phone_owner" maxlength="40" value='<?php echo $project->getOwnerPhone();?>'></p>
			</div>
			<div>
				<p class="left">CellPhone: <input class="project-tab1-inputs" type="text" id="cellphone_owner" name="cellphone_owner" maxlength="40" value='<?php echo $project->getOwnerCellPhone(); ?>'></p>
			</div>
			<div>
				<p class="left">Email: <input class="project-tab1-inputs" type="email" id="email_owner" name="email_owner" maxlength="40" value='<?php echo $project->getOwnerEmail();?>'></p>
			</div>
			<div>
				<p class="left">Address: <input class="project-tab1-inputs" type="text" id="address_owner" name="address_owner" maxlength="100" value='<?php echo $project->getOwnerAddressID();?>'></p>
			</div>
			<div>
				<p class="left">Address Line 2: <input class="project-tab1-inputs" type="text" id="address1_owner" name="address1_owner" maxlength="100" value='<?php echo $project->getOwnerAddressID();?>'></p>
			</div>
			<div>
			<p class='left'>City
			<input class="project-tab1-inputs" type="text" id="city_owner" name="city_owner" maxlength="20" value=''></p>
			</div>
			<div>
			<p class='left'>State
			<input class="project-tab1-inputs" type="text" id="state_owner" name="state_owner" maxlength="20" value=''></p>
			</div>
			<div>
			<p class='left'>Zip
			<input class="project-tab1-inputs" type="text" id="zip_owner" name="zip_owner" maxlength="20" value=''></p>
			</div>
		</div>
	</div>
	<!-- <hr> -->
	<div class='border-top-div'>
		<h3>Architect Information</h3>
		<div>
			<div>
				<p class="left">Name: <input class="project-tab1-inputs" type="text" id="name_architect" name="name_architect" maxlength="200" value='<?php echo $project->getArchitect();?>'> </p>
				<!-- <input type="text" id="name_owner" name="name_owner" maxlength="200"> -->
			</div>
			<div>
				<p class="left">Phone: <input class="project-tab1-inputs" type="text" id="phone_architect" name="phone_architect" maxlength="40" value='<?php echo $project->getArchitectPhone();?>'> </p>
			</div>
			<div>
				<p class="left">CellPhone: <input class="project-tab1-inputs" type="text" id="cellphone_architect" name="cellphone_architect" maxlength="40" value='<?php echo $project->getArchitectCellPhone(); ?>'> </p>
			</div>
			<div>
				<p class="left">Email: <input class="project-tab1-inputs" type="email" id="email_architect" name="email_architect" maxlength="100" value='<?php echo $project->getArchitectEmail();?>'></p>
			</div>
			<div>
				<p class="left">Address: <input class="project-tab1-inputs" type="text" id="address_architect" name="address_architect" maxlength="100" value='<?php echo $project->getArchitectAddressID();?>'> </p>
			</div>
			<div>
				<p class="left">Address Line 2: <input class="project-tab1-inputs" type="text" id="address1_architect" name="address1_architect" maxlength="100" value='<?php echo $project->getArchitectAddressID();?>'></p>
			</div>
			<div>
			<p class='left'>City:
			<input class="project-tab1-inputs" type="text" id="city_architect" name="city_architect" maxlength="20"></p>
			</div>
			<div>
			<p class='left'>State:
			<input class="project-tab1-inputs" type="text" id="state_architect" name="state_architect" maxlength="20" value=''></p>
			</div>
			<div>
			<p class='left'>Zip:
			<input class="project-tab1-inputs" type="text" id="zip_architect" name="zip_architect" maxlength="20" value=''></p>
			</div>
		</div>
	</div>
	<!-- <hr> -->
	<div class='border-top-div'>
		<h3>Project Location Information</h3>
		<div>
			<p class="left">Address: <input class="project-tab1-inputs" type="text" id="project_address_location" name="address1_location" maxlength="100" value='<?php echo $project->getSiteAddressID();?>'>  </p>
		</div>
		<div>
			<p class="left">Address Line 2: <input class="project-tab1-inputs" type="text" id="address1_location" name="address1_location" maxlength="100" value='<?php echo $project->getSiteAddressID();?>'></p>
		</div>
		<div>
			<p class='left'>City:
			<input class="project-tab1-inputs" type="text" id="project_city_location" name="project_city_location" maxlength="20"></p>
		</div>
		<div>
			<p class='left'>State:
			<input class="project-tab1-inputs" type="text" id="project_state_location" name="project_state_location" maxlength="20" value=''></p>
		</div>
		<div>
			<p class='left'>Zip:
			<input class="project-tab1-inputs" type="text" id="project_zip_location" name="project_zip_location" maxlength="20" value=''></p>
		</div>
		<!-- <div>
		<p class='left'>City
		<input type="text" id="city_architect" name="city_architect" maxlength="20">
		</div>
		<div>
			<label for="state_owner">State</label>
			<select name="state_owner" id="state_owner">
				<option value="">Select a State</option>
				<//?php 

											// SQL statement to select everything from state table to populate options in select form element
				$sql_states = "SELECT * FROM `state`";
				$result_states = @mysqli_query($dbc, $sql_states);

				while($row_states = @mysqli_fetch_array($result_states)) {
					echo "<option value='" . $row_states['fullStateName'] . "'>" .$row_states['abbrevName'] . "</option>\n";
				}

				?>
			</select>
		</div> -->
	</div>
	</form>	

<!-- <div id="home-form_dashboard">
	<hr>
	<p>Project Information</p>
	<div id="progress-buttons">
		<div class="active">
			<span>Page 1 of 4</span>
			<input type="button" class="next form-buttons" id="tab1-next1" value="Next">
		</div>
		<div>
			<input type="button" class="prev form-buttons" id="tab1-prev1" value="Previous" onclick="prevDiv('#prev1')">
			<span>Page 2 of 4</span>
			<input type="button" class="next form-buttons" id="tab1-next2" value="Next">
		</div>
		<div>
			<input type="button" class="prev form-buttons" id="tab1-prev2" value="Previous" onclick="prevDiv('#prev2')">
			<span>Page 3 of 4</span>
			<input type="button" class="next form-buttons" id="tab1-next3" value="Next">
		</div>
		<div>
			<input type="button" class="prev form-buttons" id="tab1-prev3" value="Previous" onclick="prevDiv('#prev3')">
			<span>Page 4 of 4</span>
			
		</div>
	</div>
</div> -->



