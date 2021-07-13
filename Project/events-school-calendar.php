<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Announcement">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/events-school-calendar.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>SLEP: School Calendar</title>
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
                        echo "<li><a href='includes/osa-dashboard.inc.php'>Dashboard</a></li>
                    <li><a href='includes/osa-announcement.inc.php'>Announcements</a></li>
                    <li><a href='includes/events.inc.php'>Events</a></li>
                    <li><a href='includes/osa-profile.inc.php'>Profile</a></li>";
                    }
                    ?>
                    
                </ul>
            </nav>
            <a class="logout" href="includes/logout.inc.php"><button>Logout</button></a>
        </header>
    
        <div class="title">
            <h1 class="title-header">Activity Calendar</h1>
            <hr>
        </div>
    
    <?php
        if(!empty($_SESSION["admin_id"])){
            echo "
            <div class='div-side-by-side'>
            <div class='left-div'>

            <form action='includes/calendar.inc.php' method='POST'>
                <label class='label-header'>
                    <h3>Activity Name:</h3>
                    <input class='input-field' type='text' name='name'>
                </label>
                <br>

                <label class='label-header'>
                    <br>
                    <h3>Activity Description:</h3>
                    <input class='input-field' type='text' name='description'>
                </label>
                <br>

                <label class='label-header'>
                    <br>
                    <h3>Date:</h3>
                    <input class='input-field' type='date' name='date'>
                </label>
                <br>

                <label class='label-header'>
                    <br>
                    <h3>Venue:</h3>
                    <input class='input-field' type='text' name='venue'>
                </label>
                <br>

                <button type='submit' name='submit' class='btn-update'>Update</button>
                </form>
            </div>

            <div class='right-div'>
                <div class='container'>
                    <div class='calendar'>
                      <div class='month'>
                        <i class='fas fa-angle-left prev'></i>
                        <div class='date'>
                          <h1></h1>
                          <p></p>
                        </div>
                        <i class='fas fa-angle-right next'></i>
                      </div>
                      <div class='weekdays'>
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                      </div>
                      <div class='days'></div>
                    </div>
                </div>

            </div>


        </div>
        <br>
        <br>
            ";
        }
    ?>

    <?php
        if(!empty($_SESSION["student_id"])){
            $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
            $statement = $dbh->prepare("select * from project.calendar order by date asc");
            $statement->execute();
            if($statement->rowCount() < 1){
            header("location: events-school-calendar-error.php");
            exit();


        }
            
        }
        

    ?>
        

        <div class="main-body">
            <div class="list-container">
                <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                $statement = $dbh->prepare("select * from project.calendar order by date asc");
                $statement->execute();
               
                    while($row = $statement->fetch()){
                    echo"
                        <div class='list-image'>
                            <div class='preview'>
                                <h1 class='cal-date'>".$row['date_day']."</h1>
                                <h3 class='cal-month'>".$row['date_month']."</h3>
                                <h3 class='cal-year'>".$row['date_year']."</h3>
                            </div>
            
                            <div class='list-info'>
                                <h2 class='activity-name'>".$row['name']."</h2>
                                <h3 class='activity-venue'>at ".$row['venue']."</h3>
                                <p class='caption'>".$row['description']."</p>
                            </div>
                        </div>
                        <br>
                    ";
                  }
                
                    
                ?>
            </div>
        </div>
    <script src="javascript/calendar.js"></script>
</body>
</html>
