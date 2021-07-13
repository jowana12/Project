<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Announcement">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/students-profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Student Announcement</title>
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
                    <li><a href="includes/student-dashboard.inc.php">Dashboard</a></li>
                    <li><a href="includes/student-announcement.inc.php">Announcements</a></li>
                    <li><a href="includes/events.inc.php">Events</a></li>
                    <li><a href="includes/student-profile.inc.php">Profile</a></li>
                </ul>
            </nav>
            <a class="logout" href="includes/logout.inc.php"><button>Logout</button></a>
    </header>   
    
        <div class="title">
            <h1 class="title-header">Profile</h1>
            <hr>
        </div>

        <div class="main-content">
            <img class="profile-picture" src="images/user.png" alt="profile-picture">

            <br>
            <br>

            <label> 
                <h3 class="label-header">Personal Information</h3>
                <hr>
            </label>

            <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $stat = $dbh->prepare("select * from project.users where id_number=?");
                        $stat->bindParam(1, $_SESSION["student_id"]);
                        $stat->execute();
                        $row = $stat->fetch();

                       echo" <div class='profile-container'>
                                <h3 class='profile-header'>Student Number:&nbsp;</h3>
                                <p class='profile-content'>". $row['id_number'] ."</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Name:&nbsp;</h3>
                                <p class='profile-content'>".$row['firstname']. " " . substr($row['middlename'], 0, 1) . ". " . $row['lastname'] . "</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Program:&nbsp;</h3>
                                <p class='profile-content'>Bachelor of Science in ". $row['program'] ."</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Year-Level:&nbsp;</h3>
                                <p class='profile-content'>". $row['year_level'] ."</p>
                            </div>
                        ";
            ?>

            <br>
            <label> 
                <h3 class="label-header">Affiliations</h3>
                <hr>
            </label>
            <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $id = $_SESSION["student_id"];
                        $stat = $dbh->prepare("select * from project.officers where student_id=?");
                        $stat->bindParam(1, $id);
                        $stat->execute();
                        if(($stat->rowCount()) > 0){
                            if($_SESSION['type'] == "Student"){
                                while($row = $stat->fetch()){
                                    if($row['position'] == "Member"){
                                        $org_id = $row['organization_id'];
                                        $statement = $dbh->prepare("select * from project.organizations where organization_id=?");
                                        $statement->bindParam(1, $org_id);
                                        $statement->execute();
                                        while($org_row = $statement->fetch()){
                                            echo 
                                                "
                                                <div class='profile-container'>
                                                    <h3 class='profile-header'>".$org_row['organization_name']."&nbsp;</h3>
                                                    <br>
                                                </div>
                                                    ";
                                        }
                                    }
                                }
                            }                 
                        }else{
                            echo"
                            <img class='error-messages' style='width:100%;' src='images/errormessages/youarenotaffiliatedwithanystudentorganization.png' alt='error-messages'>
                            ";
                        }
                               
                    ?>
        
            
        </div>

</body>
</html>