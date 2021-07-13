<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/organization-members.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Organization</title>
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
            <div class="buttons">
                <?php
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        echo "
                        <a href='organization-members-approval.php?id=".$id."'>
                        ";
                        ?>
                <button class="btn-approval">Members Approval</button>
            </a>
            </div>

            <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                $id = isset($_GET['id'])? $_GET['id'] : "";
                $stat = $dbh->prepare("select * from project.registration where org_id=? and p_status=?");
                $status = "MEMBER";
                $stat->bindParam(1, $id);
                $stat->bindParam(2, $status);
                $stat->execute();
                if($stat->rowCount() > 0){
                    while($row = $stat->fetch()){
                    $member_stat = $dbh->prepare("select * from project.officers where student_id=? and organization_id=?");
                    $member_stat->bindParam(1, $row['student_id']);
                    $member_stat->bindParam(2, $row['org_id']);
                    $member_stat->execute();
                    $members = $member_stat->fetch();
                    echo "
                        <div class='list-container'>
                            <div class='list-image'>
                                <div class='preview'>
                                    <img class='image' src='images/user_transparent.png' alt='try'>
                                </div>

                                <div class='list-info'>
                                    <h2 class='member-name'>".$members['first_name']. " " .$members['last_name']. "</h2>
                                    <div class='button-del'>
                                        <a href='includes/delete-member.inc.php?id=".$row['org_id']."&stid=".$row['student_id']."'><button class='btn-delete'>Delete</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";

                }
            }else{
                header("location: organization-members-error.php?id=".$id);
                exit();
            }

                
            ?>

            

</body>
</html>
