<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Announcement">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/osa-profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Student Announcement</title>
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
                        $stat = $dbh->prepare("select * from project.admins where admin_id=?");
                        $stat->bindParam(1, $_SESSION["admin_id"]);
                        $stat->execute();
                        $row = $stat->fetch();

                        echo "
                            <div class='profile-container'>
                                <h3 class='profile-header'>Name:&nbsp;</h3>
                                <p class='profile-content'>".$row['first_name']. " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Position:&nbsp;</h3>
                                <p class='profile-content'>". $row['position'] ."</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Department:&nbsp;</h3>
                                <p class='profile-content'>" .$row['department']. "</p>
                            </div>
                        ";
            ?>
</body>
</html>