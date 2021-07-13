<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/organization-reserve.css">
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
            <div class="buttons">
                <?php
                    $id = isset($_GET['id'])? $_GET['id'] : "";
                    echo "<a href='organization-reserve-status.php?id=".$id."'>"
                ?>
                <button class="btn-status">Updates</button></a>
            </div>
            <?php
            $id = isset($_GET['id'])? $_GET['id'] : "";
               echo " 
                    <form action='includes/reserve-venue.inc.php?id=".$id."' method='POST' enctype='multipart/form-data'>
                    ";
            ?>
            <label class="label-header"> 
                <h3>Nature of Activity:</h3>

                <input type="radio" id="co-curricular" class="radio-button" name="nature" value="Co-Curricular">
                <label for="co-curricular">Co-Curricular</label><br>
                
                <input type="radio" id="extra-curricular" class="radio-button" name="nature" value="Extra-Curricular">
                <label for="extra-curricular">Extra-Curricular</label><br>
            </label>
            <br>

            <label class="label-header">
                <h3>Title of Activity:</h3>
                <input class="input-field" type="text" name="title">
            </label>
            <br>
            

            <label class="label-header">
                <br>
                <h3>Target Date (from):</h3>
                <input class="input-field" type="datetime-local" name="date_from">
            </label>
            <br>

            <label class="label-header">
                <br>
                <h3>Target Date (to):</h3>
                <input class="input-field" type="datetime-local" name="date_to">
            </label>
            <br>

            <label class="label-header">
                <br>
                <h3>Number of Attendees:</h3>
                <input class="input-field" type="number" name="attendees">
            </label>
            <br>

            <label class="label-header">
                <br>
                <h3>Venue:</h3>

                <input type="radio" id="seminar-room-casal" class="radio-button" name="venue" value="Seminar Room (Casal)">
                <label for="seminar-room-casal">Seminar Room (Casal)</label><br>
                
                <input type="radio" id="seminar-room-arlegui" class="radio-button" name="venue" value="Seminar Room Arlegui">
                <label for="seminar-room-arlegui">Seminar Room (Arlegui)</label><br>

                <input type="radio" id="congreagating-area" class="radio-button" name="venue" value="Congregating Area">
                <label for="congreagating-area">Congregating Area</label><br>
                
                <input type="radio" id="study-area-casal" class="radio-button" name="venue" value="Study Area Casal">
                <label for="study-area-casal">Study Area (Casal)</label><br>

                <input type="radio" id="study-area-arlegui" class="radio-button" name="venue" value="Study Area Arlegui">
                <label for="study-area-arlegui">Study Area(Arlegui)</label><br>
                
                <input type="radio" id="pe-center-main" class="radio-button" name="venue" value="PE-Center Main">
                <label for="pe-center-main">PE Center Main</label><br>

                <input type="radio" id="pe-center-annex" class="radio-button" name="venue" value="PE-Center Annex">
                <label for="pe-center-annex">PE Center Annex</label><br>
                
                <input type="radio" id="casal-grounds" class="radio-button" name="venue" value="Casal Grounds">
                <label for="casal-grounds">Casal Grounds</label><br>

                <input type="radio" id="anniversary-hall" class="radio-button" name="venue" value="Anniversary Hall">
                <label for="anniversary-hall">Anniversary Hall</label><br>
                
                <input type="radio" id="dr-teresita-quirino-hall" class="radio-button" name="venue" value="Dr. Teresita Quirino Hall">
                <label for="dr-teresita-quirino-hall">Dr. Teresita Quirino Hall</label><br>
            </label>
            <br>

            <label class="label-header">
                <h3>Upload Poster:</h3>
                <input class="input-field" type="file" name="poster" accept=".png, .jpg, .jpeg">
            </label>
            <br>

            <button type="submit" name="submit" class="btn-reserve">Reserve</button>

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
            }
        </script>

</body>
</html>
