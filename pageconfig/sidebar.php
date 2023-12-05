<body class="loading" data-layout-config='{"leftSideBarTheme":"light","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": false}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">
    
                <!-- LOGO -->
                <a href="index.php" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="upload/<?php echo $sysconfig['company_logo']; ?>" alt="" height="50">
                    </span>
                    <span class="logo-sm">
                        <img src="upload/<?php echo $sysconfig['company_slogo']; ?>" alt="" height="50">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="index.php" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="upload/<?php echo $sysconfig['company_logo']; ?>" alt="" height="50">
                    </span>
                    <span class="logo-sm">
                        <img src="upload/<?php echo $sysconfig['company_slogo']; ?>" alt="" height="50">
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar="">

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Navigation</li>

						<li class="side-nav-item">
                            <a href="index.php" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
						
						<li class="side-nav-item">
                            <a href="consumers.php" class="side-nav-link">
                                <i class="dripicons-user-group"></i>
                                <span> Consumers </span>
                            </a>
                        </li>
						<?php 
						$billcount = $conn->query("SELECT * from billings where billing_status = 0");
						$billcount = $billcount->num_rows;
						?>
						<li class="side-nav-item">
                            <a href="billings.php" class="side-nav-link">
                                <i class="uil-wallet"></i>
								<?php if ( $billcount != 0 ) : ?>
								<span class="badge bg-success float-end"><?php echo $billcount ?></span>
								<?php endif;?>
                                <span> Billings </span>
                            </a>
                        </li>
						
                    </ul>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->