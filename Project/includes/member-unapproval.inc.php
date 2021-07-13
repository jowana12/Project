<?php

$id = isset($_GET['id'])? $_GET['id'] : "";
$dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");

$reg = $dbh->prepare("select * from project.registration where reg_id=?");
$reg->bindParam(1, $id);
$reg->execute();
$org_id = $reg->fetch();


$statement = $dbh->prepare("delete from project.registration where reg_id=?");
$statement->bindParam(1, $id);
$statement->execute();

header("location: ../organization-members-approval.php?id=".$org_id['org_id']);
exit();