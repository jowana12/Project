<?php

session_start();


if(!empty($_SESSION["admin_id"])){
	destroy();
	header("location: ../admin-login.php");
	exit();
}

if($_SESSION["type"] == "Student" || "Student Leader"){
	destroy();
	header("location: ../students-login.php");
	exit();
}



function destroy(){
	session_unset();
	session_destroy();
}