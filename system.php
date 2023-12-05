<!DOCTYPE html>
    <html lang="en">

    <head>
<?php
include 'commands/connectDB.php';
include 'commands/auth.php';
if($_SESSION['login_user_level'] != 0) { 
header('Location: index.php');
}
?>
        <meta charset="utf-8">
        <title><?php echo $sysconfig['system_name'];?> | System Settings</title>
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
                    
                <!-- Start Content-->
                <div class="container-fluid">
				
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">System & Billing Setup</h4>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-6 col-lg-6">
								<div class="card d-block">
									<div class="card-body">
										<form id="syssetup">
										<font color="blue"><h5 class="card-title">SYSTEM SETUP</h5></font>
										
											<div class="mb-3">
												<input type="hidden" name="secret_key" value="1" />
												<label for="sysname" class="form-label">System Name</label>
												<input type="text" id="sysname" name="sysname" class="form-control" required="" value="<?php echo $sysconfig['system_name']; ?>">
											</div>
											
											<div class="mb-3">
												<label for="address" class="form-label">Street Address</label>
												<input type="text" id="address" name="address" class="form-control" required="" value="<?php echo $sysconfig['address']; ?>">
											</div>
											
											<div class="row">
												<div class="col-md-12 col-lg-4">
													<div class="mb-3">
														<label for="brg_address" class="form-label">Barangay Address</label>
														<input class="form-control" type="text" name="brg_address" id="brg_address" required="" value="<?php echo $sysconfig['brg_address']; ?>">
													</div>
												</div>
												<div class="col-md-12 col-lg-4">
													<div class="mb-3">
														<label for="ct_address" class="form-label">City Address</label>
														<input class="form-control" type="text" name="ct_address" id="ct_address" required="" value="<?php echo $sysconfig['ct_address']; ?>">
													</div>
												</div>
												<div class="col-md-12 col-lg-4">
													<div class="mb-3">
														<label for="pro_address" class="form-label">Province Address</label>
														<input class="form-control" type="text" name="pro_address" id="pro_address" required="" value="<?php echo $sysconfig['pro_address']; ?>">
													</div>
												</div>
											</div>
											
											<div class="mb-3">
												<label for="contact" class="form-label">Contact</label>
												<input type="text" id="contact" name="contact" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sysconfig['contact']; ?>">
											</div>
											
											<div class="mb-3">
												<button class="btn btn-primary" name="submit" id="submit" type="submit">Update System Information</button>
											</div>
										</form>	
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-12 col-lg-12">
										<div class="card d-block">
											<div class="card-body">
											<form id="billsetup">
												<font color="blue"><h5 class="card-title">BILLING SETUP</h5></font>
												
												<div class="mb-3">
													<input type="hidden" name="secret_key" value="2" />
													<label for="mincon" class="form-label">Minimum Consumption</label>
													<input type="text" id="mincon" name="mincon" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sysconfig['mincon']; ?>">
												</div>
												
												<div class="mb-3">
													<label class="form-label">Minimum Consumption Price</label>
													<div class="input-group flex-nowrap">
														<span class="input-group-text" id="basic-addon1">₱</span>
														<input type="text" id="mincon_price" name="mincon_price" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sysconfig['mincon_price']; ?>" aria-label="Balance" aria-describedby="basic-addon1">
													</div>
												</div>
												
												<div class="mb-3">
													<label class="form-label">Regular Consumption Price</label>
													<div class="input-group flex-nowrap">
														<span class="input-group-text" id="basic-addon1">₱</span>
														<input type="text" id="excd_price" name="excd_price" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sysconfig['excd_price']; ?>" aria-label="Balance" aria-describedby="basic-addon1">
													</div>
												</div>
												
												<div class="mb-3">
													<label class="form-label">Reconnection Fee</label>
													<div class="input-group flex-nowrap">
														<span class="input-group-text" id="basic-addon1">₱</span>
														<input type="text" id="reconfee" name="reconfee" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sysconfig['reconfee']; ?>" aria-label="Balance" aria-describedby="basic-addon1">
													</div>
												</div>
												
												<div class="mb-3">
													<label for="penalty_percent" class="form-label">Penalty ( Percentage )</label>
													<input type="text" id="penalty_percent" name="penalty_percent" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sysconfig['penalty_percent']; ?>">
												</div>
												
												<div class="row">
														<label for="due_settings" class="form-label">Due Date [ <font color="blue"><?php echo $sysconfig['due_settings']," ",$sysconfig['due_settings2'],"(s)"; ?> after scanned date.</font> ]</label>
														<div class="col-md-12 col-lg-6">
															<div class="mb-3">
																	<input type="text" id="due_settings" name="due_settings" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sysconfig['due_settings']; ?>">
															</div>
														</div>
														<div class="col-md-12 col-lg-6">
															<div class="mb-3">
																<select class="form-control select2" data-toggle="select2" id="due_settings2" name="due_settings2">
																		<option value="<?php echo $sysconfig['due_settings2']; ?>">--Please choose an option--</option>
																		<option value="day">Day(s)</option>
																		<option value="week">Week(s)</option>
																		<option value="month">Month(s)</option>
																</select>
															</div>
														</div>
												</div>
												
												<div class="row">
														<label for="dis_settings" class="form-label">Disconnection Date [ <font color="blue"><?php echo $sysconfig['dis_settings']," ",$sysconfig['dis_settings2'],"(s)"; ?> after due date.</font> ]</label>
														<div class="col-md-12 col-lg-6">
															<div class="mb-3">
																	<input type="text" id="dis_settings" name="dis_settings" class="form-control" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sysconfig['dis_settings']; ?>">
															</div>
														</div>
														<div class="col-md-12 col-lg-6">
															<div class="mb-3">
																<select class="form-control select2" data-toggle="select2" id="dis_settings2" name="dis_settings2">
																		<option value="<?php echo $sysconfig['dis_settings2']; ?>">--Please choose an option--</option>
																		<option value="day">Day(s)</option>
																		<option value="week">Week(s)</option>
																		<option value="month">Month(s)</option>
																</select>
															</div>
														</div>
												</div>
												
													<div class="mb-3">
														<button class="btn btn-primary" name="submit" id="submit" type="submit">Update Billing Information</button>
													</div>
											</form>
											</div>
										</div>
									</div>
								</div>
							</div><!-- end col -->
							<div class="col-md-6 col-lg-6">
								<div class="card d-block">
									<div class="card-body">
									<form action="commands/uploadlogo.php" method="post" enctype="multipart/form-data">
										<center><h5 class="card-title">SYSTEM LOGO</h5></center>
										<div class="form-group d-flex justify-content-center">
											<img src="upload/<?php echo $sysconfig['company_logo']; ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
										</div>
										<center><h5>Recommended Size[ 350 x 1500 ]</h5></center>
										<center><div class="col-md-12 col-lg-6">
										<div class="mb-3">
											<input type="file" class="form-control" id="imglogo" name="imglogo" onchange="displayImg(this,$(this))">
										</div>
										<div class="mb-3">
											<button class="btn btn-primary" name="submit" id="submit" type="submit">Update System Logo</button>
										</div>
										</div></center>
									</form>
									</div>
									<div class="card-body">
										<form action="commands/uploadslogo.php" method="post" enctype="multipart/form-data">
										<center><h5 class="card-title">SYSTEM LOGO ( Minimized )</h5></center>
										<div class="form-group d-flex justify-content-center">
											<img src="upload/<?php echo $sysconfig['company_slogo']; ?>" alt="" id="cimg2" class="img-fluid img-thumbnail">
										</div>
										<center><h5>Recommended Size[ 350 x 350 ]</h5></center>
										<center><div class="col-md-12 col-lg-6">
										<div class="mb-3">
											<input type="file" class="form-control" id="imgslogo" name="imgslogo" onchange="displayImg2(this,$(this))">
										</div>
										<div class="mb-3">
											<button class="btn btn-primary" name="submit" id="submit" type="submit">Update Minimized Logo</button>
										</div>
										</div></center>
										</form>
									</div>
								</div>
							</div><!-- end col -->
                        </div>
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
	<?php if (isset($_SESSION['status'])) : ?>
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
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg2(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg2').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	</script>
	<script>
	$(document).ready(function(){
	$('#syssetup').submit(function(e){
			e.preventDefault();
			$('#syssetup [name="submit"]').attr('disabled',true)
			$('#syssetup [name="submit"]').html('Saving...')
			$('#msg').html('')
			$.ajax({
				url:'./commands/update_system.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#syssetup [name="submit"]').removeAttr('disabled')
					$('#syssetup [name="submit"]').html('Save')
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
	$('#billsetup').submit(function(e){
			e.preventDefault();
			$('#billsetup [name="submit"]').attr('disabled',true)
			$('#billsetup [name="submit"]').html('Saving...')
			$('#msg').html('')
			$.ajax({
				url:'./commands/update_system.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#billsetup [name="submit"]').removeAttr('disabled')
					$('#billsetup [name="submit"]').html('Save')
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
	})
	</script>	
</html>