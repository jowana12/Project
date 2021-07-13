<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/yellow-and-black.css">
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
            <h1 class="title-header">Yellow and Black Festival</h1>
            <hr>
        </div>

        <?php
            if(empty($_SESSION["admin_id"])){
                echo "
                    <div class='buttons'>
                        <a href='includes/organization-registration.inc.php'><button class='btn-register'>Register</button></a>
                        <a href='organization-payment.php'><button class='btn-payment'>Payment</button></a>
                    </div>
                ";
            }
        ?>
        <div class="main-content">
            <div class="main-body">
                <div class="grid-container">

                    <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $statement = $dbh->prepare("select * from project.organizations");
                        $statement->execute();
                        while($row = $statement->fetch()){
                            echo "
                                <div class='grid-items'>
                                    <div class='card'>
                                        <img class='card-img' src='includes/showimage.inc.php?id=".$row['organization_id']."' alt='Logo'>
                                        <div class='card-content'>
                                            <h1 class='card-header'>".$row['organization_name']. " (" . $row['organization_abb'].")</h1>
                                            <p class='card-text'>".$row['organization_description']."</p>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    ?>
                    
    
                </div>
        </div>


    </div>

</body>
</html>