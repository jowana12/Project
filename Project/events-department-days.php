<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/events/gallery.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/events/lightbox.min.css">
    <script type="text/javascript" src="javascript/lightbox-plus-jquery.min.js"></script>
    <title>SLEP: Events</title>
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
            <h1 class="title-header">Department Days</h1>
            <hr>
        </div>
        <a href="images/next.png"></a>

        <div class="main-content">
            <div class="gallery">
            <a href="images/departmentdays1.jpg" data-lightbox="mygallery">
                <img src="images/smallerimage/smallerddays1.png"></a>
            <a href="images/departmentdays2.jpg" data-lightbox="mygallery">
                <img src="images/smallerimage/smallerddays2.png"></a>
            <a href="images/departmentdays3.jpg" data-lightbox="mygallery">
                <img src="images/smallerimage/smallerddays3.png"></a>
            <a href="images/departmentdays4.jpg" data-lightbox="mygallery">
                <img src="images/smallerimage/smallerddays4.png"></a>
            <a href="images/freshmenday1.jpg" data-lightbox="mygallery">
                <img src="images/smallerimage/smallerfreshmenday1.png"></a>
            <a href="images/freshmenday2.jpg" data-lightbox="mygallery">
                <img src="images/smallerimage/smallerfreshmenday2.png"></a>
            <a href="images/freshmenday3.jpg" data-lightbox="mygallery">
                <img src="images/smallerimage/smallerfreshmenday3.png"></a>
            <a href="images/freshmenday4.jpg" data-lightbox="mygallery">
                    <img src="images/smallerimage/smallerfreshmenday4.png"></a>
        </div>

        </div>

    </body>
</html>
