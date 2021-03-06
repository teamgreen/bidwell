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


<?php 
//////////////////////////////////////
// Project Page Tab 2 Uploader Demo PHP
// Authored by Tim Willbanks
// Purpose: To provide a page where
// 			the user can access project
// 			information, project descriptions 
//			and create/edit Internal/External
//			Bid sheets as well as Change Bids
//			for projects.
//
//			
// Project Page Tab 2 Uploader Demo PHP 
// Created: by Tim Willbanks on 5/26 
// Updated: by Adam Duthie on 6/1 @ 9:30PM
//////////////////////////////////////// 
require_once 'includes/upload_class.inc.php'; 
$folder = $_SERVER['DOCUMENT_ROOT']."/files/";
error_reporting(E_ALL);
function select_files($dir) {
	
	$teller = 0;
	if ($handle = opendir($dir)) {
		$mydir = "<p>Uploaded Files:</p>\n";
		$mydir .= "<form name=\"form1\" method=\"post\" action=\"#\">\n";
		$mydir .= "  <select id=\"file_dl_list\" name=\"file_in_folder\">\n";
		$mydir .= "    <option value=\"\" selected>...\n";
		while (false !== ($file = readdir($handle))) {
			$files[] = $file;
		}
		closedir($handle); 
		sort($files);
		foreach ($files as $val) {
			if (is_file($dir.$val)) { 
				$mydir .= "    <option value=\"".$val."\">";
				$mydir .= (strlen($val) > 30) ? substr($val, 0, 30)."...\n" : $val."\n";
				$teller++;	
			}
		}
		$dl_folder = $_SERVER['DOCUMENT_ROOT']."/files/";
		$mydir .= "  </select>";
		$mydir .= "<a id=\"dllink\" href=\"#\" download=\"#\">Download</a>\n";
		//$mydir .= "<input type=\"button\" id=\"filedownload\" data-folder=\"$dl_folder\" name=\"download\" value=\"Download\">";
		$mydir .= "</form>\n";
	}
	if ($teller == 0) {
		echo "No files!";
	} else { 
		echo $mydir;
	}
}

function del_file($file) {
	$delete = @unlink($file); 
	clearstatcache();
	if (@file_exists($file)) { 
		$filesys = @preg_replace("/","//",$file); 
		$delete = @system("del $filesys");
		clearstatcache();
		if (@file_exists($file)) { 
			$delete = @chmod ($file, 0775); 
			$delete = @unlink($file); 
			$delete = @system("del $filesys");
		}
	}
}
function get_oldest_file($directory) {
	if ($handle = opendir($directory)) {
		while (false !== ($file = readdir($handle))) {
			if (is_file($directory.$file)) { 
				$files[] = $file;
			}
		}
		if (count($files) <= 12) {
			return;
		} else {
			foreach ($files as $val) {
				if (is_file($directory.$val)) {
					$file_date[$val] = filemtime($directory.$val);
				}
			}
		}
	}
	closedir($handle);
	asort($file_date, SORT_NUMERIC);
	reset($file_date);
	$oldest = key($file_date);
	return $oldest;
}

$max_size = 1024*1000; // the max. size for uploading
$my_upload = new file_upload;

$my_upload->upload_dir = $_SERVER['DOCUMENT_ROOT']."/files/"; // "files" is the folder for the uploaded files (you have to create this folder)
$my_upload->extensions = array(".png", ".zip", ".pdf", ".gif", ".bmp", ".jpg", ".jpeg", ".svg", ".dwg", ".doc", ".docx"); // specify the allowed extensions here

		
if(isset($_POST['Submit'])) {
	$my_upload->the_temp_file = $_FILES['upload']['tmp_name'];
	$my_upload->the_file = $_FILES['upload']['name'];
	$my_upload->http_error = $_FILES['upload']['error'];
	$my_upload->replace = (isset($_POST['replace'])) ? $_POST['replace'] : "n";
	$my_upload->do_filename_check = (isset($_POST['check'])) ? $_POST['check'] : "n"; 
	if ($my_upload->upload()) {
		$latest = get_oldest_file($folder);
		del_file($folder.$latest);
	}
}
		
?> 


<div class="description-cont1">
	<!-- <div class=".description-left"> -->
	

	<!-- This php code I commented out to try and get the textarea working on the project-tab2.inc file and it seems to be working. Going to have Frank
	   look it over when he gets a chance. -->
	
	
	<!-- Added Form Section, Added on 6/8/2015 by Adam Duthie -->
	
		
			<?php $project->getSheetsByType($dbc, Sheet::eProjectDescriptionSheet);
				// echo '<textarea class="project-tab2-textarea" id="project_description" name="project_description" rows="25" cols="15" maxlength="4000" >';
				while($row = $project->returnSheetRow()){
				
				$sheet = new ProjectDescriptionSheet($projectid);
				$sheet->loadSheetFromResult($dbc, $row);
			    $sheet->generateLinesTableHTML($dbc);
				
				} 
				// echo '</textarea>	';
			?>
		
	
	
	<!-- </div> -->
</div>	

<div class="description-cont2">
	<!-- <div id="main"> -->
  <p class="left">Upload Files:</p>
  <p class="center">(File upload/download and show directory)</p>
  <p class=left>Max. filesize: <b><?php echo $max_size/1024; ?> KB</b></p>
  <?php 
  $ext = "<p class='left'>Allowed extensions are:</p><pre class='left'>(";
  foreach ($my_upload->extensions as $val) {
	  $ext .=  ltrim($val, ".").", ";
  } 
  echo rtrim($ext, ", ").")</pre>";
  ?>


  
  
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1">
	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_size; ?>">
	<p class="center"><input type="file" name="upload" id="upload" size="25"></p>
	<p class="left"><label class="checkbox_label" for="replace">Replace file?</label>
	<input type="checkbox" name="replace" id="replace" value="y"></p>
	<!-- <label for="check">Validate filename ?</label>
	<input name="check" type="checkbox" id="check" value="y" checked> -->

	<p><input type="submit" name="Submit" id="Submit" value="Submit"></p>
  </form>
  <!--<script type="text/javascript">
 //      $(form).submit(function(event) {
 //    // Stop the browser from submitting the form.
	//    		event.preventDefault();

	//     // TODO

	//     	$.ajax({
	//             url : project.php,
	//             type : 'POST',
	//             data : {
	//             file: file_uploaded,
	//             },
	            
	//           });
	// 	});
          

          

 //  //     $('#submit').click(function()
	// 	// {
	// 	//     $.ajax({
	// 	//         url: send_email.php,
	// 	//         type:'POST',
	// 	//         data:
	// 	//         {
	// 	//             email: email_address,
	// 	//             message: message
	// 	//         },
	// 	//         success: function(msg)
	// 	//         {
	// 	//             alert('Email Sent');
	// 	//         }               
	// 	//     });
	// 	// });
	//</s cript> -->
  
  <p><?php echo $my_upload->show_error_string(); ?></p>
  <?php echo select_files($folder); ?>
  <!-- 
</div>  
 --></div>

<button name="save-changes" value="save-changes" type="button">Save Changes</button>
<button name="print" value="print" type="button">Print</button>

