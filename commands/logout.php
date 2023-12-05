<?php 
session_start();
$login = $_SESSION['login_user_level'];
session_destroy();
if($login == 1){
	header('location:../index.php?logout=logout');
}else{
	header('location:../index.php?logout=logout');
}
?>