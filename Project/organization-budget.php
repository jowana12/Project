<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/organization-budget.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Events</title>
</head>
<?php
    $error = isset($_GET['error'])? $_GET['error'] : "";
    $id = isset($_GET['id'])? $_GET['id'] : "";
    if($error == 1){
        echo " 
                <script>alert('Fill in all the fields!');</script>
            ";
    }else if($error == 2){
        echo "
            <script>alert('Cant input expense greater than your budget!');</script>
        ";
    }else if($error == 3){
        echo "
            <script>alert('Cant input expense less than your 1!');</script>
        ";
    }
?>
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

                    <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        $statement = $dbh->prepare("select * from project.organizations where organization_id=?");
                        $statement->bindParam(1, $id);
                        $statement->execute();
                        $row = $statement->fetch();
                        if($row['checker'] == 0){
                            header("location: organization-budget-error.php?id=".$id);
                            exit();
                        }
                        echo "
                            <div class='grid-items'>
                                <div class='card'>
                                    <h1 class='card-header'>Total Fund</h1>
                                    <h1 class='card-fund'>Php ". $row['budget']."</h1>
                                </div>
                            </div>

                            
                            <div class='grid-items'>
                                <div class='card'>
                                    <div class='card-content'>
                                        <h1 class='card-header'>Total Expenses</h1>
                                        <h1 class='card-fund'>Php ".$row['expenses']."</h1>
                                    </div>
                                </div>
                            </div>
                        ";

                    ?>

                    

                </div>
            
            </div>
            <?php
                $error = isset($_GET['error'])? $_GET['error'] : "";
                $id = isset($_GET['id'])? $_GET['id'] : "";
                if($error == 1){
                    echo " 
                            <script>alert('Fill in all the fields!');</script>
                        ";
                }else if($error == 2){
                    echo "
                        <script>alert('Cant input expense greater than your budget!');</script>
                    ";
                }else if($error == 3){
                    echo "
                        <script>alert('Cant input expense less than your 1!');</script>
                    ";
                }
            ?>

            <?php
                $id = isset($_GET['id'])? $_GET['id'] : "";
                echo"
                <form action='includes/update-budget.inc.php?id=".$id."' method='POST'>
                ";
            ?>
            <label class="label-header">
                <br>
                <br>
                <h3>Event:</h3>
                <input class="input-field" type="text" name="event">
            </label>
            <br>


            <label class="label-header">
                <br>
                <h3>Description:</h3>
                <input class="input-field" type="text" name="description">
            </label>
            <br>

            <label class="label-header">
                <br>
                <h3>Total Expenses:</h3>
                <input class="input-field" type="number" name="expenses">
            </label>
            <br>

            <button type="submit" name="submit" class="btn-update">Update</button>
            </form>
            <br>
            <br>
            <br>

            <div class="table-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Event</th>
                            <th>Description</th>
                            <th>Total Expenses</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
                            $id = isset($_GET['id'])? $_GET['id'] : "";
                            $statement = $dbh->prepare("select * from project.expenses where org_id=?");
                            $statement->bindParam(1, $id);
                            $statement->execute();
                            while($row = $statement->fetch()){
                                echo "
                                    <tr>
                                        <th>".$row['date_updated']."</th>
                                        <th>".$row['event']."</th>
                                        <th>".$row['description']."</th>
                                        <th>Php ".$row['expense']."</th>
                                        <th>".$row['updated_by']."</th>
                                    </tr>
                                ";
                            }


                        ?>
        </div>

</body>
</html>