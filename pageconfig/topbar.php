	<div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">

                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                    <i class="dripicons-gear noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar"> 
										<?php
										$getimage = $conn->query("SELECT * from admin_account where id = ".$_SESSION['login_id']);
										$image= $getimage->fetch_assoc();
										?>
                                        <img src="upload/<?php echo $image['image']; ?>" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name"><?php  echo $image['first_name']," ",$image['last_name'] ?></span>
                                        <span class="account-position"><?php  if ( $image['user_level'] <= 0 ) { echo "Administrator"; } else { echo "Cashier"; } ?></span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <!-- item-->
                                    <a href="adminprofile.php" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>My Account</span>
                                    </a>
									<?php if($_SESSION['login_user_level'] < 1): ?>
									<!-- item-->
                                    <a href="system.php" class="dropdown-item notify-item">
                                        <i class="mdi mdi-home-edit me-1"></i>
                                        <span>System Settings</span>
                                    </a>
									<?php endif; ?>
                                    <!-- item-->
                                    <a href="commands/logout.php" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>