<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Announcement">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/osa-add-budget.css">
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
            <h1 class="title-header">Add Organization Fund</h1>
            <hr>
        </div>

        <div class="main-content">
            <form action="includes/add-fund.inc.php" method="POST">
            <div class="select-box">
                <label>
                    <h3>Student Organization</h3>
                    <select class="input-field payment" name="org">
                        <option></option>
                        <?php
                             $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                             $statement = $dbh->prepare("select * from project.organizations");
                             $statement->execute();
                             while($row = $statement->fetch()){
                                echo "
                                    <option>".$row['organization_name']."</option>
                                ";
                             }
                        ?>
                    </select>
                </label>
            </div>
            <br>

            <label class="label-header">
                <br>
                <h3>Organizational Fund</h3>
                <input class="input-field" type="number" name="fund">
            </label>
            <br>

            <button type="submit" name="submit" class="btn-save">Save</button>

        </form>
            </div>

            <?php
            if(!empty(isset($_GET['error']))){
                echo "
                    <input type='hidden' id='error' value='".$_GET['error']."'>
                ";
            }
        ?>

        <script>
            var error = document.getElementById("error").value;
            if(error == 1){
                alert("Please complete the fields!");
            }else if(error == 2){
                alert("Cant input negative fund!");
            }
        </script>

</body>
</html>
