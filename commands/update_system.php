<?php
include 'connectDB.php';
include 'auth.php';

extract($_POST);

if ($secret_key == '1') {
	$data =  " system_name='$sysname'";
	$data .=  ", address='$address'";
	$data .=  ", brg_address='$brg_address'";
	$data .=  ", ct_address='$ct_address'";
	$data .=  ", pro_address='$pro_address'";
	$data .=  ", contact='$contact'";
	
	if ( $sysname == " " || $address == " " || $brg_address == " " || $ct_address == " " || $pro_address == " " || $contact == " " ) {
		$_SESSION['errstatus'] = "Please dont save with space only.";
		echo json_encode(array('status'=>2));
		exit;
	}
	$update_system = $conn->query("UPDATE system_config set ".$data." where id = 1");
		if($update_system){
			$_SESSION['status'] = "System information has successfully updated.";
			echo json_encode(array('status'=>1));
		} else {
			$_SESSION['errstatus'] = "Somethings Wrong.";
			echo json_encode(array('status'=>2));
		}
} else {
	$data =  " mincon='$mincon'";
	$data .=  ", mincon_price='$mincon_price'";
	$data .=  ", excd_price='$excd_price'";
	$data .=  ", reconfee='$reconfee'";
	$data .=  ", penalty_percent='$penalty_percent'";
	$data .=  ", due_settings='$due_settings'";
	$data .=  ", due_settings2='$due_settings2'";
	$data .=  ", dis_settings='$dis_settings'";
	$data .=  ", dis_settings2='$dis_settings2'";
	
	if ( $mincon == " " || $mincon_price == " " || $excd_price == " " || $reconfee == " " || $penalty_percent == " " ) {
		$_SESSION['errstatus'] = "Please dont save with space only.";
		echo json_encode(array('status'=>2));
		exit;
	}
	$update_system = $conn->query("UPDATE system_config set ".$data." where id = 1");
		if($update_system){
			$_SESSION['status'] = "System information has successfully updated.";
			echo json_encode(array('status'=>1));
		} else {
			$_SESSION['errstatus'] = "Somethings Wrong.";
			echo json_encode(array('status'=>2));
		}	
}


	
	
	
	
?>