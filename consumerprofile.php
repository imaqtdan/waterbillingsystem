<!DOCTYPE html>
    <html lang="en">

    <head>
<?php
include 'commands/connectDB.php';
include 'commands/auth.php';
$date = date('Y-m-d');
$profile = $conn->query("SELECT f.*,u.balance,u.previous_read,u.previous_transaction,u.create_date from consumer_account f left join consumer_data u on f.consumer_id = u.consumer_id where u.id = ".$_GET['q']);
$prow= $profile->fetch_assoc()
?>
        <meta charset="utf-8">
        <title><?php echo $sysconfig['system_name'];?> | <?php echo $prow['first_name']," ",$prow['last_name'];?>'s Information</title>
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
                                            <li class="breadcrumb-item"><a href="consumers.php">Consumers</a></li>
                                            <li class="breadcrumb-item active">Information</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $prow['first_name']," ",$prow['last_name'];?>'s Information ( <?php echo $prow['consumer_id']; ?> )</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-xl-4">
                                <!-- Personal-Information -->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Consumer Information</h4>
											<center><img src="qrcodes/<?php echo $prow['consumer_id'] ?>.png" alt="" id="cimg" class="img-fluid me-2" width="200" height="200"></center>
                                        <hr>

                                        <div class="text-start">
											<p class="text-muted"><strong>Full Name :</strong> <span class="ms-2"><?php echo $prow['first_name']," ",$prow['last_name']; ?></span></p>
                                            <p class="text-muted"><strong>Address :</strong><span class="ms-2"><?php echo $prow['address'],", ",$prow['brg_address'],", ",$prow['ct_address'],", ",$prow['pro_address']; ?></span></p>
                                            <p class="text-muted"><strong>Contact Number :</strong> <span class="ms-2"><?php echo $prow['contact']; ?></span></p>
                                            <p class="text-muted"><strong>Join Date :</strong> <span class="ms-2"><?php echo $prow['create_date']; ?></span></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Personal-Information -->
                            </div> <!-- end col-->

                            <div class="col-xl-8">
							
								<div class="row">
                                    <div class="col-sm-4">
                                        <div class="card tilebox-one">
                                            <div class="card-body">
                                                <i class="dripicons-jewel float-end text-muted"></i>
                                                <h6 class="text-muted text-uppercase mt-0">Balance</h6>
                                                <h2 class="m-b-20">₱<span><?php echo number_format($prow['balance'], 2, '.', ','); ?></span></h2>
                                            </div> <!-- end card-body-->
                                        </div> <!--end card-->
                                    </div><!-- end col -->

                                    <div class="col-sm-4">
                                        <div class="card tilebox-one">
                                            <div class="card-body">
                                                <i class="dripicons-jewel float-end text-muted"></i>
                                                <h6 class="text-muted text-uppercase mt-0">Overall Consumption</h6>
                                                <h2 class="m-b-20"><?php echo $prow['previous_read']; ?> Cubic Meters</h2>
                                            </div> <!-- end card-body-->
                                        </div> <!--end card-->
                                    </div><!-- end col -->

                                    <div class="col-sm-4">
                                        <div class="card tilebox-one">
                                            <div class="card-body">
												<?php
													$sump = $conn->query("SELECT SUM(total_pay) AS sump, SUM(pchange) AS sumpp FROM billings where consumer_id = ".$prow['consumer_id']);
													$sump = $sump->fetch_assoc();
													$ttp = $sump['sump'] - $sump['sumpp'];
												?>
                                                <i class="dripicons-jewel float-end text-muted"></i>
                                                <h6 class="text-muted text-uppercase mt-0">Overall Paid</h6>
                                                <h2 class="m-b-20">₱<span><?php echo number_format($ttp, 2, '.', ','); ?></h2>
                                            </div> <!-- end card-body-->
                                        </div> <!--end card-->
                                    </div><!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- Chart-->
                                <div class="card">
                                    <div class="card-body">
										<h4 class="header-title mb-3">Invoice Logs</h4>
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
											<thead>
												<tr>
													<th><center>Billing ID</th>
													<th><center>Period</th>
													<th><center>Transacted Date</th>
													<th><center>Status</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$qry = $conn->query("SELECT * from billings where billing_status != 0 and consumer_id = '".$prow['consumer_id']."' order by id asc");
													if($qry->num_rows > 0){
														while($row= $qry->fetch_assoc()){
												$duedate = date("Y-m-d", strtotime($row['present_readdate'] . $row['due_settings'] . $row['due_settings2']));
												?>
												<tr>
													<td><center><?php echo 500000 + $row['id'] ?></td>
													<td><center><?php echo $row['previous_readdate']," to ",$row['present_readdate'] ?></td>
													<td><center><?php echo $row['date_processed'] ?></td>
													<td>
													<?php 
																if ($row['billing_status'] == 0) { 
																	echo '<center><span class="badge badge-secondary-lighten">Unpaid</span>';
																	if ($date > $duedate){ 
																		echo ' | <span class="badge badge-danger-lighten">Overdue</span>'; 
																		}
																} else if ($row['billing_status'] == 1) { 
																	echo '<center><span class="badge badge-success-lighten">Partial Payment</span>';
																	if ($row['date_processed'] > $duedate){ 
																		echo ' | <span class="badge badge-danger-lighten">Overdue</span>'; 
																		} 	
																} else { 
																	echo '<center><span class="badge bg-success">Paid</span>';
																	if ($row['date_processed'] > $duedate){ 
																		echo ' | <span class="badge badge-danger-lighten">Overdue</span>'; 
																		} 
																	}
													?>
													</td>
													<td>
													<a href="./invoice.php?q=<?php echo $row['id'] ?>" class="action-icon" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="View"> <i class="mdi mdi-eye"></i></a>
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
                                <!-- End Chart-->
								
                            </div>
                            <!-- end col -->

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
</html>