<?php
include 'connectDB.php';
include 'auth.php';
extract($_POST);
$date = date('Y-m-d');
$log = $_SESSION['login_id'];

	$getac = $conn->query("SELECT * FROM consumer_data where consumer_id = ".$_GET['id']);
	$adrow = $getac->fetch_assoc();
		if ( $adrow['cstatus'] == 1 ) {
			$changecstatus =$conn->query("UPDATE consumer_data set cstatus = 0 where consumer_id = ".$_GET['id']);
			$addlogs = $conn->query("INSERT INTO logs SET consumer_id = '".$_GET['id']."', note = 'Consumer Set Active by User ID $log', date = '$date'");
			$_SESSION['status'] = "Successfully updated to active.";
		} else {
			$changecstatus =$conn->query("UPDATE consumer_data set cstatus = 1 where consumer_id = ".$_GET['id']);
			$addlogs = $conn->query("INSERT INTO logs SET consumer_id = '".$_GET['id']."', note = 'Consumer Set Disconnected by User ID $log', date = '$date'");
			$_SESSION['status'] = "Successfully updated to disconnected.";
		}
			if($changecstatus){
				echo json_encode(array('status'=>1));
			}
	
																	
	
		
?>