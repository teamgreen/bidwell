<?php
if (isset($_GET['file_to_download'])) {
	$fullPath = $_GET['dl_folder'].$_GET['file_to_download'];
	if(!$fullPath){ // file does not exist
    	die('file not found');
	} else {
		echo $fullPath;
		if ($fd = fopen ($fullPath, "rb")) {
			$fsize = filesize($fullPath);
			$path_parts = pathinfo($fullPath); 
			$ext = strtolower($path_parts["extension"]);

echo " CASE = ". $ext . " ++++++++++++++++++++";
			switch ($ext) {
				case "png":
				case "bmp":
				case "gif":
				case "jpg":
				case "jpeg":
echo " CASE = pic ++++++++".$path_parts["basename"]."++++++++++++";
				header("Content-type: image/".$ext.""); 
				header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
				break;
				case "pdf":
echo " CASE = pdf ++++++++".$path_parts["basename"]."++++++++++++";
				header("Content-type: application/pdf");
				header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); 
				break;
				case "svg":
echo " CASE = svg ++++++++".$path_parts["basename"]."++++++++++++";
				header("Content-type: application/svg");
				header("Content-Disposition: attachment;filename=\"".$path_parts["basename"]."\""); 
				break;
				case "dwg":
echo " CASE = dwg ++++++++".$path_parts["basename"]."++++++++++++";
				header("Content-type: application/dwg");
				header("Content-Disposition: attachment; attachment; filename=\"".$path_parts["basename"]."\""); 
				break;
				case "zip":
echo " CASE = zip ++++++++".$path_parts["basename"]."++++++++++++";
				header("Content-type: application/zip"); 
				header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
				break;
				case "doc":
echo " CASE = doc ++++++++".$path_parts["basename"]."++++++++++++";
				header("Content-type: application/doc");
				header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
				break;
				case "docx":
echo " CASE = docx +++++++".$path_parts["basename"]."+++++++++++++";
				header("Content-type: application/docx");
				header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
				break;
				default;
echo " CASE = default ++++++".$path_parts["basename"]."++++++++++++++";
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
				break;
			}
			//header("Content-length: $fsize");
			header("Cache-control: private");
			//header("Cache-Control: public");
		    header("Content-Description: File Transfer");
		    header("Content-Transfer-Encoding: binary");

			// read the file from disk
			readfile($fullPath);

			// while(!feof($fd)) {
			// 	$buffer = fread($fd, 2048);
			// 	echo $buffer;
			// }
		}
	}
	fclose ($fd);
	//exit;
}
?>
