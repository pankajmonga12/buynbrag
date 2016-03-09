<?php $action = $_GET['action'];
	$baseurl = base_url();
	switch ($action) {
		case 'upload':
			$upload_name = "file";
			$max_file_size_in_bytes = 1024 * 1024;
			$extension_whitelist = array("jpg", "gif", "png"); /* checking extensions */
			$path_info = pathinfo($_FILES[$upload_name]['name']);
			$file_extension = $path_info["extension"];
			$is_valid_extension = false;
			foreach ($extension_whitelist as $extension) {
				if (strcasecmp($file_extension, $extension) == 0) {
					$is_valid_extension = true;
					break;
				}
			}
			if (!$is_valid_extension) {
				echo "{";
				echo "error: 'Extension not valid'\n";
				echo "}";
				exit(0);
			} /* file size check */
			$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
			if (!$file_size || $file_size > $max_file_size_in_bytes) {
				echo "{";
				echo "error: 'File Exceeds maximum limit'\n";
				echo "}";
				exit(0);
			}
			if (isset($_FILES[$upload_name])) if ($_FILES[$upload_name]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br/>";
			} else {
				$userfile = stripslashes($_FILES[$upload_name]['name']);
				$file_size = $_FILES[$upload_name]['size'];
				$file_temp = $_FILES[$upload_name]['tmp_name'];
				$file_type = $_FILES[$upload_name]["type"];
				$file_err = $_FILES[$upload_name]['error'];
				$file_name = $userfile;
				if (move_uploaded_file($file_temp, "uploads/" . $file_name)) {
					echo "{";
					echo "msg: '" . $file_name . "'\n";
					echo "}";
				}
			}
			break;
		case 'upload2':
			$upload_name = "file";
			$max_file_size_in_bytes = 1024 * 1024;
			$extension_whitelist = array("jpg", "gif", "png"); /* checking extensions */
			$path_info = pathinfo($_FILES[$upload_name]['name']);
			$file_extension = $path_info["extension"];
			$is_valid_extension = false;
			foreach ($extension_whitelist as $extension) {
				if (strcasecmp($file_extension, $extension) == 0) {
					$is_valid_extension = true;
					break;
				}
			}
			if (!$is_valid_extension) {
				echo "{";
				echo "error: 'Extension not valid'\n";
				echo "}";
				exit(0);
			} /* file size check */
			$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
			if (!$file_size || $file_size > $max_file_size_in_bytes) {
				echo "{";
				echo "error: 'File Exceeds maximum limit'\n";
				echo "}";
				exit(0);
			}
			if (isset($_FILES[$upload_name])) if ($_FILES[$upload_name]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br/>";
			} else {
				$userfile = stripslashes($_FILES[$upload_name]['name']);
				$file_size = $_FILES[$upload_name]['size'];
				$file_temp = $_FILES[$upload_name]['tmp_name'];
				$file_type = $_FILES[$upload_name]["type"];
				$file_err = $_FILES[$upload_name]['error'];
				$file_name = $userfile;
				if (move_uploaded_file($file_temp, "uploads/" . $file_name)) {
					echo "{";
					echo "msg: '" . $file_name . "'\n";
					echo "}";
				}
			}
			break;
		case 'upload3':
			$upload_name = "file";
			$max_file_size_in_bytes = 1024 * 1024;
			$extension_whitelist = array("jpg", "gif", "png"); /* checking extensions */
			$path_info = pathinfo($_FILES[$upload_name]['name']);
			$file_extension = $path_info["extension"];
			$is_valid_extension = false;
			foreach ($extension_whitelist as $extension) {
				if (strcasecmp($file_extension, $extension) == 0) {
					$is_valid_extension = true;
					break;
				}
			}
			if (!$is_valid_extension) {
				echo "{";
				echo "error: 'Extension not valid'\n";
				echo "}";
				exit(0);
			} /* file size check */
			$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
			if (!$file_size || $file_size > $max_file_size_in_bytes) {
				echo "{";
				echo "error: 'File Exceeds maximum limit'\n";
				echo "}";
				exit(0);
			}
			if (isset($_FILES[$upload_name])) if ($_FILES[$upload_name]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br/>";
			} else {
				$userfile = stripslashes($_FILES[$upload_name]['name']);
				$file_size = $_FILES[$upload_name]['size'];
				$file_temp = $_FILES[$upload_name]['tmp_name'];
				$file_type = $_FILES[$upload_name]["type"];
				$file_err = $_FILES[$upload_name]['error'];
				$file_name = $userfile;
				if (move_uploaded_file($file_temp, "uploads/" . $file_name)) {
					echo "{";
					echo "msg: '" . $file_name . "'\n";
					echo "}";
				}
			}
			break;
		case 'upload4':
			$upload_name = "file";
			$max_file_size_in_bytes = 1024 * 1024;
			$extension_whitelist = array("jpg", "gif", "png"); /* checking extensions */
			$path_info = pathinfo($_FILES[$upload_name]['name']);
			$file_extension = $path_info["extension"];
			$is_valid_extension = false;
			foreach ($extension_whitelist as $extension) {
				if (strcasecmp($file_extension, $extension) == 0) {
					$is_valid_extension = true;
					break;
				}
			}
			if (!$is_valid_extension) {
				echo "{";
				echo "error: 'Extension not valid'\n";
				echo "}";
				exit(0);
			} /* file size check */
			$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
			if (!$file_size || $file_size > $max_file_size_in_bytes) {
				echo "{";
				echo "error: 'File Exceeds maximum limit'\n";
				echo "}";
				exit(0);
			}
			if (isset($_FILES[$upload_name])) if ($_FILES[$upload_name]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br/>";
			} else {
				$userfile = stripslashes($_FILES[$upload_name]['name']);
				$file_size = $_FILES[$upload_name]['size'];
				$file_temp = $_FILES[$upload_name]['tmp_name'];
				$file_type = $_FILES[$upload_name]["type"];
				$file_err = $_FILES[$upload_name]['error'];
				$file_name = $userfile;
				if (move_uploaded_file($file_temp, "uploads/" . $file_name)) {
					echo "{";
					echo "msg: '" . $file_name . "'\n";
					echo "}";
				}
			}
			break;
		case 'upload5':
			$upload_name = "file";
			$max_file_size_in_bytes = 1024 * 1024;
			$extension_whitelist = array("jpg", "gif", "png"); /* checking extensions */
			$path_info = pathinfo($_FILES[$upload_name]['name']);
			$file_extension = $path_info["extension"];
			$is_valid_extension = false;
			foreach ($extension_whitelist as $extension) {
				if (strcasecmp($file_extension, $extension) == 0) {
					$is_valid_extension = true;
					break;
				}
			}
			if (!$is_valid_extension) {
				echo "{";
				echo "error: 'Extension not valid'\n";
				echo "}";
				exit(0);
			} /* file size check */
			$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
			if (!$file_size || $file_size > $max_file_size_in_bytes) {
				echo "{";
				echo "error: 'File Exceeds maximum limit'\n";
				echo "}";
				exit(0);
			}
			if (isset($_FILES[$upload_name])) if ($_FILES[$upload_name]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br/>";
			} else {
				$userfile = stripslashes($_FILES[$upload_name]['name']);
				$file_size = $_FILES[$upload_name]['size'];
				$file_temp = $_FILES[$upload_name]['tmp_name'];
				$file_type = $_FILES[$upload_name]["type"];
				$file_err = $_FILES[$upload_name]['error'];
				$file_name = $userfile;
				if (move_uploaded_file($file_temp, "uploads/" . $file_name)) {
					echo "{";
					echo "msg: '" . $file_name . "'\n";
					echo "}";
				}
			}
			break;
		case 'upload7':
			$upload_name = "file";
			$max_file_size_in_bytes = 1024 * 1024;
			$extension_whitelist = array("jpg", "gif", "png");
			$rand_num_id = stripslashes($_REQUEST['rand_num_id']); /* checking extensions */
			$path_info = pathinfo($_FILES[$upload_name]['name']);
			$file_extension = $path_info["extension"];
			$is_valid_extension = false;
			foreach ($extension_whitelist as $extension) {
				if (strcasecmp($file_extension, $extension) == 0) {
					$is_valid_extension = true;
					break;
				}
			}
			if (!$is_valid_extension) {
				echo "{";
				echo "error: 'Extension not valid'\n";
				echo "}";
				exit(0);
			} /* file size check */
			$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
			if (!$file_size || $file_size > $max_file_size_in_bytes) {
				echo "{";
				echo "error: 'File Exceeds maximum limit'\n";
				echo "}";
				exit(0);
			}
			if (isset($_FILES[$upload_name])) if ($_FILES[$upload_name]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br/>";
			} else {
				$userfile = stripslashes($_FILES[$upload_name]['name']);
				$file_size = $_FILES[$upload_name]['size'];
				$file_temp = $_FILES[$upload_name]['tmp_name'];
				$file_type = $_FILES[$upload_name]["type"];
				$file_err = $_FILES[$upload_name]['error'];
				$file_name = $userfile;
				if (move_uploaded_file($file_temp, "assets/uploads/" . $rand_num_id . "_" . $file_name)) { //$msg="{"; $msg=$baseurl."assets/uploads/".$rand_num_id."_".$file_name; //$msg.="}"; } } $status = ""; echo json_encode(array('status' => $status, 'msg' => $msg)); break; case 'crop': if ($_SERVER['REQUEST_METHOD'] == 'POST') { $jpeg_quality = 90; $src = $baseurl.'assets/uploads/products/'.$_POST['fname']; $img_r = imagecreatefromjpeg($src); if($_POST['fixed'] == 0) { $targ_w = $_POST['w']; $targ_h = $_POST['h']; } else { $targ_w = $targ_h = $_POST['size']; } $dst_r = ImageCreateTrueColor( $targ_w, $targ_h ); imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'], $targ_w,$targ_h,$_POST['w'],$_POST['h']); imagejpeg($dst_r,"./assets/uploads/products/crop.jpg",$jpeg_quality); unlink('./assets/uploads/products/'.$_POST['fname']); echo 1; } break; }