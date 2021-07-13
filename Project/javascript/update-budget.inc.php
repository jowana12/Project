<?php
session_start();

$id = isset($_GET['id'])? $_GET['id'] : "";

if(isset($_POST['submit'])){
	$event = $_POST['event'];
	$description = $_POST['description'];
	$expenses = $_POST['expenses'];

	$dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
	$statement = $dbh->prepare("select * from project.organizations where organization_id=?");
	$statement->bindParam(1, $id);
	$statement->execute();
	$row = $statement->fetch();
	echo "HELLO";	

	$updated_expenses = floatval($expenses) + $row['expenses'];
}