<!DOCTYPE html>
<html lang="en">
<head>

	<!-- 
	
	///////////////////////////////////////
	// Home Page
	// Authored by Alex Chaudoin
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
							<p>Page 1<hr></p>
							<div class="form-half">
								<div>
									<label for="owner">Owner: </label>
									<input type="text" id="owner" name="owner">
								</div>
								<div>
									<label for="phone">Phone: </label>
									<input type="text" id="phone" name="phone">
								</div>
								<div>
									<label for="email">Email: </label>
									<input type="text" id="email" name="email">
								</div>
								<div>
									<label for="address">Address: </label>
									<input type="text" id="address" name="address">
								</div>
							</div>
							<div class="form-half">
								<div>
									<label for="city">City: </label>
									<input type="text" id="city" name="city">
								</div>
								<div>
									<label for="state">State: </label>
									<select name="state" id="state">
										<option value="ca">California</option>
										<option value="or">Oregon</option>
										<option value="wa">Washington</option>
									</select>
								</div>
								<div>
									<label for="zip">Zip: </label>
									<input type="text" id="zip" name="zip">
								</div>
							</div>
						</div>
						<div>
							<p>Page 2<hr></p>
							<div class="form-half">
								<div>
									<label for="owner">Owner: </label>
									<input type="text" id="owner" name="owner">
								</div>
								<div>
									<label for="phone">Phone: </label>
									<input type="text" id="phone" name="phone">
								</div>
								<div>
									<label for="email">Email: </label>
									<input type="text" id="email" name="email">
								</div>
								<div>
									<label for="address">Address: </label>
									<input type="text" id="address" name="address">
								</div>
							</div>
							<div class="form-half">
								<div>
									<label for="city">City: </label>
									<input type="text" id="city" name="city">
								</div>
								<div>
									<label for="state">State: </label>
									<select name="state" id="state">
										<option value="ca">California</option>
										<option value="or">Oregon</option>
										<option value="wa">Washington</option>
									</select>
								</div>
								<div>
									<label for="zip">Zip: </label>
									<input type="text" id="zip" name="zip">
								</div>
							</div>
						</div>
						<div>
							<p>Page 3<hr></p>
							<div class="form-half">
								<div>
									<label for="owner">Owner: </label>
									<input type="text" id="owner" name="owner">
								</div>
								<div>
									<label for="phone">Phone: </label>
									<input type="text" id="phone" name="phone">
								</div>
								<div>
									<label for="email">Email: </label>
									<input type="text" id="email" name="email">
								</div>
								<div>
									<label for="address">Address: </label>
									<input type="text" id="address" name="address">
								</div>
							</div>
							<div class="form-half">
								<div>
									<label for="city">City: </label>
									<input type="text" id="city" name="city">
								</div>
								<div>
									<label for="state">State: </label>
									<select name="state" id="state">
										<option value="ca">California</option>
										<option value="or">Oregon</option>
										<option value="wa">Washington</option>
									</select>
								</div>
								<div>
									<label for="zip">Zip: </label>
									<input type="text" id="zip" name="zip">
								</div>
							</div>
						</div>
						<div>
							<p>Page 4<hr></p>
							<div class="form-half">
								<div>
									<label for="owner">Owner: </label>
									<input type="text" id="owner" name="owner">
								</div>
								<div>
									<label for="phone">Phone: </label>
									<input type="text" id="phone" name="phone">
								</div>
								<div>
									<label for="email">Email: </label>
									<input type="text" id="email" name="email">
								</div>
								<div>
									<label for="address">Address: </label>
									<input type="text" id="address" name="address">
								</div>
							</div>
							<div class="form-half">
								<div>
									<label for="city">City: </label>
									<input type="text" id="city" name="city">
								</div>
								<div>
									<label for="state">State: </label>
									<select name="state" id="state">
										<option value="ca">California</option>
										<option value="or">Oregon</option>
										<option value="wa">Washington</option>
									</select>
								</div>
								<div>
									<label for="zip">Zip: </label>
									<input type="text" id="zip" name="zip">
								</div>
							</div>
						</div>
						<div>
							<p>Page 5<hr></p>
							<div class="form-half">
								<div>
									<label for="owner">Owner: </label>
									<input type="text" id="owner" name="owner">
								</div>
								<div>
									<label for="phone">Phone: </label>
									<input type="text" id="phone" name="phone">
								</div>
								<div>
									<label for="email">Email: </label>
									<input type="text" id="email" name="email">
								</div>
								<div>
									<label for="address">Address: </label>
									<input type="text" id="address" name="address">
								</div>
							</div>
							<div class="form-half">
								<div>
									<label for="city">City: </label>
									<input type="text" id="city" name="city">
								</div>
								<div>
									<label for="state">State: </label>
									<select name="state" id="state">
										<option value="ca">California</option>
										<option value="or">Oregon</option>
										<option value="wa">Washington</option>
									</select>
								</div>
								<div>
									<label for="zip">Zip: </label>
									<input type="text" id="zip" name="zip">
								</div>
							</div>
						</div>
					</form>
					<div id="home-form_dashboard">
						<div id="progress-bar"></div>
						<div id="progress-buttons">
							<div class="active">
								<span>Page 1 of 5</span>
								<input type="button" class="next" href="#" id="next1" value="Next" onclick="nextDiv('#next1')">
							</div>
							<div>
								<input type="button" class="prev" href="#" id="prev1" value="Previous" onclick="prevDiv('#prev1')">
								<span>Page 2 of 5</span>
								<input type="button" class="next" href="#" id="next2" value="Next" onclick="nextDiv('#next2')">
							</div>
							<div>
								<input type="button" class="prev" href="#" id="prev2" value="Previous" onclick="prevDiv('#prev2')">
								<span>Page 3 of 5</span>
								<input type="button" class="next" href="#" id="next3" value="Next" onclick="nextDiv('#next3')">
							</div>
							<div>
								<input type="button" class="prev" href="#" id="prev3" value="Previous" onclick="prevDiv('#prev3')">
								<span>Page 4 of 5</span>
								<input type="button" class="next" href="#" id="next4" value="Next" onclick="nextDiv('#next4')">
							</div>
							<div>
								<input type="button" class="prev" href="#" id="prev4" value="Previous" onclick="prevDiv('#prev4')">
								<span>Page 5 of 5</span>
								<input type="submit" class="finish" href="#" id="finish" value="Finish">
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
