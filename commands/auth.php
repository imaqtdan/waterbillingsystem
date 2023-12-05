<?php
 session_start();
    if(!(isset($_SESSION['login_id']))){ header("location:login.php"); }
    else{ $email = $_SESSION['login_email']; }
	
	$sysc = $conn->query("SELECT * FROM system_config where id = 1");
	$sysconfig = $sysc->fetch_assoc();
	
	
?>