<?php 
include 'connectDB.php';
include 'auth.php';
extract($_POST);
if (isset($_POST['submit2']) && isset($_FILES['profile'])) {

	echo "<pre>";
	print_r($_FILES['profile']);
	echo "</pre>";

	$img_name = $_FILES['profile']['name'];
	$img_size = $_FILES['profile']['size'];
	$tmp_name = $_FILES['profile']['tmp_name'];
	$error = $_FILES['profile']['error'];

	if ($error === 0) {
		if ($img_size > 125000) {
			$_SESSION['errstatus'] = "File is too large or Not an Image file.";
		    header("Location: ../adminprofile.php");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = 'profile'.$id2.'.'.$img_ex_lc;
				$img_upload_path = '../upload/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "UPDATE admin_account set image = '$new_img_name' where id = ".$id2;
				mysqli_query($conn, $sql);
				$_SESSION['status'] = "Profile Picture Successfully Updated.";
				header("Location: ../adminprofile.php");
			}else {
				$_SESSION['errstatus'] = "File is too large or Not an Image file.";
		        header("Location: ../adminprofile.php");
			}
		}
	}else {
		$_SESSION['errstatus'] = "No Image Attached.";
		header("Location: ../adminprofile.php");
	}

}else {
	header("Location: ../adminprofile.php");
}