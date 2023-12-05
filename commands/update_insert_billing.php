<?php
include 'connectDB.php';
include 'auth.php';

require "../vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

$settrow = $conn->query("SELECT * from system_config where id = 1");
$srow= $settrow->fetch_assoc();

extract($_POST);

	$date = date('Y-m-d');
	$totc = $presread - $prevread;
	$min = $srow['mincon'];
	$minp = $srow['mincon_price'];
	$excd = $srow['excd_price'];
	$rfee = $srow['reconfee'];
	$pnlt = $srow['penalty_percent'];
	$dsett = $srow['due_settings'];
	$dsett2 = $srow['due_settings2'];
	$disett = $srow['dis_settings'];
	$disett2 = $srow['dis_settings2'];
	$log = $_SESSION['login_id'];
	
	$data =  " consumer_id='".$cid."'";
	$data .=  ", previous_read='".$prevread."'";
	$data .=  ", present_read='".$presread."'";
	$data .=  ", total_consumed='".$totc."'";
	$data .=  ", previous_readdate='".$prevdate."'";
	$data .=  ", present_readdate='".$presdate."'";
	$data .=  ", balance='".$bal."'";
	$data .=  ", mincon='".$min."'";
	$data .=  ", mincon_price='".$minp."'";
	$data .=  ", excd_price='".$excd."'";
	$data .=  ", reconfee='".$rfee."'";
	$data .=  ", penalty_percent='".$pnlt."'";
	$data .=  ", due_settings='".$dsett."'";
	$data .=  ", due_settings2='".$dsett2."'";
	$data .=  ", dis_settings='".$disett."'";
	$data .=  ", dis_settings2='".$disett2."'";
	$data .=  ", client_scanned='".$log."'";
	$cunpaid = $conn->query("SELECT * from billings where consumer_id = '".$cid."' and billing_status = 0");
	$cunpaid2 = $conn->query("SELECT * from billings where consumer_id = '".$cid."' and present_readdate = '".$presdate."'");

if ($presread < $prevread ) {
	$_SESSION['errstatus'] = "Please enter appropriate Present Consumption.";
	echo json_encode(array('status'=>2));
	exit;
}

if(empty($id)){

if($cunpaid->num_rows == 2){
	$_SESSION['errstatus'] = "Can't create invoice. (Maximum of 2 unpaid invoice per consumer)";
	echo json_encode(array('status'=>2));
	exit;
}

if($cunpaid2->num_rows > 0){
	$_SESSION['errstatus'] = "Can't duplicate invoice on same day (If changes needed please use edit)";
	echo json_encode(array('status'=>2));
	exit;
}
	
	$insert_bill = $conn->query('INSERT INTO billings set  '.$data);
	if($insert_bill){
		$update_consumer = $conn->query("UPDATE consumer_data set previous_transaction = '".$presdate."', previous_read = '".$presread."' where consumer_id = '".$cid."'");
			if($update_consumer){
				// GET LAST ID - STARTt
				$latestid = $conn->query("SELECT * FROM billings ORDER BY id DESC LIMIT 0, 1");
				$latestidrow = $latestid->fetch_assoc();
				$lid = $latestidrow['id'];
				// GET LAST ID - END

				// QR CODE LINE - START
				$qr_code = QrCode::create($lid)
					->setSize(600)
					->setMargin(40)
					//->setForegroundColor(new Color(255, 128, 0))
					//->setBackgroundColor(new Color(153, 204, 255))
					->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);
				$writer = new PngWriter;
				$filePath = '../qrcodes/' . $lid . '.png';
				$result = $writer->write($qr_code);
				$result->saveToFile($filePath);
				// QR CODE LINE - END

				$_SESSION['status'] = "Successfully created invoice.";
				echo json_encode(array('status'=>1));
		}
	}
} else {
		$update_bill_consumer = $conn->query("UPDATE consumer_data set previous_transaction = '".$presdate."', previous_read = '".$presread."' where consumer_id = '".$cid."'");
			if($update_bill_consumer){
				$update_bill = $conn->query("UPDATE billings set present_read = '".$presread."', total_consumed = '".$totc."' where id = '".$id."'");
				$aqry = $conn->query("SELECT * FROM billings where consumer_id = '".$cid."' and present_readdate = (SELECT MAX(present_readdate) FROM billings WHERE consumer_id = '".$cid."' and billing_status = 0)");
				$arow = $aqry->fetch_assoc();
				if ($presdate != $arow['present_readdate']) {
					$prevread = $arow['present_read'];
					$totz = $prevread - $presread;
					$update_bill1 = $conn->query("UPDATE consumer_data set previous_read = '".$prevread."' where consumer_id = '".$cid."'");
					$update_bill2 = $conn->query("UPDATE billings inner join ( SELECT max(present_readdate) as date from billings where consumer_id = '".$cid."') mx on billings.present_readdate = mx.date set previous_read = '".$presread."', total_consumed = '".$totz."' WHERE consumer_id = '".$cid."' and billing_status = 0");
				}	
				$_SESSION['status'] = "Invoice successfully updated.";
				echo json_encode(array('status'=>1));
		}
}
?>