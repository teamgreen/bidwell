<!-- //////////////////////////////////////
// Project Page Tab 2 Include Page
// Authored by Adam Duthie
// Purpose: To provide a page where
// 			the user can access project
// 			information, project descriptions 
//			and create/edit Internal/External
//			Bid sheets as well as Change Bids
//			for projects.
//
//			
// Project Page Tab 2 Include Page 
// Created: by Adam Duthie on 5/26 @ 2PM 
// Updated: by Adam Duthie on 5/31 @ 8PM
//////////////////////////////////////// -->

<div class="description-cont">
	<?php
	$project->getSheetsByType($dbc, Sheet::eProjectDescriptionSheet);

	while($row = $project->returnSheetRow()){
		echo "<div>\n";
		$sheet = new ProjectDescriptionSheet();
		$sheet->loadSheetFromResult($dbc, $row);
		$sheet->generateLinesTableHTML($dbc);
		echo "</div>\n";
	}

	?>
</div>

<div class="description-cont">
	<p class="description-right-title">Files Uploaded:</p>
	<p class="description-right">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida ut purus id ullamcorper. Praesent fringilla eros tortor, nec mollis nunc cursus eget. Vivamus odio leo, lacinia id faucibus id, viverra sed nunc. Aenean id posuere orci. Duis vehicula laoreet nulla ac rutrum. Ut consectetur elit in risus aliquam, vel iaculis justo commodo. Sed imperdiet malesuada libero, ac consequat orci lacinia sed.</p>
</div>

<button name="upload" value="upload" type="button">Upload</button>
<button name="save-changes" value="save-changes" type="button">Save Changes</button>
<button name="print" value="print" type="button">Print</button>
