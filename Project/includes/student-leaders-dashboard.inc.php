<?php

session_start();

if(!empty($_SESSION["student_id"])){
	header("location: /Project/student-leaders-dashboard.php");
	exit();
}else{
	header("location: ../Project/students-login.php");
	exit();
}