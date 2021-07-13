<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Dashboard">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/osa-dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: OSA Dashboard</title>
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
            <h1 class="title-header">Dashboard</h1>
            <hr>
        </div>

        <div class="main-content">
            <div class="main-body">
                <div class="grid-container">


                    <div class="grid-items" onclick="location.href='osa-add-budget.php';">
                        <div class="card">
                            <img class="card-img" src="images/osabudgetyellow.png" alt="Logo">
                            <div class="card-content">
                                <h1 class="card-header">Organization Budget</h1>
                            </div>
                        </div>
                    </div>

                    
                    <div class="grid-items"  onclick="location.href='osa-approval-deliverables.php';">
                        <div class="card">
                            <img class="card-img" src="images/osaapprovalyellow.png" alt="Logo">
                            <div class="card-content">
                                <h1 class="card-header">Deliverables Approval</h1>
                                <br>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid-items"  onclick="location.href='osa-add-organization.php';">
                        <div class="card">
                            <img class="card-img" src="images/organizationyellow.png" alt="Logo">
                            <div class="card-content">
                                <h1 class="card-header">Add Student Organization</h1>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="grid-items"  onclick="location.href='osa-approval-venue.php';">
                        <div class="card">
                            <img class="card-img" src="images/venue-dashboardyellow.png" alt="Logo">
                            <div class="card-content">
                                <h1 class="card-header">Venue Reservation Approval</h1>
                                <br>
                            </div>
                        </div>
                    </div>

                </div>
            
            </div>
        </div>
    </body>
</html>