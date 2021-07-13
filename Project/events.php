<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/events.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <h1 class="title-header">Events</h1>
            <hr>
        </div>

        <div class="main-content">
            <div class="main-body">
            <div class="grid-container">


                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/calendar.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">School Calendar</h1>
                            <p class="card-text">View and access the latest school or activity calendar to be updated about the several activities hosted by the instution or by our hardworking student leader to make your stay here in T.I.P. memorable and to schedule your time and use time management.</p>
                            <a href="events-school-calendar.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>

                <?php

                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $stat = $dbh->prepare("select * from project.events");
                        $stat->execute();
                        while($row = $stat->fetch()){
                            echo "<div class='grid-items'>
                                    <div class='card'>
                                        <img class='card-img' src='includes/showimage-events.inc.php?id=".$row['event_id']."' alt='Logo'>
                                        <div class='card-content'>
                                        <h1 class='card-header'>".$row['event_name'] . "</h1>
                                        <p class='card-text'>The Yellow and Black Festival is an annual event which gathers the Recognized Student Organizations of T.I.P. Manila for an exciting week of friendly competition. It also serves as a platform for students to join the organizations they want to grow with.</p>
                                        <a href='includes/event-details.inc.php?id=".$row['event_id']."'><button class='card-btn' href='#'>Visit &nbsp; <span> &rarr; </span></button></a>
                                        </div>
                                    </div>
                                </div>    
                            ";
                        }
                ?>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/freshmen-day.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Freshmen Day</h1>
                            <p class="card-text">At the start of each academic year, colleges and universities hold an orientation program. The entire freshman class, new students get to meet their college classmates for the first time. Upper classmen, faculty members give a heads up to what college life is.</p>
                            <a href="events-freshmen-day.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/sports-festival.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Sports Festival</h1>
                            <p class="card-text">The objectives of the Sports Festival are to celebrate May as National Physical Fitness and Sports month and to provide an incentive day for physical education students who maintain an A or B grade in physical education class and are academically eligible.</p>
                            <a href="events-sports-festival.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/nolac.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Night of Lights and Carols</h1>
                            <p class="card-text">Choir competitions allow for the giving and receiving of inspiration. As much as conductors work to motivate, encourage and inspire choirs, peer inspiration is even more effective. In short, children inspire children, and most effectively through live performance</p>
                            <a href="events-nolac.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/foundation-week.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Foundation Week</h1>
                            <p class="card-text">Every year, schools and universities celebrate their respective foundation days to commemorate the day when the school was founded or established. It is significant because of the number of years it has served the community where a school belongs to.</p>
                            <a href="events-foundation-week.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/department-days.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Department Days</h1>
                            <p class="card-text">Participate in the annual celebration of your department's day through joining in several activities provided by the Department Student Council to create camaraderie between your fellow students.</p>
                            <a href="events-department-days.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

</div>
</body>
</html>


        