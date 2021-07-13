<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Announcement">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/osa-add-organization.css">
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
            <h1 class="title-header">Add Student Organization</h1>
            <hr>
        </div>

        <div class="main-content">
            <form action="includes/add-organization.inc.php" method="POST" enctype="multipart/form-data">
            <label class="label-header">
                <h3>Organization Abbreviation:</h3>
                <input class="input-field" type="text" name="abb">
            </label>
            <br>

            <label class="label-header">
                <br>
                <h3>Organization Name:</h3>
                <input class="input-field" type="text" name="name">
            </label>
            <br>


            <label class="label-header">
                <br>
                <h3>Organization Description:</h3>
                <input class="input-field" type="text" name="desc">
            </label>
            <br>

            <label class="label-header">
                <br>
                <h3>Organization Logo:</h3>
                <input class="input-field" type="file" name="logo" accept=".jpeg, .jpg, .png">
            </label>
            <br>

            <button type="submit" name="submit" class="btn-add">Add</button>
        </form>
        </div>
<?php
    $error = isset($_GET['error'])? $_GET['error'] : "";
    if($error == 1){
        echo " 
                <script>alert('Fill in all the fields!');</script>
            ";
    }
?>
</body>
</html>
