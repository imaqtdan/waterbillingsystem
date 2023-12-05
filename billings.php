<!DOCTYPE html>
    <html lang="en">

    <head>
<?php
include 'commands/connectDB.php';
include 'commands/auth.php';
?>
        <meta charset="utf-8">
        <title><?php echo $sysconfig['system_name'];?> | Billings</title>
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
		
		<script type="text/javascript" src="instascan.min.js"></script>

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
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Billings</h4>
                                </div>
                            </div>
                        </div>
						<div class="row">
						<div class="col-md-6 col-lg-4">
							<div class="card d-block">
								<div class="card-body">
									<h5 class="card-title">QR SCANNER</h5>
									<video class="ratio ratio-1x1" id="preview"></video>
								</div>
							</div>
                        </div><!-- end col -->
						<div class="col-md-6 col-lg-4">
                                <div class="card d-block">
                                    <div class="card-body">
                                        <h5 class="card-title">INVOICE CONTROL</h5>
										<div class="col-12">
											<div class="card">
												<div class="card-body">
													<select name="nbill" id="nbill" class="form-control select2" data-toggle="select2">
														<!--option value="0">Select Consumer</option-->
													<?php
														//$qryz = $conn->query("SELECT f.*,u.balance,u.previous_read,u.cstatus,e.billing_status from consumer_account f left join consumer_data u on f.consumer_id = u.consumer_id left join billings e on u.consumer_id = e.consumer_id");
														$qryz = $conn->query("SELECT f.*,u.balance,u.previous_read,u.cstatus from consumer_account f left join consumer_data u on f.consumer_id = u.consumer_id where u.cstatus = 0");
														if($qryz->num_rows > 0){
														while($row= $qryz->fetch_assoc()){
															$cunpaid = $conn->query("SELECT * from billings where consumer_id = '".$row['consumer_id']."' and billing_status = 0");
															$cntunpaid = $cunpaid->num_rows;
													?>	
														<option value="<?php echo $row['id'] ?>"><?php echo $row['consumer_id']," - ",$row['first_name']," ",$row['last_name']," - ",$cntunpaid," Unpaid Bill"; ?></option>
													<?php
														}
													}
													?>	
													</select>
													<br><br>
													<center><button type="button" data-id="nbill" class="btn btn-info" id="invoicem"><i class="mdi mdi-cash-plus"></i> Create Invoice</button></center>
												</div>
											</div>
										</div>
										<?php 
										$invcount = $conn->query("SELECT * from billings where billing_status = 0");
										if($invcount->num_rows > 0) :
										?>									
										<h5 class="card-title">ISSUE INVOICE</h5>
										<div class="col-12">
											<div class="card">
												<div class="card-body">
													<center><a href="bulkinvoice.php" type="button" class="btn btn-success"><i class="mdi mdi-receipt"></i> View Invoice</a></center>
												</div>
											</div>
										</div>
										<?php endif; include 'modals/invoice_modal_conf.php'; ?>
									</div>
                                </div> <!-- end card-->
                            </div><!-- end col -->
						<div class="col-md-6 col-lg-4">
                                <div class="card d-block">
                                    <div class="card-body">
                                        <h5 class="card-title">DISCONNECTED LIST</h5>
										<div class="col-12">
											<div class="card">
												<div class="card-body">
													<table class="table table-bordered table-centered mb-0">
														<thead>
															<tr>
																<th>Consumer ID.</th>
																<th class="text-center">Reconnection</th>
															</tr>
														</thead>
														<?php
															$qrya = $conn->query("SELECT * from consumer_data where cstatus != 0 order by id asc");
																if($qrya->num_rows > 0){
																	while($rowa = $qrya->fetch_assoc()){
														?>
														<tbody>
															<tr>
																<td><?php echo $rowa['consumer_id']; ?></td>
																<td class="table-action text-center">
																	<a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-cash-register"></i></a>
																</td>
															</tr>
														<?php
																}
															}
														?>		
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
                                </div> <!-- end card-->
                            </div><!-- end col -->
						</div>
                        <!-- end page title -->
					<!-- my container start -->
					<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Unpaid - Invoice Table</h4>
                                        <p class="text-muted font-14">
                                        </p>

                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="scroll-vertical-preview">
                                                <table id="alternative-page-datatable" class="table dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Billing ID</th>
                                                            <th>Consumer ID</th>
                                                            <th>Prev. Consumption</th>
                                                            <th>Pres. Consumption</th>
                                                            <th>Total Consumed</th>
															<th>Basic Amount</th>
                                                            <th>Billing Period</th>
															<th>Due Date</th>
															<th><center>Billing Status</center></th>
															<th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
													<?php
														$qry = $conn->query("SELECT * from billings where billing_status = 0 order by id asc");
														//$qry = $conn->query("SELECT * from billings order by id asc");
															if($qry->num_rows > 0){
																while($row= $qry->fetch_assoc()){
													?>
                                                        <tr>
															<?php
															$min = $row['mincon'];
															$minp = $row['mincon_price'];
															$excdp = $row['excd_price'];
															$totc = $row['total_consumed'];
															$date = date('Y-m-d');
															$duedate = date("Y-m-d", strtotime($row['present_readdate'] . $row['due_settings'] . $row['due_settings2']));
															$disdate = date("Y-m-d", strtotime($duedate . $row['dis_settings'] . $row['dis_settings2']));
															if ( $row['total_consumed'] > $min ){
																$basicp = $totc * $excdp;
															} else {
																$basicp = $minp;
															}
															?>
                                                            <td><?php echo 500000 + $row['id'] ?></td>
                                                            <td><?php echo $row['consumer_id'] ?></td>
                                                            <td><?php echo $row['previous_read'] ?></td>
                                                            <td><?php echo $row['present_read'] ?></td>
                                                            <td><?php echo $totc ?></td>
                                                            <td>₱ <?php echo number_format($basicp, 2, '.', ',') ?></td>
															<td><?php echo $row['previous_readdate']," to ",$row['present_readdate'] ?></td>
															<td><?php echo $duedate ?></td>
															<td><center>
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
																$chkdc = $conn->query("SELECT * from consumer_data where consumer_id = ".$row['consumer_id']);
																$dcrow = $chkdc->fetch_assoc();
																if ( $date > $disdate && $row['billing_status'] == 0 && $dcrow['cstatus'] == 0 ) {
																	echo '<a href="#" class="badge badge-danger-lighten changestatus" data-id="'.$row['consumer_id'].'" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Click to Disconnect">DISCONNECT</a>';
																}
																if ( $dcrow['cstatus'] != 0 ) {
																	echo '<span class="badge bg-danger">DISCONNECTED</span>';
																}
															?></center></td>
															<td class="table-action">
																<?php if ( $row['billing_status'] == 0 ) : ?>
																	<a href="./invoice.php?q=<?php echo $row['id'] ?>" class="action-icon" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Transact"> <i class="mdi mdi-cash-register"></i></a>
                                                                    <a href="#" class="action-icon editinvoice" data-id="<?php echo $row['id']?>" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Edit Invoice"> <i class="mdi mdi-pencil"></i></a>
																<?php else: ?>
																	<a href="./invoice.php?q=<?php echo $row['id'] ?>" class="action-icon" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="View"> <i class="mdi mdi-eye"></i></a>
																<?php endif;?>
																	<a href="#" class="action-icon deleteinvc" data-id="<?php echo $row['id']?>" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Delete Invoice"> <i class="mdi mdi-delete"></i></a>
															</td>
														</tr>
													<?php
															}
														}
													?>	
                                                    </tbody>
                                                </table>
													<br>
													<center><a href="billinghistory.php" type="button" class="btn btn-success"><i class="mdi mdi-receipt"></i> Billing History</a></center>
                                            </div> <!-- end preview-->
                                        </div> <!-- end tab-content-->
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
					<!-- my container end -->
                </div>
                <!-- content -->

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
	<?php if (isset($_SESSION['errstatus'])) : ?>
	<script>
	$.NotificationApp.send("Note: ","<?php echo $_SESSION['errstatus'] ?>","top-right","rgba(0,0,0,0.2)","error");
	</script>
	<?php unset($_SESSION['errstatus']); endif;?>
	<script>
	$(document).ready(function(){
		$('#invoicem').click(function(){
			var myElement = document.getElementById('nbill'),
			myElementValue = myElement.value;
			$.ajax({
				url:'./commands/get_consumer_info.php?id='+myElementValue,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('#bs-example-modal-lg .modal-title').html('<i class="mdi mdi-cash-plus"></i> Create Invoice')
						$('#bs-example-modal-lg [name="submit"]').html('<i class="mdi mdi-cash-plus"></i> Submit Invoice')
						$('#bs-example-modal-lg #invoiceform').get(0).reset()
						$('[name="id"]').val('0')
						$('[name="cid"]').val(resp.consumer_id)
						var bal = +resp.balance;
						$('[name="bal"]').val(bal.toFixed(2))
						$('[name="prevread"]').val(resp.previous_read)
						$('[name="prevdate"]').val(resp.previous_transaction)
						$('[name="presdate"]').val('<?php echo $date ?>')
						$('#bs-example-modal-lg').modal('show')
					}
				}
			})
		})
		$('body').on('click','.editinvoice', function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./commands/get_invoice_info.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('#bs-example-modal-lg .modal-title').html('<i class="mdi mdi-cash-plus"></i> Edit Invoice')
						$('#bs-example-modal-lg [name="submit"]').html('<i class="mdi mdi-pencil"></i> Update Invoice')
						$('[name="id"]').val(resp.id)
						$('[name="cid"]').val(resp.consumer_id)
						var bal = +resp.balance;
						$('[name="bal"]').val(bal.toFixed(2))
						$('[name="presread"]').val(resp.present_read)
						$('[name="prevread"]').val(resp.previous_read)
						$('[name="prevdate"]').val(resp.previous_readdate)
						$('[name="presdate"]').val(resp.present_readdate)
						$('#bs-example-modal-lg').modal('show')
					}
				}
			})
		})
	$('#invoiceform').submit(function(e){
			e.preventDefault();
			$('#invoiceform [name="submit"]').attr('disabled',true)
			$('#invoiceform [name="submit"]').html('Saving...')
			$('#msg').html('')
			$.ajax({
				url:'./commands/update_insert_billing.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#invoiceform [name="submit"]').removeAttr('disabled')
					$('#invoiceform [name="submit"]').html('Save')
				},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							location.reload();
						}else{
							location.reload();
						}
					}
				}
			})
		})
		$('body').on('click','.deleteinvc', function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./commands/get_invoice_info.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.id)
						$('#warning-alert-modal .del-cid').html(resp.consumer_id)
						$('#warning-alert-modal #deleteform').get(0).reset()
						$('#warning-alert-modal').modal('show')
					}
				}
			})
		})
		$('#deleteform').submit(function(e){
			e.preventDefault();
			$('#deleteform [name="submit"]').attr('disabled',true)
			$('#deleteform [name="submit"]').html('Saving...')
			$('#msg').html('')
			$.ajax({
				url:'./commands/delete_bill.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#deleteform [name="submit"]').removeAttr('disabled')
					$('#deleteform [name="submit"]').html('Save')
				},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							location.reload();
						}else{
							$('#warning-alert-modal #deleteform').get(0).reset()
							$.NotificationApp.send("An error occured!",""+resp.msg+"","top-right","rgba(0,0,0,0.2)","error")
						}
					}
				}
			})
		})
		$('body').on('click','.changestatus', function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./commands/change_cstatus.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							location.reload();
						}else{
							$.NotificationApp.send("An error occured!",""+resp.msg+"","top-right","rgba(0,0,0,0.2)","error")
						}
					}
				}
			})
		})
	})
	</script>
	<script type="text/javascript">
      let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
      });

      scanner.addListener('scan', function (content) {
		window.location="invoice.php?q="+content;
		
      });

      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
</html>