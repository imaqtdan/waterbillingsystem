<?php
include 'connectDB.php';
include 'auth.php';

extract($_POST);

	$condata = $conn->query("SELECT * FROM consumer_data where consumer_id = ".$consumerid);
	$conrow = $condata->fetch_assoc();

	$date = date('Y-m-d');
	$oldbal = $conrow['balance'];
	$log = $_SESSION['login_id'];
	
	if ( $ptotal > $pment ) {
		$newbalance = $ptotal - $pment;
		$data =  " balance='$oldbal'"; // old balance where consumer id
		$data .=  ", billing_status='1'";
		$data .=  ", total_pay='$pment'";
		$data .=  ", balance2='$newbalance'"; // update to consumer data
		$data .=  ", pchange='0'";
		$data .=  ", date_processed='$date'";
		$data .=  ", client_processed='$log'";
		$update_billings = $conn->query("UPDATE billings set ".$data." where id = ".$id);
			if ($update_billings) {
				$update_data = $conn->query("UPDATE consumer_data set balance = '$newbalance' where consumer_id = ".$consumerid);
				$_SESSION['status'] = "Invoice are now Incomplete Paid.";
				echo json_encode(array('status'=>1));
			}
	}
	if ( $pment >= $ptotal ) {
		$change = $pment - $ptotal;
		$data =  " balance='$oldbal'"; // old balance where consumer id
		$data .=  ", billing_status='2'";
		$data .=  ", total_pay='$pment'";
		$data .=  ", balance2='0'"; // update to consumer data
		$data .=  ", pchange='$change'";
		$data .=  ", date_processed='$date'";
		$data .=  ", client_processed='$log'";
		$update_billings = $conn->query("UPDATE billings set ".$data." where id = ".$id);
			if ($update_billings) {
				$update_data = $conn->query("UPDATE consumer_data set balance = 0 where consumer_id = ".$consumerid);
				$_SESSION['status'] = "Invoice are now Completely Paid.";
				echo json_encode(array('status'=>1));
			}
	}
	
?>