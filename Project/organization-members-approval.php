<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/organization-members-approval.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Organization</title>
</head>
<body>
        <?php
    session_start();
    if(empty($_SESSION["student_id"])){
    header("location: ../Project/students-login.php");
    exit();
    }
?>
        <header>
            <img class="logo" src="images/logo_yellow.png" alt="logo">
            <nav>
                <ul class="nav_links">
                    <li><a href="includes/student-leaders-dashboard.inc.php">Dashboard</a></li>
                    <li><a href="includes/student-leaders-announcement.inc.php">Announcements</a></li>
                    <li><a href="includes/events.inc.php">Events</a></li>
                    <li><a href="includes/student-leaders-profile.inc.php">Profile</a></li>
                </ul>
            </nav>
            <a class="logout" href="includes/logout.inc.php"><button>Logout</button></a>
        </header>
    
        <?php
            $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
            $id = isset($_GET['id'])? $_GET['id'] : "";
            $stat = $dbh->prepare("select * from project.organizations where organization_id=?");
            $stat->bindParam(1, $id);
            $stat->execute();
            $row = $stat->fetch();
            echo "
                 <div class='title'>
                    <h1 class='title-header'>".$row['organization_name']."</h1>
                    <hr>
                </div>
            ";
            ?>

        <div class="main-content">

            <div class="table-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student Number</th>
                            <th>Student Name</th>
                            <th>Registration Date</th>
                            <th>Proof of Payment</th>
                            <th>Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        $stat = $dbh->prepare("select * from project.registration where org_id=? and p_status=?");
                        $status = "PAID";
                        $stat->bindParam(1, $id);
                        $stat->bindParam(2, $status);
                        $stat->execute();                  
                        if($stat->rowCount() > 0){
                            while($row = $stat->fetch()){
                            $user_stat = $dbh->prepare("select * from project.users where id_number=?");
                            $user_stat->bindParam(1, $row['student_id']);
                            $user_stat->execute();
                            $user_row = $user_stat->fetch();
                            echo"
                            <tr>
                                <th>". $row['student_id'] ."</th>
                                <th>". $user_row['firstname'] . " " . $user_row['lastname'] ."</th>
                                <th>". $row['date_registered']. "</th>
                                <th><a class='receipt' target='_blank' href='includes/show-receipt.inc.php?id=".$row['reg_id']. "' style='color:black; text-decoration:underline'>". $row['receipt']. "</a></th>
                                <th>". $row['date_paid']. "</th>
                                <th>
                                    <a href='includes/member-approval.inc.php?id=".$row['reg_id']."'><button class='table-button-1'>APPROVE</button></a>
                                    <a href='includes/member-unapproval.inc.php?id=".$row['reg_id']."'><button class='table-button-2'>DELETE</button></a>
                                </th>
                            </tr>
                            ";
                        }
                    }else{
                        header("location: organization-members-approval-error.php?id=".$id);
                        exit();
                    }
                       
                        ?>

                    </tbody>

                </table>
            </div>
            
        </div>

</body>
</html>