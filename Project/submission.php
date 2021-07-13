<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php
	$dbh = new PDO("mysql:host=localhost;dbname=project", "root", "");
	if(isset($_POST['btn'])){
		
		$stmt = $dbh->prepare("insert into fund_requests values('', ?, ?, ?, ?, ?)");
		$test1 = "test";
		$test2 = "test";
		$test3 = "1111.0";
		$test4 = "test";
		date_default_timezone_set("Asia/Manila");
		$date = date("M,d,Y h:i:s A");
		$stmt->bindParam(1, $test1);
		$stmt->bindParam(2, $test2);
		$stmt->bindParam(3, $test3);
		$stmt->bindParam(4, $test4);
		$stmt->bindParam(5, $date);
		$stmt->execute();
	}
	?>

	<form method="POST" enctype="multipart/form-data">
		<input type="text" name="org">
		<br>
		<input type="text" name="abb">
		<br>
		<input type="text" name="desc">
		<br>
		<input type="file" name="myfile">
		<br>loca
		<input type="file" name="myfile_two">
		<input type="submit" name="btn" value="Upload">
	</form>

	<br>

	<ol>
		<?php
		$stat = $dbh->prepare("select * from organizations");
		$stat->execute();
		while($row = $stat->fetch()){
			echo "<li><a target='_blank' href='view.php?id=". $row['organization_id']."'>".$row['organization_name']."</a></li>";
		}
		?>
	</ol>
</body>
</html>