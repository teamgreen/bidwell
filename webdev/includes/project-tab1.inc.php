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


	<form action="#" method="post" id="project-tab1-form">
	<h3>Project Name: <?php echo $project->getProjectName(); ?></h3>	
	<div class="project-active-form">
		<div class='div-table'>
			
			<div class='project-tab1'>
				
				<div class="left"><label>Project Owner: </label></div>
				<input class="project-tab1-inputs" type="text" name="project_name" id="project_name" value='<?php echo $project->getOwner(); ?>'>
				<div class="left"><label>Due Date:</label></div> 
				<input class="project-tab1-inputs" type="text" id="project_due_date" name="project_due_date" value='<?php @require_once 'includes/mysqli_functions.inc.php';echo rearrangeDateYMDtoMDY($project->getProjectDueDate()); ?>'>
				<div class="project-status">
				<div class="left"><label>Project Status:</label></div> 
				<?php 
					$project->generateStatusSelectHTML($dbc);
				 ?>
				
				</div>
				
			</div>
			<div class='project-tab1-ta'>
		 		<p class="left-description">Description:</p><p> <textarea class="project-tab1-textarea" id="project_description" name="project_description" rows="5" cols="25" maxlength="4000" ><?php echo $project->getProjectDescription(); ?></textarea></p>
	 		</div>

 		</div>
 	</div>	
	<!-- <hr> -->
	<div class='border-top-div'>
		<h3>Owner Information</h3>
		<div class="project-active-form">
			<div class='div-table'>
				<div class='project-tab1'>
					<div class="left2"><label>Name:</label></div>
					<input class="project-tab1-inputs1" type="text" id="name_owner" name="name_owner" maxlength="200" value='<?php echo $project->getOwner();?>'>
					<!-- <input type="text" id="name_owner" name="name_owner" maxlength="200"> -->
				
					<div class="left2"><label>Phone:</label></div>
					<input class="project-tab1-inputs1" type="text" id="phone_owner" name="phone_owner" maxlength="40" value='<?php echo $project->getOwnerPhone();?>'>
				
					<div class="left2"><label>CellPhone:</label></div>
					<input class="project-tab1-inputs1" type="text" id="cellphone_owner" name="cellphone_owner" maxlength="40" value='<?php echo $project->getOwnerCellPhone(); ?>'>
				
					<div class="left2"><label>Email:</label></div>
					<input class="project-tab1-inputs1" type="email" id="email_owner" name="email_owner" maxlength="40" value='<?php echo $project->getOwnerEmail();?>'>
				</div>
				<div class='project-tab1'>
					<div class="left2"><label>Address:</label></div>
					<input class="project-tab1-inputs1" type="text" id="address_owner" name="address_owner" maxlength="100" value='<?php echo $project->getAddress(Project::eOwnerAddress)->getAddress1();?>'>
					<div class="left2"><label>Address 2:</label></div>
					<input class="project-tab1-inputs1" type="text" id="address1_owner" name="address1_owner" maxlength="100" value='<?php echo $project->getAddress(Project::eOwnerAddress)->getAddress2(); ?>'>
					<div class='left2'><label>City:</label></div> 

					<input class="project-tab1-inputs1" type="text" id="city_owner" name="city_owner" maxlength="20" value='<?php echo $project->getAddress(Project::eOwnerAddress)->getCity(); ?>'>
					
					<div class='state-select'>
						<div class='left2'><label>State:</label></div> 
					<!--<input class="project-tab1-inputs1" type="text" id="state_owner" name="state_owner" maxlength="20" value=''>-->
						<?php $project->getAddress(Project::eOwnerAddress)->createStateSelect($dbc);?>
					</div>

					<div class='left2'><label>Zip:</label></div> 
					<input class="project-tab1-inputs1" type="text" id="zip_owner" name="zip_owner" maxlength="20" value='<?php echo $project->getAddress(Project::eOwnerAddress)->getZipCode1(); ?>'>
				</div>
			</div>
		</div>	
	</div>
	<!-- <hr> -->
	<div class='border-top-div'>
		<h3>Architect Information</h3>
		<div class='div-table'>
			<div class='project-tab1'>
				<div class="left2"><label>Name:</label></div>
				<input class="project-tab1-inputs1" type="text" id="name_architect" name="name_architect" maxlength="200" value='<?php echo $project->getArchitect();?>'>
							
				<div class="left2"><label>Phone:</label></div>
				<input class="project-tab1-inputs1" type="text" id="phone_architect" name="phone_architect" maxlength="40" value='<?php echo $project->getArchitectPhone();?>'>
			
				<div class="left2"><label>CellPhone:</label></div>
				<input class="project-tab1-inputs1" type="text" id="cellphone_architect" name="cellphone_architect" maxlength="40" value='<?php echo $project->getArchitectCellPhone(); ?>'>
			
				<div class="left2"><label>Email:</label></div>
				<input class="project-tab1-inputs1" type="email" id="email_architect" name="email_architect" maxlength="100" value='<?php echo $project->getArchitectEmail();?>'>
			</div>
			<div class='project-tab1'>
				<div class="left2"><label>Address:</label></div>
				<input class="project-tab1-inputs1" type="text" id="address_architect" name="address_architect" maxlength="100" value='<?php echo $project->getAddress(Project::eArchitectAddress)->getAddress1();?>'>
			
				<div class="left2"><label>Address 2:</label></div>
				<input class="project-tab1-inputs1" type="text" id="address1_architect" name="address1_architect" maxlength="100" value='<?php echo $project->getAddress(Project::eArchitectAddress)->getAddress2();?>'>
			
				<div class='left2'><label>City:</label></div> 
				<input class="project-tab1-inputs1" type="text" id="city_architect" name="city_architect" maxlength="20" value='<?php echo $project->getAddress(Project::eArchitectAddress)->getCity();?>'>
				
				<div class='state-select'>
					<div class='left2'><label>State:</label></div> 
				<!--<input class="project-tab1-inputs1" type="text" id="state_owner" name="state_owner" maxlength="20" value=''>-->
					<?php $project->getAddress(Project::eArchitectAddress)->createStateSelect($dbc);?>
				</div>
				
				<div class='left2'><label>Zip:</label></div> 
				<input class="project-tab1-inputs1" type="text" id="zip_architect" name="zip_architect" maxlength="20" value='<?php echo $project->getAddress(Project::eArchitectAddress)->getZipCode1();?>'>
			</div>
		</div>
	</div>
	<!-- <hr> -->
	<div class='border-top-div'>
		<h3>Project Location Information</h3>
		<div class='div-table'>
			<div class='project-tab1'>
				<div class="left2"><label>Address:</label></div>
				<input class="project-tab1-inputs1" type="text" id="project_address_location" name="address1_location" maxlength="100" value='<?php echo $project->getAddress(Project::eSiteAddress)->getAddress1();?>'>
			
				<div class="left2"><label>Address 2:</label></div>
				<input class="project-tab1-inputs1" type="text" id="address1_location" name="address1_location" maxlength="100" value='<?php echo $project->getAddress(Project::eSiteAddress)->getAddress2();?>'>
			</div>
			<div class='project-tab1'>
				<div class='left2'><label>City:</label></div> 
				<input class="project-tab1-inputs1" type="text" id="project_city_location" name="project_city_location" maxlength="20" value='<?php echo $project->getAddress(Project::eSiteAddress)->getCity();?>'>
			
				<div class='state-select'>
					<div class='left2'><label>State:</label></div> 
				<!--<input class="project-tab1-inputs1" type="text" id="state_owner" name="state_owner" maxlength="20" value=''>-->
					<?php $project->getAddress(Project::eSiteAddress)->createStateSelect($dbc);?>
				</div>
			
				<div class='left2'><label>Zip:</label></div> 
				<input class="project-tab1-inputs1" type="text" id="project_zip_location" name="project_zip_location" maxlength="20" value='<?php echo $project->getAddress(Project::eSiteAddress)->getZipCode1();?>'>
			</div>
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

	<button name="save-changes" value="save-changes" type="button">Save Changes</button>
	

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



