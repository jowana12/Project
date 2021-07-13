<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/osa-approval-venue.css">
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
            <h1 class="title-header">Approval of Venue Reservation</h1>
            <hr>
        </div>

        <div class="main-content">
            <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $statement = $dbh->prepare("select * from project.reservations where status=? order by days desc");
                        $status = "PENDING";
                        $statement->bindParam(1, $status);
                        $statement->execute();
                         if($statement->rowCount() < 1){
                            header("location: osa-approval-venue-error.php");
                                exit();
                            }
                        
                        while($row = $statement->fetch()){
                            $stat = $dbh->prepare("select * from project.organizations where organization_id=?");
                            $stat->bindParam(1, $row['org_id']);
                            $stat->execute();
                           
                            $org = $stat->fetch();


                            $date_db = strtotime($row['days']);
                            $date_db = date("Y-m-d", $date_db);
                            $date_db = strtotime($date_db);
                            date_default_timezone_set("Asia/Manila");
                            $date_now = strtotime(date("Y-m-d"));
                            $date_difference = abs(round(($date_now - $date_db)/60/60/24));
                            if($row['status'] == "PENDING"){

                                if($date_difference < 3){
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
                                            <h3 class='profile-header'>Date Requested:&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_applied']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Aging:&nbsp;</h3>
                                            <p class='profile-content'>".$date_difference." Days ago</p>
                                        </div>

                                        <form action='includes/approve.venue.inc.php?id=".$row['reservation_id']."' method='POST'>
                                        <div class='input-container'>
                                            <input class='input-field' type='text' name='remarks' placeholder='Input Remarks'>
                                        </div>

                                        <div class='buttons'>
                                            <button class='btn-download two' type='submit' name='submit'>Approve</button></a>
                                            <button class='btn-revise' type='delete' name='delete'>Unapprove</button>
                                        </div>
                                        </form>
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
                                        <h3 class='profile-header'>Date Requested:&nbsp;</h3>
                                        <p class='profile-content'>".$row['date_applied']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Aging:&nbsp;</h3>
                                            <p class='profile-content' style='color:red'>".$date_difference." Days ago</p>
                                        </div>
                                        <form action='includes/approve.venue.inc.php?id=".$row['reservation_id']."' method='POST'>
                                        <div class='input-container'>
                                            <input class='input-field' type='text' name='remarks' placeholder='Input Remarks'>
                                        </div>

                                        <div class='buttons'>
                                            <button class='btn-download two' type='submit' name='submit'>Approve</button></a>
                                            <button class='btn-revise' type='delete' name='delete'>Unapprove</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            ";
                                }
                                
                            }
                        }
                ?>
           
        </div>
</body>
</html>