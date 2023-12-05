<?php 
if (isset($_POST['submit']) && isset($_FILES['imglogo'])) {
	include 'connectDB.php';
	include 'auth.php';

	echo "<pre>";
	print_r($_FILES['imglogo']);
	echo "</pre>";

	$img_name = $_FILES['imglogo']['name'];
	$img_size = $_FILES['imglogo']['size'];
	$tmp_name = $_FILES['imglogo']['tmp_name'];
	$error = $_FILES['imglogo']['error'];

	if ($error === 0) {
		if ($img_size > 125000) {
			$_SESSION['errstatus'] = "File is too large or Not an Image file.";
		    header("Location: ../system.php");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = 'logo'.'.'.$img_ex_lc;
				$img_upload_path = '../upload/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "UPDATE system_config set company_logo = '$new_img_name' where id = 1";
				mysqli_query($conn, $sql);
				$_SESSION['status'] = "System Logo Successfully Updated.";
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