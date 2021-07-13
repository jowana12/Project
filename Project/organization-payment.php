<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/organization-payment.css">
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
            <h1 class="title-header">Organization Payment</h1>
            <hr>
        </div>
        <div class="main-content">
            <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                $stat = $dbh->prepare("select * from project.registration where student_id=? and p_status=?");
                $status = "PENDING";
                $stat->bindParam(1, $_SESSION['student_id']);
                $stat->bindParam(2, $status);
                $stat->execute();
                if($stat->rowCount() > 0){
                    while($row = $stat->fetch()){
                    $org = $dbh->prepare("select * from project.organizations where organization_id=?");
                    $org->bindParam(1, $row['org_id']);
                    $org->execute();
                    $org_row = $org->fetch();
                    echo "
                    <div class='list-container'>
                    <div class='list-image'>
                        <div class='preview'>
                            <img class='image' src='includes/show-image-payment.inc.php?id=".$org_row['organization_id']."' alt='try'>
                        </div>

                        <div class='list-info'>
                        <h2 class='org-name'>" .$org_row['organization_name']. " (" .$org_row['organization_abb']. ")</h2>
                        <p class='caption'>".$org_row['organization_description']. "</p>
                        <button class='btn-pay ".strtolower($org_row['organization_abb'])."'>Pay</button>
                        <button class='btn-cancel'>Cancel</button>
                        <input type='hidden' id='".strtolower($org_row['organization_abb'])."' value='".$row['reg_id']."'>
                        </div>
                        </div>
                        </div>

                ";
                }
            }else{
                header("location: organization-payment-error.php");
                exit();
            }
                
            ?>

            <div class="modal-bg">
                <div class="modal">
                    <form action="includes/payment.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="final" name="final">
                    <h2 class="membership-payment">Membership Payment</h2>
                    <div class="select-box">
                        <label>Mode of Payment:
                            <select class="input-field payment" name="mode">
                                <option>Gcash</option>
                                <option>Paymaya</option>
                            </select>
                        </label>
                    </div>

                    <label class="label-number account-number"> Account Number:
                        <input class="input-field" type="number" name="account_number">
                    </label>

                    <label> Account Name:
                        <input class="input-field student-number" type="name" name="account_name">
                    </label>

                    <label>Receipt:
                        <input class="input-field receipt" type="file" id="receipt" name="receipt" accept="image/png, image/jpeg">
                    </label>

                    <button type="submit" name="submit" class="btn-modal-save">Save</button>
                    <button type="button" class="btn-modal-cancel">Cancel</button>
                    <input type="hidden" id="hehe" name="org">
                    </form>
                    
                </div>
            </div>

        </div>

    </div>

    <input type='hidden' id="error" value="0">

    <?php
    if(!empty(isset($_GET['error']))){
        echo "
            
            <script>
                document.getElementById('error').value=1;
            </script>
        ";
    }
    ?>
    
    <script src="javascript/organization-payment.js"></script>
    <script src="javascript/organization-payment_icons.js"></script>
    <script src="javascript/organization-payment_opensoc.js"></script>
    <script src="javascript/organization-payment_sos.js"></script>
    <script src="javascript/organization-payment_jpeg.js"></script>

</body>
</html>