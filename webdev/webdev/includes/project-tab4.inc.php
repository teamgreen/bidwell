<?php 

	@require_once 'includes/mysqli_connect.inc.php';
	$dbc = SQLConnect();

	$sql_psheet="SELECT * FROM project|sheet WHERE 'ProjectID'='project23')";
	$result_psheet = @mysqli_query($dbc, $sql_psheet);

	while($row_project = @mysqli_fetch_array($result_psheet)) {
		$sql_sheet = "SELECT * FROM sheet WHERE 'SheetID'='$row_project['SheetID']'";
		$result_sheet = @mysqli_query($dbc, $sql_sheet);

		while($row_sheet = @mysqli_fetch_array($result_sheet)) {
			if ($row_sheet['SheetType'] == 'ExternalBidSheet') {

				// echo '<div class="division">';
				// echo "<label><input type='checkbox' name='checkbox' value='division1'>$row_sheet['Name']</label>";
				// echo "</div>";
				//echo '<div class="division1 box">';
				//echo "</div>";
			}
		}
	}

// // do what alex did with the states except through the sheets.
// 	$sql_sheet="SELECT * FROM sheet WHERE 'ProjectID'='$sql_psheet')";
// 	$result_sheet = @mysqli_query($dbc, $sql_sheet);

// 	$row_psheet = @mysqli_fetch_array($result_psheet);
// 	$row_sheet = @mysqli_fetch_array($result_sheet);

// 	if($row_psheet['ProjectID'] === $row_company['CompanyID']) {

//	}
 ?>