<?php 
	include '../commands/connectDB.php';
	session_start();
	extract($_POST);
	$type = '';
	$qry = $conn->query("SELECT * FROM admin_account where username='$username' and BINARY password = BINARY '$password' $type ");
	if($qry->num_rows > 0){
		foreach($qry->fetch_array() as $k => $val){
			if($k != 'password')
			$_SESSION['login_'.$k] = $val;
		}
		echo 1;
	}else{
		echo 2;
	}
?>