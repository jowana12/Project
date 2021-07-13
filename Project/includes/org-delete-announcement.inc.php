<?php

$id = isset($_GET['id'])? $_GET['id'] : "";
$org = isset($_GET['org'])? $_GET['org'] : "";
$dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");

$statement = $dbh->prepare("delete from project.announcements where announcement_id=?");
$statement->bindParam(1, $id);
$statement->execute();

if($org > 0){
	header("location: ../organization-announcement.php?id=".$org);
	exit();	
}else{
	header("location: ../osa-announcement.php");
	exit();	
}

