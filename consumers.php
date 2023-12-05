<!DOCTYPE html>
    <html lang="en">

    <head>
<?php
include 'commands/connectDB.php';
include 'commands/auth.php';
?>
        <meta charset="utf-8">
        <title><?php echo $sysconfig['system_name'];?> | Consumers</title>
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
                                    <h4 class="page-title">Consumers List</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
					<!-- my container start -->
					<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title"></h4>
                                        <p class="text-muted font-14"></p> <!-- end nav-->
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="scroll-vertical-preview">
                                                <table id="scroll-vertical-datatable" class="table dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Full Name</th>
                                                            <th>Address</th>
                                                            <th>Email</th>
                                                            <th>Contact Number</th>
															<th>Connection Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
													<?php
														$qry = $conn->query("SELECT f.*,u.balance,u.previous_read,u.previous_transaction,u.cstatus,u.create_date from consumer_account f left join consumer_data u on f.id = u.id order by u.id asc");
															if($qry->num_rows > 0){
																while($row= $qry->fetch_assoc()){
													?>
                                                        <tr>
                                                            <td><?php echo $row['consumer_id'] ?></td>
                                                            <td><?php echo $row['first_name']," ",$row['last_name'] ?></td>
                                                            <td><?php echo $row['address'],", ",$row['brg_address'],", ",$row['ct_address'],", ",$row['pro_address'] ?></td>
                                                            <td><?php echo $row['email'] ?></td>
                                                            <td><?php echo $row['contact'] ?></td>
															<td><?php echo $row['cstatus'] < 1 ? '<a href="#" class="badge bg-success changestatus" data-id="'.$row['consumer_id'].'" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Click to Disconnect.">ACTIVE</a>' : '<a href="#" class="badge bg-danger changestatus" data-id="'.$row['consumer_id'].'" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Click to Reconnect.">DISCONNECTED</a>' ?></td>
                                                            <td class="table-action">
																	<a href="consumerprofile.php?q=<?php echo $row['id'] ?>" class="action-icon" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="View Consumer's Data"> <i class="mdi mdi-account-box"></i></a>
                                                                    <a href="#" class="action-icon editconsumer" data-id="<?php echo $row['id']?>" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Edit Consumer's Data"> <i class="mdi mdi-account-edit"></i></a>
                                                                    <a href="#" class="action-icon deleteconsumer" data-id="<?php echo $row['id']?>" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-content="Delete Consumer's Data"> <i class="mdi mdi-delete"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
															}
														}
													?>
                                                    </tbody>
                                                </table>
												<br>
											<?php include 'modals/consumers_modal_conf.php'; ?>
                                            </div> <!-- end preview-->
                                        </div> <!-- end tab-content-->
                                        
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
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
		<!-- script src="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
		<!-- script src="cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="assets/js/pages/demo.datatable-init.js"></script>
        <!-- end demo js-->
		
		<!-- demo js -->
        <script src="assets/js/pages/demo.toastr.js"></script>
        <!-- -->
		
    </body>
	<?php $date = date('Y-m-d'); if (isset($_SESSION['status'])) : ?>
	<script>
	$.NotificationApp.send("Success!","<?php echo $_SESSION['status'] ?>","top-right","rgba(0,0,0,0.2)","success");
	</script>
	<?php unset($_SESSION['status']); endif;?>
	<script>
	$(document).ready(function(){
		$('#scroll-vertical-datatable').DataTable();
		$('#addconsumer').click(function(){
			$('#msg').html('')
			$('#bs-example-modal-lg .modal-title').html('<i class="mdi mdi-account-plus"></i> Add New Consumer')
			$('#bs-example-modal-lg #consumerform').get(0).reset()
			$('#bs-example-modal-lg').modal('show')
			$('[name="consumerid"]').val('0')
			$('[name="balance"]').attr('disabled','disabled');
			$('[name="balance"]').val('0')
			$('[name="tconsumed"]').attr('disabled','disabled');
			$('[name="tconsumed"]').val('0')
			$('[name="id"]').val('0')
			$('#bs-example-modal-lg [name="submit"]').html('<i class="mdi mdi-account-plus"></i> Save')
		})
		$('body').on('click','.editconsumer', function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./commands/get_consumer_info.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('#bs-example-modal-lg .modal-title').html('<i class="mdi mdi-pencil"></i> Edit Consumer')
						$('[name="id"]').val(resp.id)
						$('[name="consumerid"]').val(resp.consumer_id)
						$('[name="firstname"]').val(resp.first_name)
						$('[name="lastname"]').val(resp.last_name)
						$('[name="address"]').val(resp.address)
						$('[name="brg_address"]').val(resp.brg_address)
						$('[name="ct_address"]').val(resp.ct_address)
						$('[name="pro_address"]').val(resp.pro_address)
						$('[name="username"]').val(resp.username)
						$('[name="password"]').val(resp.password)
						$('[name="emailaddress"]').val(resp.email)
						$('[name="contact"]').val(resp.contact)
						$('[name="balance"]').removeAttr('disabled');
						$('[name="balance"]').val(resp.balance)
						$('[name="tconsumed"]').removeAttr('disabled');
						$('[name="tconsumed"]').val(resp.previous_read)
						$('#bs-example-modal-lg [name="submit"]').html('<i class="mdi mdi-pencil"></i> Update')
						$('#bs-example-modal-lg').modal('show')
					}
				}
			})
		})
		$('#consumerform').submit(function(e){
			e.preventDefault();
			//$('#consumerform [name="submit"]').attr('disabled',true)
			//$('#consumerform [name="submit"]').html('Saving...')
			//$('#msg').html('')
			$.ajax({
				url:'./commands/update_insert_consumer.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#consumerform [name="submit"]').removeAttr('disabled')
					$('#consumerform [name="submit"]').html('Save')
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
		$('body').on('click','.deleteconsumer', function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./commands/get_consumer_info.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						//$.NotificationApp.send("Error!","Test","top-right","rgba(0,0,0,0.2)","error")
						$('[name="id"]').val(resp.id)
						$('[name="consumerid"]').val(resp.consumer_id)
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
				url:'./commands/delete_consumer.php',
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
</html>