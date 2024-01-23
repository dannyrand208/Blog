<?php 

	include('Functions.php');
	deleteCookie('CookieUser');
	session_destroy();
	redirect('home.php');
	
	
?>
