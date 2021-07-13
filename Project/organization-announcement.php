 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Announcement">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/organization-announcements.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Organization Announcement</title>
</head>
<body>
    <div class="main-content">
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
                    <li><a href="includes/student-leaders-dashboard.inc.php">Dashboard</a></li>
                    <li><a href="includes/student-leaders-announcement.inc.php">Announcements</a></li>
                    <li><a href="includes/events.inc.php">Events</a></li>
                    <li><a href="includes/student-leaders-profile.inc.php">Profile</a></li>
                </ul>
            </nav>
            <a class="logout" href="includes/logout.inc.php"><button>Logout</button></a>
        </header>
    
        <?php
            $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
            $id = isset($_GET['id'])? $_GET['id'] : "";
            $stat = $dbh->prepare("select * from project.organizations where organization_id=?");
            $stat->bindParam(1, $id);
            $stat->execute();
            $row = $stat->fetch();
            echo "
                 <div class='title'>
                    <h1 class='title-header'>".$row['organization_name']."</h1>
                    <hr>
                </div>
            ";
            ?>

        <div class="div-side-by-side">
            <div class="left-div">
                <div class="create-post">
                    <div class="userpic">
                        <img class="user-picture" src="images/user.png" alt="user">
                    </div>
                    
                    <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        $stat = $dbh->prepare("select * from project.organizations where organization_id=?");
                        $stat->bindParam(1, $id);
                        $stat->execute();
                        $row = $stat->fetch();
                        echo "
                             <div class='username'>
                                <p class='username'>".$row['organization_name']." (".$row['organization_abb']. ")</p>
                            </div>
                        ";
                    ?>
                    <?php
                        echo"
                           <form action='includes/org-announcement.inc.php?id=".$id."' method='POST'>
                           ";
                    ?>
                    <div class="input-container">
                        <input class="input-title" type="text" name="title" placeholder="Topic Title">
                   </div>
    
                   <div class="input-container">
                       <textarea class="input-content" name="content" id="content" cols="30" rows="10" placeholder="Announcement Content..."></textarea>
                   </div>
    
                    <button type="submit" name="submit" id="btn_save">Save</button>
                    </form>
                </div>

                <?php
                    $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                    $id = isset($_GET['id'])? $_GET['id'] : "";
                    $statement = $dbh->prepare("select * from project.announcements where org_id=? order by announcement_id desc");
                    $statement->bindParam(1, $id);
                    $statement->execute();
                    while($row = $statement->fetch()){
                        $org_stat = $dbh->prepare("select * from project.organizations where organization_id=?");
                        $org_stat->bindParam(1, $row['org_id']);
                        $org_stat->execute();
                        $org_row = $org_stat->fetch();

                        echo "
                        <div class='posted-announcements'>
                            <br>
                            <hr>
                            <div class='posted-container'>
                                <div class='userpic'>
                                    <img class='user-picture' src='images/user.png' alt='user'>
                                </div>

                                <div class='posted-username'>
                                    <p class='username'>".$row['org_name']." (".$org_row['organization_abb'].")</p>
                                    <p class='date-time'>".$row['date_posted']."</p>
                                </div>

                                <div class='posted-content'>
                                    <h2 class='topic-title'>".$row['title']."</h2>
                                    <p class='content'>".$row['content']."</p>
                                </div>
                                

                                <a href='includes/org-delete-announcement.inc.php?id=".$row['announcement_id']."&org=".$row['org_id']."'><button type='button' class='btn_reply'>DELETE</button></a>
                            </div>
                        </div>
                        ";
                    }
                ?>
                

                

            
            </div>

            <div class="right-div">
    
            </div>

        </div>

    </div>

</div>

<script src="javascript/organization-announcement.js"></script>
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