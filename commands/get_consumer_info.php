<?php
include 'connectDB.php';
include 'auth.php';
	//$qry = $conn->query("SELECT f.*,u.balance,u.previous_read,u.previous_transaction from consumer_account f left join consumer_data u on f.consumer_id = u.consumer_id where f.id = ".$_GET['id']);
	$qry = $conn->query("SELECT f.*,u.balance,u.previous_read,u.previous_transaction from consumer_account f left join consumer_data u on f.consumer_id = u.consumer_id where f.id = ".$_GET['id']);
	
	if($qry){
	echo json_encode($qry->fetch_array());
	}
?>