<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/organization-registration.css">
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
                            echo "<li><a href='includes/student-profile.inc.php'>Profile</a></li>
                                <li><a href='includes/student-dashboard.inc.php'>Dashboard</a></li>
                                <li><a href='includes/student-announcement.inc.php'>Announcements</a></li>
                                <li><a href='includes/events.inc.php'>Events</a></li>";
                        }else{
                            echo "<li><a href='includes/student-leaders-profile.inc.php'>Profile</a></li>
                                <li><a href='includes/student-leaders-dashboard.inc.php'>Dashboard</a></li>
                                <li><a href='includes/student-leaders-announcement.inc.php'>Announcements</a></li>
                                <li><a href='includes/events.inc.php'>Events</a></li>";
                        }
                    }
                    
                    if(!empty($_SESSION["admin_id"])){
                        echo "<li><a href='includes/osa-profile.inc.php'>Profile</a></li>";
                    }
                    ?>
                </ul>
            </nav>
            <a class="logout" href="includes/logout.inc.php"><button>Logout</button></a>
        </header>
    
        <div class="title">
            <h1 class="title-header">Organization Registration</h1>
            <hr>
        </div>
        
        <div class="main-content">
            <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $stat = $dbh->prepare("select * from project.organizations");
                        $reg_stat = $dbh->prepare("select * from project.registration where student_id=? order by org_id");
                        $reg_stat->bindParam(1, $_SESSION['student_id']);
                        $reg_stat->execute();
                        $stat->execute();
                        
                        while($row = $stat->fetch()){
                            $status = "";
                            $checker = "0";
                            while($reg_row = $reg_stat->fetch()){
                                if($row['organization_id'] == $reg_row['org_id']){
                                    $checker = "1";
                                    $status = $reg_row['p_status'];
                                    break;
                                }
                            }

                            if($checker != "1"){
                                 echo "
                                <div class='list-container'>
                                <div class='list-image'>
                                <div class='preview'>
                                <img class='image' src='includes/show-organizations.inc.php?id=".$row['organization_id']."' alt='try'>
                                </div>
                                <div class='list-info'>
                                <h2 class='org-name'>".$row['organization_name']." (".$row['organization_abb']. ")</h2>
                                <p class='caption'>".$row['organization_description']."</p>
                                <button class='btn-register ".strtolower($row['organization_abb'])."'>Register</button>
                                            </div>
                                            </div>
                                            </div>
                                            
                                ";
                            }else{
                                if($status == "PENDING"){
                                     echo "
                                <div class='list-container'>
                                <div class='list-image'>
                                <div class='preview'>
                                <img class='image' src='includes/show-organizations.inc.php?id=".$row['organization_id']."' alt='try'>
                                </div>
                                <div class='list-info'>
                                <h2 class='org-name'>".$row['organization_name']." (".$row['organization_abb']. ")</h2>
                                <p class='caption'>".$row['organization_description']."</p>
                                 <button class='btn-register-pending pending_".strtolower($row['organization_abb'])."'>PAYMENT PENDING</button>
                                            </div>
                                            </div>
                                            </div>
                                            
                                       ";
                                }else if($status == "PAID"){
                                     echo "
                                        <div class='list-container'>
                                        <div class='list-image'>
                                        <div class='preview'>
                                        <img class='image' src='includes/show-organizations.inc.php?id=".$row['organization_id']."' alt='try'>
                                        </div>
                                        <div class='list-info'>
                                        <h2 class='org-name'>".$row['organization_name']." (".$row['organization_abb']. ")</h2>
                                        <p class='caption'>".$row['organization_description']."</p>
                                         <button class='btn-register-paid'>PAID</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ";
                                }else{
                                    echo "
                                        <div class='list-container'>
                                        <div class='list-image'>
                                        <div class='preview'>
                                        <img class='image' src='includes/show-organizations.inc.php?id=".$row['organization_id']."' alt='try'>
                                        </div>
                                        <div class='list-info'>
                                        <h2 class='org-name'>".$row['organization_name']." (".$row['organization_abb']. ")</h2>
                                        <p class='caption'>".$row['organization_description']."</p>
                                         <button class='btn-register'>MEMBER</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ";
                                }
                            }
                          
                        }
            ?>

            <div class="modal-bg">
                <div class="modal">
                    <h2 class="confirmation">Confirmation</h2>
                    <p class="text">Are you sure you wish to register?</p>
                    <form action="includes/register.inc.php" method="POST">
                    <button type="submit" name="submit" class="btn-modal-ok">OK</button>
                    <button type="button" class="btn-modal-cancel">Cancel</button>
                    <input type="hidden" name="org" id="orgg">
                    </form>
                </div>
            </div>

             <div class="modal-bg-02">
                <div class="modal">
                    <h2 class="confirmation">Confirmation</h2>
                    <p class="text">Are you sure you wish to proceed to payment?</p>
                    <a href='organization-payment.php'>
                    <button type="button" class="btn-modal-ok ok2">OK</button></a>
                    <button type="button" class="btn-modal-cancel-02">Cancel</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

   <script src="javascript/organization-registration.js"></script>
   <script src="javascript/organization-registration-icons.js"></script>
   <script src="javascript/organization-registration-jpeg.js"></script>
   <script src="javascript/organization-registration-opensoc.js"></script>
   <script src="javascript/organization-registration-sos.js"></script>
   <script src="javascript/organization-registration-pending.js"></script>
   <script src="javascript/organization-registration-pending-icons.js"></script>
   <script src="javascript/organization-registration-pending-jpeg.js"></script>
   <script src="javascript/organization-registration-pending-sos.js"></script>
   <script src="javascript/organization-registration-pending-opensoc.js"></script>
    

</body>
</html>