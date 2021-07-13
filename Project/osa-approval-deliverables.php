<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/osa-approval-deliverables.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Events</title>
</head>
<body>
        <?php
    session_start();
    if(empty($_SESSION["admin_id"])){
    header("location: ../Project/admin-login.php");
    exit();
    }
    ?>
        <header>
            <img class="logo" src="images/logo_yellow.png" alt="logo">
            <nav>
                <ul class="nav_links">
                    <li><a href="includes/osa-dashboard.inc.php">Dashboard</a></li>
                    <li><a href="includes/osa-announcement.inc.php">Announcements</a></li>
                    <li><a href="includes/events.inc.php">Events</a></li>
                    <li><a href="includes/osa-profile.inc.php">Profile</a></li>
                </ul>
            </nav>
            <a class="logout" href="includes/logout.inc.php"><button>Logout</button></a>
        </header>
    
        <div class="title">
            <h1 class="title-header">Approval of Deliverables</h1>
            <hr>
        </div>

        <div class="main-content">
           
                <?php
                    $status = "PENDING";
                    $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                    $statement = $dbh->prepare("select * from project.deliverables where status=?");
                    $statement->bindParam(1, $status);
                    $statement->execute();
                    if($statement->rowCount() < 1){
                        header("location: osa-approval-deliverables-error.php?");
                        exit();
                    }
                    while($row = $statement->fetch()){

                        $date_db = strtotime($row['days']);
                        $date_db = date("Y-m-d", $date_db);
                        $date_db = strtotime($date_db);
                        date_default_timezone_set("Asia/Manila");
                        $date_now = strtotime(date("Y-m-d"));
                        $date_difference = abs(round(($date_now - $date_db)/60/60/24));

                        if($date_difference < 3){
                            echo"
                         <div class='list-container'>
                        <div class='list-image'>
                        <div class='preview'>
                            <img class='image' src='images/doc.png' alt='try'>
                        </div>

                        <div class='list-info'>
                            <h2 class='org-name'>".$row['org_name']."</h2>
                            <div class='profile-container'>
                                <h3 class='profile-header'>Type of Document: &nbsp;</h3>
                                <p class='profile-content'>".$row['file']."</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Uploaded Document:&nbsp;</h3>
                                <a target='_blank' href='includes/download-file.inc.php?id=".$row['deliverable_id']."'><p class='profile-content' style='text-decoration:underline; color:black'>".$row['document']."</p></a>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Date Submitted:&nbsp;</h3>
                                <p class='profile-content'>".$row['date_submitted']."</p>
                            </div>

                           <div class='profile-container'>
                                <h3 class='profile-header'>Aging:&nbsp;</h3>
                                <p class='profile-content'>".$date_difference." Days ago</p>
                            </div>

                            <form action='includes/approve-deliverables.inc.php?id=".$row['deliverable_id']."' method='POST'>
                            <div class='input-container'>
                                <input class='input-field' type='text' name='remarks' placeholder='Input Remarks'>
                            </div>
                           
                            <div class='buttons'>
                                <button class='btn-download two' type='submit' name='submit'>Approve</button></a>
                                <button class='btn-revise' type='delete' name='delete'>Unapprove</button></a>
                            </div>
                            </form>
                            </div>
                        </div>
                        <br>
                        ";
                        }else{
                            echo"
                         <div class='list-container'>
                        <div class='list-image'>
                        <div class='preview'>
                            <img class='image' src='images/doc.png' alt='try'>
                        </div>

                        <div class='list-info'>
                            <h2 class='org-name'>".$row['org_name']."</h2>
                            <div class='profile-container'>
                                <h3 class='profile-header'>Type of Document: &nbsp;</h3>
                                <p class='profile-content'>".$row['file']."</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Uploaded Document:&nbsp;</h3>
                                <a target='_blank' href='includes/download-file.inc.php?id=".$row['deliverable_id']."'><p class='profile-content' style='text-decoration:underline; color:black'>".$row['document']."</p></a>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Date Submitted:&nbsp;</h3>
                                <p class='profile-content'>".$row['date_submitted']."</p>
                            </div>

                           <div class='profile-container'>
                                <h3 class='profile-header'>Aging:&nbsp;</h3>
                                <p class='profile-content' style='color:red'>".$date_difference." Days ago</p>
                            </div>

                            <form action='includes/approve-deliverables.inc.php?id=".$row['deliverable_id']."' method='POST'>
                            <div class='input-container'>
                                <input class='input-field' type='text' name='remarks' placeholder='Input Remarks'>
                            </div>
                           
                            <div class='buttons'>
                                <button class='btn-download two' type='submit' name='submit'>Approve</button>
                                <button class='btn-revise' type='delete' name='delete'>Unapprove</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        <br>
                        ";
                        }
                        
                    }
                ?>
                
            </div>

        </div>
</body>
</html>