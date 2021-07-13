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
    if(empty($_SESSION["admin_id"]) && empty($_SESSION["student_id"])){
    header("location: ../Project/students-login.php");
    exit();
    }


    ?>
        <header>
            <img class="logo" src="images/logo_yellow.png" alt="logo">
            <nav>
                <ul class="nav_links">
                    <?php
                    if(!empty($_SESSION["type"])){
                        if($_SESSION["type"] == "Student"){

                            echo "
                                <li><a href='includes/student-dashboard.inc.php'>Dashboard</a></li>
                                <li><a href='includes/student-announcement.inc.php'>Announcements</a></li>
                                <li><a href='includes/events.inc.php'>Events</a></li>
                                <li><a href='includes/student-profile.inc.php'>Profile</a></li>";
                                
                                
                        }else{
                            echo "
                            <li><a href='includes/student-leaders-dashboard.inc.php'>Dashboard</a></li>
                            <li><a href='includes/student-leaders-announcement.inc.php'>Announcements</a></li>
                                <li><a href='includes/events.inc.php'>Events</a></li>
                                <li><a href='includes/student-leaders-profile.inc.php'>Profile</a></li>";
                        }
                    }
                    
                    if(!empty($_SESSION["admin_id"])){
                        echo "
                                <li><a href='includes/osa-dashboard.inc.php'>Dashboard</a></li>
                                <li><a href='includes/osa-announcement.inc.php'>Announcements</a></li>
                                <li><a href='includes/events.inc.php'>Events</a></li>
                                <li><a href='includes/osa-profile.inc.php'>Profile</a></li>"

                        ;

                    }
                    ?>
                    
                </ul>
            </nav>
            <a class="logout" href="includes/logout.inc.php"><button>Logout</button></a>
        </header>
    
        <div class="title">
            <h1 class="title-header">School Calendar</h1>
            <hr>
        </div>

        <div class="main-content">
             <img style="width:100%" src="images/errormessages/nothingplannedyet.png" alt="error-messages">
            
        </div>

</body>
</html>