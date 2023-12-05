<?php
include 'connectDB.php';
include 'auth.php';
require "../vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

extract($_POST);

if(empty($id)){
	
	$data =  " consumer_id='0'";
	$data .=  ", first_name='".$firstname."'";
	$data .=  ", last_name='".$lastname."'";
	$data .=  ", username='".$username."'";
	$data .=  ", password='".$password."'";
	$data .=  ", address='".$address."'";
	$data .=  ", brg_address='".$brg_address."'";
	$data .=  ", ct_address='".$ct_address."'";
	$data .=  ", pro_address='".$pro_address."'";
	$data .=  ", email='".$emailaddress."'";
	$data .=  ", contact='".$contact."'";
	$date = date('Y-m-d');
	
	$chk3 = $conn->query("SELECT * FROM consumer_account where email = '".$emailaddress."' ")->num_rows;
		if($chk3 > 0){
			echo json_encode(array('status'=>2,'msg'=>'Email address already exist'));
			exit;
		}
	$chk = $conn->query("SELECT * FROM consumer_account where username = '".$username."' ")->num_rows;
		if($chk > 0){
			echo json_encode(array('status'=>2,'msg'=>'Username already exist'));
			exit;
		}
	$insert_user = $conn->query('INSERT INTO consumer_account set  '.$data);

	if ($insert_user) {
		// GET LAST ID - START
		$latestid = $conn->query("SELECT * FROM consumer_account ORDER BY id DESC LIMIT 0, 1");
		$latestidrow = $latestid->fetch_assoc();
		$lid = $latestidrow['id'];
		$lid2 = 2000000 + $lid;
	
		$update_consumer_account = $conn->query("UPDATE consumer_account SET consumer_id = '$lid2' WHERE id = '$lid'");
		$insert_data = $conn->query("INSERT INTO consumer_data (consumer_id, balance, previous_read, previous_transaction, cstatus, create_date) VALUES ('$lid2','0','0','$date','0','$date')");
	
		if ($insert_data) {

			// Generating QR Code START
			$qr_code = QrCode::create($lid2)
				->setSize(600)
				->setMargin(40)
				//->setForegroundColor(new Color(255, 128, 0))
				//->setBackgroundColor(new Color(153, 204, 255))
				->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);
			$writer = new PngWriter;
			$filePath = '../qrcodes/' . $lid2 . '.png';
			$result = $writer->write($qr_code);
			$result->saveToFile($filePath);
			// Generating QR Code END

			$_SESSION['status'] = "Successfully added to the database.";
			echo json_encode(array('status' => 1));
		}
	}
} else {
	
	//$data =  " consumer_id='".$consumerid."'";
	$data =  " first_name='".$firstname."'";
	$data .=  ", last_name='".$lastname."'";
	$data .=  ", username='".$username."'";
	$data .=  ", password='".$password."'";
	$data .=  ", address='".$address."'";
	$data .=  ", brg_address='".$brg_address."'";
	$data .=  ", ct_address='".$ct_address."'";
	$data .=  ", pro_address='".$pro_address."'";
	$data .=  ", email='".$emailaddress."'";
	$data .=  ", contact='".$contact."'";
	
	$chk3 = $conn->query("SELECT * FROM consumer_account where email = '".$emailaddress."' and consumer_id != '".$consumerid."' ")->num_rows;
	if($chk3 > 0){
			echo json_encode(array('status'=>2,'msg'=>'Email address already exist'));
			exit;
	}
	$chk = $conn->query("SELECT * FROM consumer_account where username = '".$username."' and consumer_id != '".$consumerid."' ")->num_rows;
	if($chk > 0){
			echo json_encode(array('status'=>2,'msg'=>'Username already exist'));
			exit;
	}
	$update_user = $conn->query('UPDATE consumer_account set  '.$data.' where consumer_id ='.$consumerid);
	
	if($update_user){
		$update_data =$conn->query("UPDATE consumer_data set balance = '".$balance."', previous_read = '".$tconsumed."' where consumer_id = '".$consumerid."'");
		if($update_data){
			
			$aqry = $conn->query("SELECT * FROM billings where consumer_id = '".$consumerid."' and present_readdate = (SELECT MAX(present_readdate) FROM billings WHERE consumer_id = '".$consumerid."' and billing_status = 0)");
			if($aqry->num_rows > 0) {
			$arow = $aqry->fetch_assoc();
			$prevread = $arow['previous_read'];
			$totz = $tconsumed - $prevread;
			$update_bill2 = $conn->query("UPDATE billings inner join ( SELECT max(present_readdate) as date from billings where consumer_id = '".$consumerid."') mx on billings.present_readdate = mx.date set present_read = '".$tconsumed."', total_consumed = '".$totz."' WHERE consumer_id = '".$consumerid."' and billing_status = 0");
			}

			$_SESSION['status'] = "Consumer information successfully updated.";
			echo json_encode(array('status'=>1));
		}
	}

}
?>