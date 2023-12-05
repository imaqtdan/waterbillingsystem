<?php
include 'connectDB.php';
include 'auth.php';
$date = date('Y-m-d');

extract($_POST);
if(empty($id)){
	
	$data =  " first_name='".$firstname."'";
	$data .=  ", last_name='".$lastname."'";
	$data .=  ", username='".$username."'";
	$data .=  ", image='upload.png'";
	$data .=  ", password='".$password."'";
	$data .=  ", address='".$address."'";
	$data .=  ", email='".$email."'";
	$data .=  ", contact='".$contact."'";
	$data .=  ", user_level='".$user_level."'";
	
	$chk3 = $conn->query("SELECT * FROM admin_account where email = '".$email."' ")->num_rows;
		if($chk3 > 0){
			echo json_encode(array('status'=>2,'msg'=>'Email address already exist'));
			exit;
		}
	$chk = $conn->query("SELECT * FROM admin_account where username = '".$username."' ")->num_rows;
		if($chk > 0){
			echo json_encode(array('status'=>2,'msg'=>'Username already exist'));
			exit;
		}
	$insert_user = $conn->query('INSERT INTO admin_account set  '.$data);
	$_SESSION['status'] = "Successfully created new account.";
	echo json_encode(array('status'=>1));
} else {
	
	$data =  " first_name='".$firstname."'";
	$data .=  ", last_name='".$lastname."'";
	$data .=  ", username='".$username."'";
	$data .=  ", password='".$password."'";
	$data .=  ", address='".$address."'";
	$data .=  ", email='".$email."'";
	$data .=  ", contact='".$contact."'";
	$data .=  ", user_level='".$user_level."'";
	
	$chk3 = $conn->query("SELECT * FROM admin_account where email = '".$email."' and id != '".$id."' ")->num_rows;
	if($chk3 > 0){
			echo json_encode(array('status'=>2,'msg'=>'Email address already exist'));
			exit;
	}
	$chk = $conn->query("SELECT * FROM admin_account where username = '".$username."' and id != '".$id."' ")->num_rows;
	if($chk > 0){
			echo json_encode(array('status'=>2,'msg'=>'Username already exist'));
			exit;
	}
	$update_user = $conn->query('UPDATE admin_account set  '.$data.' where id ='.$id);
	$_SESSION['status'] = "Successfully updated account.";
	echo json_encode(array('status'=>1));
}
?>