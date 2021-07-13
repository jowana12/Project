<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Announcement">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/student-announcement.css">
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
    <div class="main-content">
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
            <h1 class="title-header">Announcements</h1>
            <hr>
        </div>
    
        <div class="div-side-by-side">
            <div class="left-div">
            
                    <?php
                    $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                    $id = isset($_GET['id'])? $_GET['id'] : "";
                    $statement = $dbh->prepare("select * from project.announcements order by announcement_id desc");
                    $statement->execute();
                    if($statement->rowCount() > 0){
                         while($row = $statement->fetch()){
                        $org_stat = $dbh->prepare("select * from project.organizations where organization_id=?");
                        $org_stat->bindParam(1, $row['org_id']);
                        $org_stat->execute();
                        $org_row = $org_stat->fetch();

                        echo "
                        <div class='posted-announcements'>
                            <br>
                            <div class='posted-container'>
                                <div class='userpic'>
                                    <img class='user-picture' src='images/user.png' alt='user'>
                                </div>

                                <div class='posted-username'>
                                    <p class='username'>".$row['org_name']."</p>
                                    <p class='date-time'>".$row['date_posted']."</p>
                                </div>

                                <div class='posted-content'>
                                    <h2 class='topic-title'>".$row['title']."</h2>
                                    <p class='content'>".$row['content']."</p>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }else{
                    header("location: student-announcement-error.php");
                    exit();
                }
                   
                ?>
    
                    </div>
                    
                    <br>
    
            </div>

            <div class="right-div">
    
            </div>

        </div>

    </div>

</div>

<script src="javascript/student-announcement.js"></script>
</body>
</html>