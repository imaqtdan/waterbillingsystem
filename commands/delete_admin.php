<?php
include 'connectDB.php';
include 'auth.php';
extract($_POST);
	if ( $confirmdel != "CONFIRM" ) {
		echo json_encode(array('status'=>2,'msg'=>'Please enter CONFIRM to complete the deletion.'));
		exit;
	} else {
		$delete_admin = $conn->query('DELETE FROM admin_account where id ='.$id);
		if($delete_admin){
			$_SESSION['status'] = "Account has successfully deleted from database.";
			echo json_encode(array('status'=>1));
		} else {
			echo json_encode(array('status'=>2,'msg'=>'Error!'));
			exit;
		}	
	}
	
?>