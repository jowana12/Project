<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/organization-student-leaders.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Events</title>
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
        <div class="main-content">
            <div class="main-body">
                <div class="grid-container">

                   
                    <div class="grid-items"  onclick="location.href='#linkhere';">
                        <?php
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        echo "
                        <a href='organization-announcement.php?id=".$id."'>
                        ";
                    ?>
                        <div class="card">
                            <img class="card-img" src="images/announcementyellow.png" alt="Logo">
                            <div class="card-content">
                                <h1 class="card-header">Announcements</h1>
                            </div>
                        </div>
                        </a>
                    </div>
                

                    
                    <?php
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        echo "
                        <a href='organization-budget.php?id=".$id."'>
                        ";
                    ?>
                    <div class="grid-items"  onclick="location.href='#linkhere';">
                        <div class="card">
                            <img class="card-img" src="images/osabudgetyellow.png" alt="Logo">
                            <div class="card-content">
                                <h1 class="card-header">Budget</h1>
                            </div>
                        </div>
                    </div>
                </a>


                <?php
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        echo "
                        <a href='deliverables.php?id=".$id."'>
                        ";
                    ?>
                    <div class="grid-items"  onclick="location.href='#linkhere';">
                        <div class="card">
                            <img class="card-img" src="images/osaapprovalyellow.png" alt="Logo">
                            <div class="card-content">
                                <h1 class="card-header">Deliverables</h1>
                            </div>
                        </div>
                    </div>
                </a>

                    <div class="grid-items" onclick="location.href='#linkhere';">
                        <?php
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        echo "
                        <a href='organization-members.php?id=".$id."'>
                        ";
                        ?>
                        <div class="card">
                            <img class="card-img" src="images/membersyellow.png" alt="Logo">
                            <div class="card-content">
                                <h1 class="card-header">Members</h1>
                                <br>
                            </div>
                        </div>
                    </a>
                    </div>

                    <?php
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        echo "
                        <a href='organization-reserve.php?id=".$id."'>
                        ";
                    ?>
                    <div class="grid-items" onclick="location.href='#linkhere';">
                        <div class="card">
                            <img class="card-img" src="images/venueyellow.png" alt="Logo">
                            <div class="card-content">
                                <h1 class="card-header">Reserve</h1>
                                <br>
                            </div>
                        </div>
                    </div>
                    </a>

                </div>
            
            </div>

        </div>

        <?php
        if(!empty(isset($_GET['reserve']))){
            echo "
                <input type='hidden' id='error' value='".$_GET['reserve']."'>
            ";
        }
    ?>

    <script>
            var error = document.getElementById("error").value;
            if(error == 1){
                alert("SUCCESS!");
            }
        </script>
</body>
</html>
