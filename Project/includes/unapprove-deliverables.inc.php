<?php

$id = isset($_GET['id'])? $_GET['id'] : "";

$dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
$statement = $dbh->prepare("update project.deliverables set status=?, remarks=? where deliverable_id=?");
$approve = "UNAPPROVED";
$remarks = $_POST['remarks'];
if(empty($remarks)){
	$remarks = "NONE";
}

$statement->bindParam(1, $approve);
$statement->bindParam(2, $remarks);
$statement->bindParam(3, $id);
$statement->execute();

header("location: ../osa-approval-deliverables.php");
exit();