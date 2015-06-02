<?php 

class file_upload {

    var $the_file;
	var $the_temp_file;
	var $validate_mime = true; 
    var $upload_dir;
	var $replace;
	var $do_filename_check;
	var $max_length_filename = 100;
    var $extensions;
    var $valid_mime_types = array('.bmp'=>'image/bmp', '.gif'=>'image/gif', '.jpg'=>'image/jpeg', '.jpeg'=>'image/jpeg', '.pdf'=>'application/pdf', '.png'=>'image/png', '.zip'=>'application/zip'); 
	var $ext_string;
	var $language;
	var $http_error;
	var $rename_file; // if this var is true the file copy get a new name
	var $file_copy; // the new name
	var $message = array();
	var $create_directory = true;
	var $fileperm = 0644;
	var $dirperm = 0755; 
	
	function file_upload() {
		$this->language = 'en'; 
		$this->rename_file = false;
		$this->ext_string = '';
	}
	function show_error_string($br = '<br />') {
		$msg_string = '';
		foreach ($this->message as $value) {
			$msg_string .= $value.$br;
		}
		return $msg_string;
	}
	function set_file_name($new_name = '') { // this 'conversion' is used for unique/new filenames 
		if ($this->rename_file) {
			if ($this->the_file == '') return;
			$name = ($new_name == '') ? strtotime('now') : $new_name;
			sleep(3);
			$name = $name.$this->get_extension($this->the_file);
		} else {
			$name = str_replace(' ', '_', $this->the_file); 
		}
		return $name;
	}
	
	function upload($to_name = '') {
		if ($this->http_error > 0) {
			$this->message[] = $this->error_text($this->http_error);
			return false;
		} else {
			$new_name = $this->set_file_name($to_name);
			if ($this->check_file_name($new_name)) {
				if ($this->validateExtension($this->the_temp_file)) {
					if (is_uploaded_file($this->the_temp_file)) {
						$this->file_copy = $new_name;
						if ($this->move_upload($this->the_temp_file, $this->file_copy)) {
							$this->message[] = $this->error_text(0);
							if ($this->rename_file) $this->message[] = $this->error_text(16);
							return true;
						}
					} else {
						$this->message[] = $this->error_text(7); // can't upload 
						return false;
					}
				} else {
					$this->show_extensions();
					$this->message[] = $this->error_text(11);
					return false;
				}
			} else {
				return false;
			}
		}
	}
	function check_file_name($the_name) {
		if ($the_name != '') {
			if (strlen($the_name) > $this->max_length_filename) {
				$this->message[] = $this->error_text(13);
				return false;
			} else {
				if ($this->do_filename_check == 'y') {
					if (preg_match('/^([a-z0-9_\-]*\.?)\.[a-z0-9]{1,5}$/i', $the_name)) { // v. 2.34 fixed the pattern
						return true;
					} else {
						$this->message[] = $this->error_text(12);
						return false;
					}
				} else {
					return true;
				}
			}
		} else {
			$this->message[] = $this->error_text(10);
			return false;
		}
	}
	function get_extension($from_file) {
		$ext = strtolower(strrchr($from_file,'.'));
		return $ext;
	}
	
	function validateMimeType($mime_type) {
		$ext = $this->get_extension($this->the_file);
		if ($mime_type == $this->valid_mime_types[$ext]) {
			return true;
		} else {
			// $this->message[] = $this->error_text(18);
			return false;
		}
	}
	
