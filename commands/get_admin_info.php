<?php
include 'connectDB.php';
include 'auth.php';
	$qry = $conn->query("SELECT * FROM admin_account where id = ".$_GET['id']);
	if($qry){
	echo json_encode($qry->fetch_array());
	}
?>