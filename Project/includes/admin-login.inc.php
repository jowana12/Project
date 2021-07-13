<?php

if(isset($_POST['submit'])){

	require_once 'connection.inc.php';
	require_once 'functions.login.inc.php';

	$admin_id = $_POST["input-id"];
	$admin_user = $_POST["input-email"];
	$admin_pwd = $_POST["input-password"];

	if(emptyInputLogin($admin_id, $admin_user, $admin_pwd) !== false){
		header("location: ../admin-login.php?error=EmptyInput");
		exit();
	}
	
	loginAdmin($conn, $admin_id, $admin_user, $admin_pwd);
}else{
	header("location: ../Project/admin-login.php");
	exit();
}