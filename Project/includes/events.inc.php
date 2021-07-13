<?php

session_start();

if(!empty($_SESSION["student_id"]) || !empty($_SESSION["admin_id"])){
	header("location: /Project/events.php");
	exit();
}else{
	header("location: ../Project/students-login.php");
	exit();
}