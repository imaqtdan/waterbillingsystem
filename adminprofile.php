<!DOCTYPE html>
    <html lang="en">

    <head>
<?php
include 'commands/connectDB.php';
include 'commands/auth.php';
$adminpro = $conn->query("SELECT * from admin_account where id = ".$_SESSION['login_id']);
$pro = $adminpro->fetch_assoc();

?>
        <meta charset="utf-8">
        <title><?php echo $sysconfig['system_name'];?> | My Profile</title>
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
                                    <h4 class="page-title">My Profile</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Profile -->
                                <div class="card bg-primary">
                                    <div class="card-body profile-user-box">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="avatar-xl">
                                                            <img src="upload/<?php echo $image['image']; ?>" alt="" class="rounded-circle img-thumbnail">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <h3 class="mt-1 mb-1 text-white"><?php echo $pro['first_name']," ",$pro['last_name'] ?></h3>
                                                            <p class="font-13 text-white-50"><?php if ( $pro['user_level'] < 1 ) { echo '<span class="badge bg-warning">ADMINISTRATOR</span>'; } else { echo '<span class="badge bg-info">CASHIER</span>'; } ?></p>
    

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col-->

                                            <div class="col-sm-4">
                                                <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                                    <button type="button" class="btn btn-light editprofile" data-id="<?php echo $_SESSION['login_id'] ?>">
                                                        <i class="mdi mdi-account-edit me-1"></i> Edit Profile
                                                    </button>
                                                </div>
                                            </div> <!-- end col-->
                                        </div> <!-- end row -->

                                    </div> <!-- end card-body/ profile-user-box-->
                                </div><!--end profile/ card -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-xl-4">
                                <!-- Personal-Information -->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">My Information</h4>
                                        <hr>
                                        <div class="text-start">
                                            <p class="text-muted"><strong>Full Address :</strong> <span class="ms-2"><?php echo $pro['address'] ?></span></p>
                                            <p class="text-muted"><strong>Contact Number :</strong><span class="ms-2"><?php echo $pro['contact'] ?></span></p>
                                            <p class="text-muted"><strong>Email :</strong> <span class="ms-2"><?php echo $pro['email'] ?></span></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Personal-Information -->

								<?php if($_SESSION['login_user_level'] < 1): ?>
                                <!-- Toll free number box-->
                                <div class="card text-white bg-info overflow-hidden">
                                    <div class="card-body">
                                        <div class="toll-free-box text-center">
                                            <button  type="button" class="btn btn-secondary" id="addadmin"><i class="mdi mdi-account-plus"></i>Add Account</button>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                                <!-- End Toll free number box-->
								<?php endif; ?>
								
                            </div> <!-- end col-->

                            <div class="col-xl-8">

                                <!-- Chart-->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">System Admin & Cashier Accounts</h4>
                                        <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap">
											<thead>
												<tr>
													<th>Full Name</th>
													<th>Address</th>
													<th>Email</th>
													<th>Contact</th>
													<th>Role</th>
													<?php if($_SESSION['login_user_level'] < 1): ?>
													<th>Action</th>
													<?php endif; ?>
												</tr>
											</thead>

											<tbody>
											<?php
												$qry = $conn->query("SELECT * from admin_account where id != ".$_SESSION['login_id']." order by id asc");
													if($qry->num_rows > 0){
														while($row= $qry->fetch_assoc()){
											?>
												<tr>
													<td class="table-user">
														<img src="upload/<?php echo $row['image']; ?>" alt="table-user" class="me-2 rounded-circle" />
														<?php echo $row['first_name']," ",$row['last_name'] ?>
													</td>
													<td><?php echo $row['address'] ?></td>
													<td><?php echo $row['email'] ?></td>
													<td><?php echo $row['contact'] ?></td>
													<td><?php if ( $row['user_level'] < 1 ) { echo '<span class="badge bg-warning">ADMINISTRATOR</span>'; } else { echo '<span class="badge bg-info">CASHIER</span>'; } ?></td>
													<?php if($_SESSION['login_user_level'] < 1): ?>
													<td>
														<a href="#" class="action-icon editprofile" data-id="<?php echo $row['id']?>" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Edit Account"> <i class="mdi mdi-account-edit"></i></a>
                                                        <a href="#" class="action-icon deleteadmin" data-id="<?php echo $row['id']?>" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Delete Account"> <i class="mdi mdi-delete"></i></a>
													</td>
													<?php endif; ?>
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
                        <?php include 'modals/admin_modal_conf.php'; ?>
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
	$(document).ready(function(){
		$('#addadmin').click(function(){
			$('#msg').html('')
			$('#scrollable-modal .modal-title').html('<i class="mdi mdi-account-plus"></i> New Account')
			$('#scrollable-modal #adminform').get(0).reset()
			$('[name="id"]').val('0')
			$('#scrollable-modal').modal('show')
			$("#scrollable-modal #adminimage").hide();
			$('#scrollable-modal [name="submit"]').html('<i class="mdi mdi-account-plus"></i> Confirm')
		})
		$('body').on('click','.editprofile', function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./commands/get_admin_info.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('#scrollable-modal .modal-title').html('<i class="mdi mdi-pencil"></i> Edit Consumer')
						$('#scrollable-modal #adminform').get(0).reset()
						$('[name="id"]').val(resp.id)
						$('[name="id2"]').val(resp.id)
						$('[name="firstname"]').val(resp.first_name)
						$('[name="lastname"]').val(resp.last_name)
						$('[name="address"]').val(resp.address)
						$('[name="username"]').val(resp.username)
						$('[name="password"]').val(resp.password)
						$('[name="email"]').val(resp.email)
						$('[name="contact"]').val(resp.contact)
						$('[name="user_level"]').val(resp.user_level)
						$('#scrollable-modal #adminimage').get(0).reset()
						$("#scrollable-modal #adminimage").show();
						$('#scrollable-modal [name="submit"]').html('<i class="mdi mdi-pencil"></i> Update')
						$('#scrollable-modal').modal('show')
					}
				}
			})
		})
		$('#adminform').submit(function(e){
			e.preventDefault();
			//$('#adminform [name="submit"]').attr('disabled',true)
			//$('#adminform [name="submit"]').html('Saving...')
			//$('#msg').html('')
			$.ajax({
				url:'./commands/update_insert_admin.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#adminform [name="submit"]').removeAttr('disabled')
					$('#adminform [name="submit"]').html('Save')
				},
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
		$('body').on('click','.deleteadmin', function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./commands/get_admin_info.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.id)
						$('#warning-alert-modal .del-fname').html(resp.first_name)
						$('#warning-alert-modal .del-lname').html(resp.last_name)
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
				url:'./commands/delete_admin.php',
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
	})
	</script>
</html>