<?php

session_start();

if(!empty($_SESSION["admin_id"])){
	header("location: /Project/osa-profile.php");
	exit();
}else{
	header("location: ../Project/admin-login.php");
	exit();
}