<?php
include 'connectDB.php';
include 'auth.php';
extract($_POST);
	if ( $confirmdel != "CONFIRM" ) {
		echo json_encode(array('status'=>2,'msg'=>'Please enter CONFIRM to complete the deletion.'));
		exit;
	} else {
		$delete_consumer_info = $conn->query('DELETE FROM consumer_account where consumer_id ='.$consumerid);
		$delete_consumer_data = $conn->query('DELETE FROM consumer_data where consumer_id ='.$consumerid);
		if($delete_consumer_info && $delete_consumer_data){
			$delete_pendingbill = $conn->query('DELETE FROM billings where billing_status = 0 AND consumer_id ='.$consumerid);
			$_SESSION['status'] = "Consumer successfully deleted from database.";
			echo json_encode(array('status'=>1));
		} else {
			echo json_encode(array('status'=>2,'msg'=>'Error!'));
			exit;
		}	
	}
	
?>