	function validateExtension() {
		$extension = $this->get_extension($this->the_file);
		$ext_array = $this->extensions;
		if (in_array($extension, $ext_array)) {
			if ($this->validate_mime) {
				if ($mime_type = $this->get_mime_type($this->the_temp_file)) {
					if ($this->validateMimeType($mime_type)) {
						return true;
					} else {
						return true;
					}
				} else {
					// $this->message[] = $this->error_text(18);
					return true;
				}
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
	
	// this method is only used for detailed error reporting
	function show_extensions() {
		$this->ext_string = implode(' ', $this->extensions);
	}
	
	function move_upload($tmp_file, $new_file) {
		if ($this->existing_file($new_file)) {
			$newfile = $this->upload_dir.$new_file;
			if ($this->check_dir($this->upload_dir)) {
				if (move_uploaded_file($tmp_file, $newfile)) {
					umask(0);
					chmod($newfile , $this->fileperm);
					return true;
				} else {
					$this->message[] = $this->error_text(7); 
					return false;
				}
			} else {
				$this->message[] = $this->error_text(14);
				return false;
			}
		} else {
			$this->message[] = $this->error_text(15);
			return false;
		}
	}
	
	function check_dir($directory) {
		if (!is_dir($directory)) {
			if ($this->create_directory) {
				umask(0);
				mkdir($directory, $this->dirperm);
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	function existing_file($file_name) {
		if ($this->replace == 'y') {
			return true;
		} else {
			if (file_exists($this->upload_dir.$file_name)) {
				return false;
			} else {
				return true;
			}
		}
	}
	
	function get_uploaded_file_info($name) {
		$str = 'File name: '.basename($name).PHP_EOL;
		$str .= 'File size: '.filesize($name).' bytes'.PHP_EOL;
		if ($mimetype = get_mime_type($name)) {
			$str .= 'Mime type: '.$mimetype.PHP_EOL;
		}
		if ($img_dim = getimagesize($name)) {
			$str .= 'Image dimensions: x = '.$img_dim[0].'px, y = '.$img_dim[1].'px'.PHP_EOL;
		}
		return $str;
	}
	
	function get_mime_type($file) {
		$mtype = false;
		if (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mtype = finfo_file($finfo, $file);
			finfo_close($finfo);
		} elseif (function_exists('mime_content_type')) {
			$mtype = mime_content_type($file);
		} 
		return $mtype;
	}
		
	function del_temp_file($file) {
		$delete = @unlink($file); 
		clearstatcache();
		if (@file_exists($file)) { 
			$filesys = eregi_replace('/','\\',$file); 
			$delete = @system('del $filesys');
			clearstatcache();
			if (@file_exists($file)) { 
				$delete = @chmod ($file, 0644); 
				$delete = @unlink($file); 
				$delete = @system('del $filesys');
			}
		}
	}
	
	function create_file_field($element, $label = '', $length = 25, $show_replace = true, $replace_label = 'Replace old file?', $file_path = '', $file_name = '', $show_alternate = false, $alt_length = 30, $alt_btn_label = 'Delete image') {
		$field = '';
		if ($label != '') $field = '
			<label>'.$label.'</label>';
		$field = '
			<input type="file" name="'.$element.'" size="'.$length.'" />';
		if ($show_replace) $field .= '
			<span>'.$replace_label.'</span>
			<input type="checkbox" name="replace" value="y" />';
		if ($file_name != '' && $show_alternate) {
			$field .= '
			<input type="text" name="'.$element.'" size="'.$alt_length.'" value="'.$file_name.'" readonly="readonly"';
			$field .= (!@file_exists($file_path.$file_name)) ? ' title="'.sprintf($this->error_text(17), $file_name).'" />' : ' />';
			$field .= '
			<input type="checkbox" name="del_img" value="y" />
			<span>'.$alt_btn_label.'</span>';
		} 
		return $field;
	}
	
	function error_text($err_num) {
		switch ($this->language) {
			
			default:
			// start http errors
			$error[0] = '<p class="success">File: '.$this->the_file.' successfully uploaded!</p>';
			$error[1] = '<p class="error">The uploaded file exceeds the max. upload filesize directive in the server configuration.</p>';
			$error[2] = '<p class="error">The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form.</p>';
			$error[3] = '<p class="error">The uploaded file was only partially uploaded</p>';
			$error[4] = '<p class="error">No file was uploaded</p>';
			$error[6] = '<p class="error">Missing a temporary folder.</p> ';
			$error[7] = '<p class="error">Failed to write file to disk. </p>';
			$error[8] = '<p class="error">A PHP extension stopped the file upload. </p>';
			// end  http errors
			$error[10] = '<p class="error">Please select a file for upload.</p>';
			$error[11] = '<p class="error">Only files with the following extensions are allowed: <b>'.$this->ext_string.'</b></p>';
			$error[12] = '<p class="error">Sorry, the filename contains invalid characters. Use only alphanumerical chars and separate parts of the name (if needed) with an underscore. <br>A valid filename ends with one dot followed by the extension.</p>';
			$error[13] = '<p class="error">The filename exceeds the maximum length of '.$this->max_length_filename.' characters.</p>';
			$error[14] = '<p class="error">Sorry, the upload directory does not exist!</p>';
			$error[15] = '<p class="error">Uploading '.$this->the_file.'...Error! Sorry, a file with this name already exitst.</p>';
			$error[16] = '<p class="success">The uploaded file is renamed to '.$this->file_copy.'</p>.';
			$error[17] = '<p class="error">The file %s does not exist.</p>';
			$error[18] = '<p class="error">The file type (MIME type) is not valid.</p>'; 
			$error[19] = '<p class="error">The MIME type check is enabled, but is not supported.</p>'; 
		}
		return $error[$err_num];
	}
}

