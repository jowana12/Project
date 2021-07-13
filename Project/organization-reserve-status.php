<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/organization-reserve-status.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Events</title>
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

             <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        $statement = $dbh->prepare("select * from project.reservations where org_id=? order by days desc");
                        $statement->bindParam(1, $id);
                        $statement->execute();
                        if($statement->rowCount() < 1){
                            header("location: organization-reserve-status-error.php?id=".$id);
                            exit();
                        }
                        while($row = $statement->fetch()){
                            $stat = $dbh->prepare("select * from project.organizations where organization_id=?");
                            $stat->bindParam(1, $id);
                            $stat->execute();
                            $org = $stat->fetch();

                            if($row['status'] == "APPROVED"){
                                echo "
                            <div class='list-container'>
                                <div class='list-image'>
                                    <div class='preview'>
                                        <img class='image' src='images/venue.png' alt='try'>
                                    </div>

                                    <div class='list-info'>
                                        <h2 class='org-name'>".$org['organization_name']."</h2>
                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Nature of Activity: &nbsp;</h3>
                                            <p class='profile-content'>".$row['nature']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Title of Activity:&nbsp;</h3>
                                            <p class='profile-content'>".$row['title']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (from):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_from']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (to):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_to']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Number of Attendees:&nbsp;</h3>
                                            <p class='profile-content'>".$row['attendees']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Venue:&nbsp;</h3>
                                            <p class='profile-content'>".$row['venue']."</p>
                                        </div>


                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Poster:&nbsp;</h3>
                                            <p class='profile-content' style='text-decoration:underline'><a href='' style='color:black'>".$row['poster']."</a></p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Date Checked:&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_checked']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Remarks:&nbsp;</h3>
                                            <p class='profile-content'>".$row['remarks']."</p>
                                        </div>

                                         <div class='profile-container'>
                                            <h3 class='profile-header'>Status:&nbsp;</h3>
                                            <p class='profile-content' style='color:green'>".$row['status']."</p>
                                        </div>

                                        <div class='buttons'>
                                            <button class='btn-download' style='visibility: hidden'>Download</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
                            }else if($row['status'] == "UNAPPROVED"){
                                echo "
                            <div class='list-container'>
                                <div class='list-image'>
                                    <div class='preview'>
                                        <img class='image' src='images/venue.png' alt='try'>
                                    </div>

                                    <div class='list-info'>
                                        <h2 class='org-name'>".$org['organization_name']."</h2>
                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Nature of Activity: &nbsp;</h3>
                                            <p class='profile-content'>".$row['nature']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Title of Activity:&nbsp;</h3>
                                            <p class='profile-content'>".$row['title']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (from):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_from']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (to):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_to']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Number of Attendees:&nbsp;</h3>
                                            <p class='profile-content'>".$row['attendees']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Venue:&nbsp;</h3>
                                            <p class='profile-content'>".$row['venue']."</p>
                                        </div>


                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Poster:&nbsp;</h3>
                                            <p class='profile-content' style='text-decoration:underline'><a href='' style='color:black'>".$row['poster']."</a></p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Date Checked:&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_checked']."</p>
                                        </div>

                                         <div class='profile-container'>
                                            <h3 class='profile-header'>Status:&nbsp;</h3>
                                            <p class='profile-content' style='color:red'>".$row['status']."</p>
                                        </div>

                                        <div class='buttons'>
                                            <button class='btn-download' style='visibility: hidden'>Download</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            ";
                            }else{
                                echo "
                            <div class='list-container'>
                                <div class='list-image'>

                                    <div class='preview'>
                                        <img class='image' src='images/venue.png' alt='try'>
                                    </div>

                                    <div class='list-info'>
                                        <h2 class='org-name'>".$org['organization_name']."</h2>
                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Nature of Activity: &nbsp;</h3>
                                            <p class='profile-content'>".$row['nature']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Title of Activity:&nbsp;</h3>
                                            <p class='profile-content'>".$row['title']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (from):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_from']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (to):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_to']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Number of Attendees:&nbsp;</h3>
                                            <p class='profile-content'>".$row['attendees']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Venue:&nbsp;</h3>
                                            <p class='profile-content'>".$row['venue']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Poster:&nbsp;</h3>
                                            <p class='profile-content' style='text-decoration:underline'><a href='' style='color:black'>".$row['poster']."</a></p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Date Checked:&nbsp;</h3>
                                            <p class='profile-content'>".$row['status']."</p>
                                        </div>

                                         <div class='profile-container'>
                                            <h3 class='profile-header'>Status:&nbsp;</h3>
                                            <p class='profile-content'>".$row['status']."</p>
                                        </div>

                                        <div class='buttons'>
                                            <button class='btn-download' style='visibility: hidden'>Download</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
                            }
                            
                        }

            ?>

                   
        </div>

</body>
</html>