<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Dashboard">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/error.css">
    <link rel="stylesheet" type="text/css" href="css/students-dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Student Dashboard</title>
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
            <h1 class="title-header">Dashboard</h1>
            <hr>
        </div>

        <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                $id = $_SESSION["student_id"];
                $statement = $dbh->prepare("select * from project.users where id_number=?");
                $statement->bindParam(1, $id);
                $statement->execute();
                $row = $statement->fetch();
                echo "
                    <h3 class='welcome'>Welcome, ".$row['firstname']. " ".$row['lastname']. "!</h3>
                ";
            ?>

         <img class="error-messages" src="images/errormessages/youarenotpartofanystudentorganizations.png" alt="error-messages">
</body>
</html>