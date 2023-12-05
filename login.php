<?php 
        session_start();
        if(isset($_SESSION['login_id'])){
            header('Location:index.php');
        }
		
		include 'commands/connectDB.php';		
		$sysc = $conn->query("SELECT * FROM system_config where id = 1");
		$sysconfig = $sysc->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | Water Billing System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="upload/<?php echo $sysconfig['company_slogo']; ?>">
        
        <!-- App css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>
    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": false}'>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <a href="index.html">
                                    <span><img src="upload/<?php echo $sysconfig['company_logo']; ?>" alt="" height="80"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">

			<?php  
				if (isset($_GET['error'])) {
					if ($_GET['error'] == "error1") {
						echo '<div class="alert alert-danger">
						<center>Invalid username or password.</center>
						</div>';
					}
					elseif ($_GET['error'] == "sqlerror") {
						echo '<div class="alert alert-danger">
                        <center>Theres a database error.</center>
						</div>';
					}
				}
				if (isset($_GET['logout'])) {
					if ($_GET['logout'] == "logout") {
						echo '<div class="alert alert-success">
                        <center>Successfully Logged Out.</center>
						</div>';
					}
				}
				if (isset($_GET['reset'])) {
					if ($_GET['reset'] == "success") {
						echo '<div class="alert alert-success">
                        <center>Check your E-mail!</center>
						</div>';
					}
				}
				if (isset($_GET['account'])) {
					if ($_GET['account'] == "activated") {
						echo '<div class="alert alert-success">
                        <center>Please Login</center>
						</div>';
					}
				}
				if (isset($_GET['active'])) {
					if ($_GET['active'] == "success") {
						echo '<div class="alert alert-success">
						<center>The activation like has been sent!</center>
						</div>';
					}
				}
			?>
                                <form id="login-frm">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input class="form-control" type="username" name="username" id="username" required="" placeholder="Enter your username">
                                    </div>

                                    <div class="mb-3">
                                        <a href="#" class="text-muted float-end"><small>Forgot your password?</small></a>
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-0 text-center">
                                        <button class="btn btn-primary" type="submit" name="submit" id="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            2022 © Tempest - imaqtdan@gmail.com
        </footer>

        <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
		
    </body>
	<script>
            $(document).ready(function(){
                $('#login-frm').submit(function(e){
                    e.preventDefault()
                    $('#login-frm button').attr('disable',true)
                    $('#login-frm button').html('Please wait...')

                    $.ajax({
                        url:'./commands/check_login.php',
                        method:'POST',
                        data:$(this).serialize(),
                        error:err=>{
                            console.log(err)
                            alert('An error occured');
                            $('#login-frm button').removeAttr('disable')
                            $('#login-frm button').html('Login')
                        },
                        success:function(resp){
                            if(resp == 1){
                                location.replace('index.php')
                            }else{
                                window.location="login.php?error=error1";
                                $('#login-frm button').removeAttr('disable')
                                $('#login-frm button').html('Login')
                            }
                        }
                    })

                })
            })
	</script>
</html>
