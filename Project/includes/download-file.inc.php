<?php

$dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $dbh->prepare("select * from project.deliverables where deliverable_id=?");
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:'.$row['mime']);
echo $row['data'];