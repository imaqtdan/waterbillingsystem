<?php 
if (isset($_POST['submit']) && isset($_FILES['imgslogo'])) {
	include 'connectDB.php';
	include 'auth.php';

	echo "<pre>";
	print_r($_FILES['imgslogo']);
	echo "</pre>";

	$img_name = $_FILES['imgslogo']['name'];
	$img_size = $_FILES['imgslogo']['size'];
	$tmp_name = $_FILES['imgslogo']['tmp_name'];
	$error = $_FILES['imgslogo']['error'];

	if ($error === 0) {
		if ($img_size > 125000) {
			//$em = "Sorry, your file is too large.";
			$_SESSION['errstatus'] = "File is too large or Not an Image file.";
		    header("Location: ../system.php");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = 'slogo'.'.'.$img_ex_lc;
				$img_upload_path = '../upload/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "UPDATE system_config set company_slogo = '$new_img_name' where id = 1";
				mysqli_query($conn, $sql);
				$_SESSION['status'] = "System Logo ( Minimized ) Successfully Updated.";
				header("Location: ../system.php");
			}else {
				$_SESSION['errstatus'] = "File is too large or Not an Image file.";
		        header("Location: ../system.php");
			}
		}
	}else {
		$_SESSION['errstatus'] = "No Image Attached.";
		header("Location: ../system.php");
	}

}else {
	header("Location: ../system.php");
}