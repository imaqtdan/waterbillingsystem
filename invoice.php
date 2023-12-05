<!DOCTYPE html>
    <html lang="en">

    <head>
<?php
include 'commands/connectDB.php';
include 'commands/auth.php';

$qry = $conn->query("SELECT f.*,u.first_name,u.last_name,u.address,u.brg_address,u.ct_address,u.pro_address,u.contact from billings f left join consumer_account u on f.consumer_id = u.consumer_id where f.id = ".$_GET['q']);
if($qry->num_rows <= 0){
$_SESSION['errstatus'] = "There's no invoice with this QR Code.";
header('Location: billings.php');	
}
$row= $qry->fetch_assoc();
$qry2 = $conn->query("SELECT * from system_config where id = 1");
$row2= $qry2->fetch_assoc();
$min = $row['mincon'];
$minp = $row['mincon_price'];
$excdp = $row['excd_price'];
$pnlt = ($row['penalty_percent'] / 100);
$totc = $row['total_consumed'];
$date = date('Y-m-d');
$duedate = date("Y-m-d", strtotime($row['present_readdate'] . $row['due_settings'] . $row['due_settings2']));
$disdate = date("Y-m-d", strtotime($duedate . $row['due_settings'] . $row['due_settings2']));
if ( $row['total_consumed'] > $min ){
	$basicp = $totc * $excdp;
} else {
	$basicp = $minp;
}
?>
        <meta charset="utf-8">
        <title><?php echo $sysconfig['system_name'];?> | Invoice</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="upload/<?php echo $sysconfig['company_slogo']; ?>">

        <!-- third party css -->
        <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css">
        <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css">
        <link href="assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css">
        <link href="assets/css/vendor/select.bootstrap5.css" rel="stylesheet" type="text/css">
        <!-- third party css end -->

        <!-- App css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
        <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

    </head>
	
	<!-- Body Setup & Sidebar Start -->
    <?php include 'pageconfig/sidebar.php'; ?>
	<!-- Body Setup & Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
        <!-- Topbar Start -->
        <?php include 'pageconfig/topbar.php'; ?>
        <!-- end Topbar -->
                    
                <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="billings.php">Billings</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Invoice</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <!-- Invoice Logo-->
                                        <div class="clearfix">
                                            <div class="float-start mb-3">
                                                <img src="upload/<?php echo $sysconfig['company_logo']; ?>" alt="" height="50">
                                            </div>
                                            <div class="float-end">
                                                <h4 class="m-0 d-print-none">Invoice</h4>
                                            </div>
                                        </div>

                                        <!-- Invoice Detail-->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="float-end mt-3">
                                                    <p><b>Hello, <?php echo $row['first_name']," ",$row['last_name'] ?></b></p>
                                                    <p class="text-muted font-13">Please make payment at your earliest convenience, and do not hesitate to contact me with any questions.</p>
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-sm-6 offset-sm-2">
                                                <div class="mt-3 float-sm-end">
													<p class="font-13"><strong>Consumer ID: </strong> <span class="float-end">&nbsp;&nbsp;&nbsp; <?php echo $row['consumer_id'] ?></span></p>
                                                    <p class="font-13"><strong>Billing Period: </strong> <span class="float-end">&nbsp;&nbsp;&nbsp; <?php echo $row['previous_readdate']," to ",$row['present_readdate'] ?></span></p>
                                                    <p class="font-13"><strong>Read Date: </strong> <span class="float-end"><?php echo $row['present_readdate'] ?></span></p>
													<p class="font-13"><strong>Due Date: </strong> <span class="float-end">&nbsp;&nbsp;&nbsp; <?php echo $duedate ?></span></p>
                                                    <p class="font-13"><strong>Billing Status: </strong> <span class="float-end">
													<?php 
																if ($row['billing_status'] == 0) { 
																	echo '<span class="badge badge-secondary-lighten">UNPAID</span>';
																	if ($date > $duedate){ 
																		echo '<span class="badge badge-danger-lighten">OVERDUE</span>'; 
																		}
																} else if ($row['billing_status'] == 1) { 
																	echo '<span class="badge badge-success-lighten">PARTIAL PAYMENT</span>';
																	if ($row['date_processed'] > $duedate){ 
																		echo '<span class="badge badge-danger-lighten">OVERDUE</span>'; 
																		} 	
																} else { 
																	echo '<span class="badge bg-success">PAID</span>';
																	if ($row['date_processed'] > $duedate){ 
																		echo '<span class="badge badge-danger-lighten">OVERDUE</span>'; 
																		} 
																	}
													?></span></p>
                                                    <p class="font-13"><strong>Billing ID: </strong> <span class="float-end">#<?php echo 500000 + $row['id'] ?></span></p>
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->
            
                                        <div class="row mt-4">
                                            <div class="col-sm-4">
                                                <h6>Billing Address</h6>
                                                <address>
                                                    <?php  if (isset($_SESSION['login_id'])) {echo $_SESSION['login_first_name']," ",$_SESSION['login_last_name'];} ?><br>
                                                    <?php echo $row2['address'] ?><br>
                                                    <?php echo $row2['brg_address'],", ",$row2['ct_address'],", ",$row2['pro_address'] ?><br>
                                                    <abbr title="Phone">P:</abbr> <?php echo $row2['contact'] ?>
                                                </address>
                                            </div> <!-- end col-->
            
                                            <div class="col-sm-4">
                                                <h6>Shipping Address</h6>
                                                <address>
                                                    <?php echo $row['first_name']," ",$row['last_name'] ?><br>
                                                    <?php echo $row['address'] ?><br>
                                                    <?php echo $row['brg_address'],", ",$row['ct_address'],", ",$row['pro_address'] ?><br>
                                                    <abbr title="Phone">P:</abbr> <?php echo $row['contact'] ?>
                                                </address>
                                            </div> <!-- end col-->
            
                                            <div class="col-sm-4">
                                                <div class="text-sm-end">
													<center><img src="qrcodes/<?php echo $row['id'] ?>.png" alt="" id="cimg" class="img-fluid me-2" style="width: 180px; height: 180px;"></center>
                                                </div>
                                            </div> <!-- end col-->
                                        </div>    
                                        <!-- end row -->        
    
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table mt-4">
                                                        <thead>
                                                        <tr>
															<th><center>Prev. Consumption</center></th>
                                                            <th><center>Pres. Consumption</center></th>
                                                            <th><center>Total Consumed</center></th>
                                                            <th><center>Basic Amount</center></th>
                                                        </tr>
														</thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><center><?php echo $row['previous_read'] ?></center></td>
                                                            <td><center><?php echo $row['present_read'] ?></center></td>
                                                            <td><center><?php echo $totc ?></center></td>
                                                            <td><center>₱ <?php echo number_format($basicp, 2, '.', ',') ?></center></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive-->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="clearfix pt-3">
                                                    <center><small>Note: Service may be discontinued without prior notice if the bill is not paid within <?php echo $row2['dis_settings']," ",$row2['dis_settings2']; if ($row2['dis_settings'] > 1) { echo "s ( ".$disdate; } else { echo " ( ".$disdate; } ?> ) after the due date.
                                                    </small></center>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row-->
										<div class="row">
											<div class="col-sm-12">
                                                <div class="float-end mt-3 mt-sm-0">
													<p><span class="float-end">_____________________________</span></p>
                                                    <p><b>Sub-total: </b> <span class="float-end">₱ <?php echo number_format($basicp, 2, '.', ',') ?></span></p>
													<?php
													$qryaz = $conn->query("SELECT * from consumer_data where consumer_id = ".$row['consumer_id']);
													$rowb= $qryaz->fetch_assoc();
													?>
													<?php if ($row['billing_status'] == 0) : ?>
                                                    <p><b>Balance: </b> <span class="float-end">₱ <?php echo number_format($rowb['balance'], 2, '.', ',') ?></span></p>
													<?php endif;?>
													<?php if ($row['billing_status'] != 0) : ?>
                                                    <p><b>Balance: </b> <span class="float-end">₱ <?php echo number_format($row['balance'], 2, '.', ',') ?></span></p>
													<?php endif;?>
													<?php 
													if ($row['billing_status'] >= 0) { 
														if ($date > $duedate){
														$basicp2 = $basicp * $pnlt;
														echo '<p><b>Penalty('.$row['penalty_percent'].'%): </b> <span class="float-end">₱';
														echo number_format($basicp2, 2, '.', ',');
														} else {
														$basicp2 = 0;	
														}
													}
													if ($row['billing_status'] == 0) { 
													$finalp = $basicp + $basicp2 + $rowb['balance'];
													} else {
													$finalp = $basicp + $basicp2 + $row['balance'];	
													}
													?></span></p>
													<p><h4>Total: <span class="float-end">₱ <?php echo number_format($finalp, 2, '.', ',') ?><h4></p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
										</div>
                                        <!-- end row-->
										<?php if ( $row['billing_status'] > 0 ) : ?>
										<div class="row">
											<div class="col-sm-12">
                                                <div class="float-end mt-3 mt-sm-0">
													<p><span class="float-end">_____________________________</span></p>
                                                    <p><b>Amount Paid: </b> <span class="float-end">₱ <?php echo number_format($row['total_pay'], 2, '.', ',') ?></span></p>
												<?php if ( number_format($row['pchange'], 2, '.', ',') != 0 ) : ?>
                                                    <p><b>Change: </b> <span class="float-end">₱ <?php echo number_format($row['pchange'], 2, '.', ',') ?></span></p>
												<?php endif;?>
												<?php if ( number_format($row['balance2'], 2, '.', ',') != 0 ) : ?>
                                                    <p><b>Current Balance: </b> <span class="float-end">₱ <?php echo number_format($row['balance2'], 2, '.', ',') ?></span></p>
												<?php endif;?>
													
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
										</div>
										<?php endif;?>	
                                        <!-- end row-->
										<?php include 'modals/transaction_modal_conf.php'; ?>
                                        <div class="d-print-none mt-4">
                                            <div class="text-end">
                                                <a href="javascript:window.print()" class="btn btn-primary"><i class="mdi mdi-printer"></i> Print</a>
											<?php if ( $row['billing_status'] < 1 ) : ?>	
                                                <a href="javascript: void(0);" class="btn btn-info transactpay" data-id="<?php echo $row['id']?>"><i class="mdi mdi-cash-check"></i> Transact</a>
											<?php endif;?>	
                                            </div>
                                        </div>   
                                        <!-- end buttons -->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                <!-- Footer Start -->
                <?php include 'pageconfig/footer.php'; ?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <?php include 'pageconfig/endbar.php'; ?>
        <!-- /End-bar -->

        <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="assets/js/vendor/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
        <script src="assets/js/vendor/dataTables.responsive.min.js"></script>
        <script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>
        <script src="assets/js/vendor/dataTables.buttons.min.js"></script>
        <script src="assets/js/vendor/buttons.bootstrap5.min.js"></script>
        <script src="assets/js/vendor/buttons.html5.min.js"></script>
        <script src="assets/js/vendor/buttons.flash.min.js"></script>
        <script src="assets/js/vendor/buttons.print.min.js"></script>
        <script src="assets/js/vendor/dataTables.keyTable.min.js"></script>
        <script src="assets/js/vendor/dataTables.select.min.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="assets/js/pages/demo.datatable-init.js"></script>
        <!-- end demo js-->
    </body>
	<?php $date = date('Y-m-d'); if (isset($_SESSION['status'])) : ?>
	<script>
	$.NotificationApp.send("Success!","<?php echo $_SESSION['status'] ?>","top-right","rgba(0,0,0,0.2)","success");
	</script>
	<?php unset($_SESSION['status']); endif;?>
	<script>
	$(document).ready(function(){
		$('body').on('click','.transactpay', function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./commands/get_invoice_info.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						//$('#bs-example-modal-lg .modal-title').html('<i class="mdi mdi-pencil"></i> Edit Consumer')
						$('[name="ptotal"]').val('<?php echo $finalp ?>')
						$('[name="id"]').val(resp.id)
						$('[name="consumerid"]').val(resp.consumer_id)
						$('[name="present_readdate"]').val(resp.present_readdate)
						//$('[name="firstname"]').val(resp.first_name)
						$('#standard-modal').modal('show')
					}
				}
			})
		})
		$('#transactionform').submit(function(e){
			e.preventDefault();
			$('#transactionform [name="submit"]').attr('disabled',true)
			$('#transactionform [name="submit"]').html('Saving...')
			$('#msg').html('')
			$.ajax({
				url:'./commands/confirm_transaction.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#transactionform [name="submit"]').removeAttr('disabled')
					$('#transactionform [name="submit"]').html('Save')
				},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							location.reload();
						}else{
							$.NotificationApp.send("An error occured!",""+resp.msg+"","top-right","rgba(0,0,0,0.2)","error")
							//location.reload();
						}
					}
				}
			})
		})
	})
	</script>
</html>