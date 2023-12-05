<!DOCTYPE html>
    <html lang="en">

    <head>
<?php
include 'commands/connectDB.php';
include 'commands/auth.php';
?>
        <meta charset="utf-8">
        <title><?php echo $sysconfig['system_name'];?> | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="upload/<?php echo $sysconfig['company_slogo']; ?>">

        <!-- third party css -->
        <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
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
                    
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                                
						<!-- my container start -->
						<div class="row">
                            <div class="col-xl-6 col-lg-6">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                                </div>
												<?php
													$cacount = $conn->query("SELECT * from consumer_data where MONTH(create_date)=MONTH(now()) and YEAR(create_date)=YEAR(now())");
													$consumercount = $cacount->num_rows;
													$cacountnew = $conn->query("SELECT * from consumer_data"); //last 2 new value 5
													$consumercountnew = $cacountnew->num_rows;
													// Percentage Calculate
													$consumercount1 = $consumercountnew - $consumercount;
													$consumercount2 = $consumercountnew - $consumercount1;
													if ( $consumercount1 == 0 ) { $consumercount1 = 1; }
													$consumercount3 = $consumercount2 / $consumercount1;
													$consumercount4 = $consumercount3 * 100;
												?>
                                                <h5 class="text-muted fw-normal mt-0" title="Number of Consumers">Consumers</h5>
                                                <h3 class="mt-3 mb-3"><?php echo number_format($consumercountnew, 0, '.', ',') ?></h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> <?php echo number_format($consumercount4, 2, '.', ',') ?>%</span>
                                                    <span class="text-nowrap">Since last month</span>  
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-cash-multiple widget-icon"></i>
                                                </div>
												<?php
												$revenuelastmonth = $conn->query("SELECT SUM(total_pay) AS revlastmonth, SUM(pchange) AS changelastmonth FROM billings where MONTH(present_readdate)=MONTH(now())-1 and YEAR(present_readdate)=YEAR(now())");
												$revenue = $conn->query("SELECT SUM(total_pay) AS revthismonth, SUM(pchange) AS changethismonth FROM billings where MONTH(present_readdate)=MONTH(now()) and YEAR(present_readdate)=YEAR(now())");
												$revlm = $revenuelastmonth->fetch_assoc();
												$rev = $revenue->fetch_assoc();
												$revlastmonth = $revlm['revlastmonth'] - $revlm['changelastmonth'];
												$revthismonth = $rev['revthismonth'] - $rev['changethismonth'];
												// Percentage Calculate
												$revper1 = $revthismonth - $revlastmonth;
												if ( $revlastmonth == 0 ) { $revlastmonth = 100; }
												$revper2 = $revper1 / $revlastmonth;
												$revper3 = $revper2 * 100;
												?>
                                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Revenue</h5>
                                                <h3 class="mt-3 mb-3">₱ <?php echo number_format($revthismonth, 2, '.', ','); ?></h3>
                                                <p class="mb-0 text-muted">
                                                    <?php if ( $revlastmonth > $revthismonth ) { echo '<span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i>'; } else { echo '<span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>'; } echo number_format($revper3, 2, '.', ',');?>%</span>
                                                    <span class="text-nowrap">Since last month <?php if ($revlastmonth != 100) { echo "( ₱ ",number_format($revlastmonth, 2, '.', ','),"  )"; } ?></span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row -->
                            </div> <!-- end col -->

                            <div class="col-xl-6 col-lg-6">
								<div class="row">
                                    <div class="col-lg-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                                </div>
												<?php
												$allbal = $conn->query("SELECT SUM(balance) AS allbalance FROM consumer_data");
												$getarz = $conn->query("SELECT * from billings where billing_status = 0");
												$allball = $allbal->fetch_assoc();
												if($getarz->num_rows > 0){
													$totalar = 0;
													while($getar= $getarz->fetch_assoc()){
														if ( $getar['mincon'] > $getar['total_consumed'] ){
															$t1 = $getar['mincon_price'];
														} else {
															$t1 = $getar['total_consumed'] * $getar['excd_price'];
														}
														$totalar += $t1;
													}
												} else {
														$totalar = 0;
												}
												$t2 = $totalar + $allball['allbalance']
												?>
                                                <h5 class="text-muted fw-normal mt-0" title="Growth">Account Receivable</h5>
                                                <h3 class="mt-3 mb-3">₱ <?php echo number_format($t2, 2, '.', ','); ?></h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-nowrap">( Invoice Basic Amount & Consumers Balance )</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
									<div class="col-lg-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-pulse widget-icon"></i>
                                                </div>
												<?php
												$grossly = $conn->query("SELECT SUM(total_pay) AS grosslasty, SUM(pchange) AS changelasty FROM billings where YEAR(present_readdate)=YEAR(now())-1");
												$grossty = $conn->query("SELECT SUM(total_pay) AS grossthisy, SUM(pchange) AS changethisy FROM billings where YEAR(present_readdate)=YEAR(now())");
												$grosslasty = $grossly->fetch_assoc();
												$grossthisy = $grossty->fetch_assoc();
												$grosslastyear = $grosslasty['grosslasty'] - $grosslasty['changelasty'];
												$grossthisyear = $grossthisy['grossthisy'] - $grossthisy['changethisy'];
												// Percentage Calculate
												$grper1 = $grossthisyear - $grosslastyear;
												if ( $grosslastyear == 0 ) { $grosslastyear = 100; }
												$grper2 = $grper1 / $grosslastyear;
												$grper3 = $grper2 * 100;
												?>
                                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Gross Revenue</h5>
                                                <h3 class="mt-3 mb-3">₱ <?php echo number_format($grossthisyear, 2, '.', ','); ?></h3>
                                                <p class="mb-0 text-muted">
                                                    <?php if ( $grosslastyear > $grossthisyear ) { echo '<span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i>'; } else { echo '<span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>'; } echo number_format($grper3, 2, '.', ',');?>%</span>
                                                    <span class="text-nowrap">Since last year <?php if ($grosslastyear != 100) { echo "( ₱ ",number_format($grosslastyear, 2, '.', ','),"  )"; } ?></span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
						
						
						<div class="row">
                            <div class="col-xl-4">
                                <!-- Personal-Information -->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Billing Information</h4>
                                        <hr>
                                        <div class="text-start">
                                            <p class="text-muted"><strong>Minimum Consumption :</strong> <span class="ms-2"><?php echo $sysconfig['mincon']; ?></span></p>
                                            <p class="text-muted"><strong>Minimum Consumption Price :</strong><span class="ms-2">₱ <?php echo number_format($sysconfig['mincon_price'], 2, '.', ',') ?></span></p>
                                            <p class="text-muted"><strong>Regular Consumption Price :</strong> <span class="ms-2">₱ <?php echo number_format($sysconfig['excd_price'], 2, '.', ',') ?> per cubic meter.</span></p>
                                            <p class="text-muted"><strong>Reconnection Fee :</strong> <span class="ms-2">₱ <?php echo number_format($sysconfig['reconfee'], 2, '.', ',') ?></span></p>
                                            <p class="text-muted"><strong>Penalty ( Percentage ) :</strong><span class="ms-2"><?php echo $sysconfig['penalty_percent']; ?>%</span></p>
											<p class="text-muted"><strong>Due Date :</strong><span class="ms-2"><?php echo $sysconfig['due_settings']," ",$sysconfig['due_settings2']; ?>(s) after scanned date.</span></p>
											<p class="text-muted"><strong>Disconnection Date :</strong><span class="ms-2"><?php echo $sysconfig['dis_settings']," ",$sysconfig['dis_settings2']; ?>(s) after due date.</span></p>
											
											
											<?php
											function validate(string $username) : bool {
    return preg_match('/^(?=.{4,})(?!.*_$)[a-zA-Z0-9_]+$/', $username);
}

echo validate('Mike_Standish') ? 'Valid' : 'Invalid';
echo validate('Mike Standish') ? 'Valid' : 'Invalid';
?>											
                                        </div>
                                    </div>
                                </div>
                                <!-- Personal-Information -->


                            </div> <!-- end col-->

                            <div class="col-xl-8">

                                <!-- Chart-->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Revenue Graph</h4>
                                        <div dir="ltr">
                                            <div style="height: 260px;" class="chartjs-chart">
                                                <canvas id="high-performing-product"></canvas>
                                            </div>
                                        </div>        
                                    </div>
                                </div>
                                <!-- End Chart-->

                                

                            </div>
                            <!-- end col -->

                        </div>
						
						
						
						<!-- my container end -->

                    </div>
                    <!-- container -->
					
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
		<!-- script src="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
		<!-- script src="cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="assets/js/pages/demo.datatable-init.js"></script>
        <!-- end demo js-->
		
		<!-- demo js -->
        <script src="assets/js/pages/demo.toastr.js"></script>
        <!-- -->
		
		<!-- third party js -->
        <script src="assets/js/vendor/Chart.bundle.min.js"></script>
        <!-- third party js ends -->
		
		<?php include 'chart/indexchart.php'; ?>

    </body>
</html>