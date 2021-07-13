<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Events">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/deliverables.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Events</title>
</head>
<body>
    <?php
    session_start();
    if($_SESSION["type"] == "Student"){
        header("location: ../Project/students-login.php");
        exit();
    }
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
                <button class="btn-submit">Submit Deliverables</button>
                <?php
                    $id = isset($_GET['id'])? $_GET['id'] : "";
                    echo "<a href='includes/deliverables-status.inc.php?id=".$id."'>"
                ?>
                    <button class="btn-status">Updates</button></a>
            </div>
            
                <div class="list-container">
                    <div class="list-image">
                        <div class="preview">
                            <img class="image" src="images/doc.png" alt="try">
                        </div>

                        <div class="list-info">
                            <h2 class="org-name">After Activity Report</h2>
                            <p class="caption">An activity report, evaluation report and liquidation report must be submitted to the Office of Student Affairs (OSA) one (1) week after the activity.  No new activity shall  be allowed to be conducted unless the required reports of the previous activity are received by OSA. </p>
                            <button class="btn-download" onclick="window.location.href='forms/AFTER ACTIVITY REPORT.docx';">Download</button>

                        </div>
                    </div>
                </div>

            <div class="list-container">
                <div class="list-image">
                    <div class="preview">
                        <img class="image" src="images/doc.png" alt="try">
                    </div>

                    <div class="list-info">
                        <h2 class="org-name">Application for Student Activities</h2>
                        <p class="caption">All activities of the organization shall be recommended by the adviser of the organization, noted by the department chair and approved by the Office of Student Affairs. The proposal to conduct an activity must be filed two (2) weeks before the scheduled activity.</p>
                        <button class="btn-download" onclick="window.location.href='forms/APPLICATION  FOR  STUDENT ACTIVITIES.doc';">Download</button>

                    </div>
                </div>
            </div>

            <div class="list-container">
                <div class="list-image">
                    <div class="preview">
                        <img class="image" src="images/doc.png" alt="try">
                    </div>

                    <div class="list-info">
                        <h2 class="org-name">Application for Recognition of Student Organization</h2>
                        <p class="caption">All activities of the organization shall be recommended by the adviser of the organization, noted by the department chair and approved by the Office of Student Affairs. The proposal to conduct an activity must be filed two (2) weeks before the scheduled activity.</p>
                        <button class="btn-download" onclick="window.location.href='forms/APPLICATION FOR  RECOGNITION OF STUDENT ORGANIZATION.doc';">Download</button>

                    </div>
                </div>
            </div>

            <div class="list-container">
                <div class="list-image">
                    <div class="preview">
                        <img class="image" src="images/doc.png" alt="try">
                    </div>

                    <div class="list-info">
                        <h2 class="org-name">Liquidation Report</h2>
                        <p class="caption">All activities of the organization shall be recommended by the adviser of the organization, noted by the department chair and approved by the Office of Student Affairs. The proposal to conduct an activity must be filed two (2) weeks before the scheduled activity.</p>
                        <button class="btn-download" onclick="window.location.href='forms/Liquidation  Report.doc';">Download</button>

                    </div>
                </div>
            </div>

            <div class="list-container">
                <div class="list-image">
                    <div class="preview">
                        <img class="image" src="images/doc.png" alt="try">
                    </div>

                    <div class="list-info">
                        <h2 class="org-name">Request for Working Fund/Disbursement</h2>
                        <p class="caption">All activities of the organization shall be recommended by the adviser of the organization, noted by the department chair and approved by the Office of Student Affairs. The proposal to conduct an activity must be filed two (2) weeks before the scheduled activity.</p>
                        <button class="btn-download" onclick="window.location.href='forms/REQUEST FOR WORKING  FUND-DISBURSEMENT.docx';">Download</button>

                    </div>
                </div>
            </div>

            <div class="modal-bg">
                <div class="modal">
                    <?php
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        echo "<form action='includes/deliverables.inc.php?id=".$id."' method='POST' enctype='multipart/form-data'>
                        ";
                    ?>
                    
                    <h2 class="modal-header">Student Leaders' Submission</h2>
                    <div class="select-box">
                            <label>
                                <h3>Privacy Consent</h3>
                                <hr>
                                <p class="consent-details">I understand and agree that by filling-out this form I am allowing the Technological Institute of the Philippines (T.I.P.) to collect, use, and disclose the personal information for document submission and to store it as long as necessary for the fulfillment of the stated purpose in accordance with applicable laws, including the Data Privacy Act of 2012 and its Implementing Rules and Regulations, and the T.I.P. Privacy Policy. The purpose and extent of collection, use, sharing and disclosure, and storage of the data subjects' personal information was explained to me.</p>
                                <input type="radio" id="consent-yes" class="radio-button"  value="yes" name="consent">
                                <label for="consent-yes">Yes, I agree.</label><br>

                            </label>
                        </div>

                        <label class="label-document-type"> 
                            <h3>Type of Document</h3>
                            
                            <hr>
                            <input type="radio" id="document-after-activity" class="radio-button" name="document" value="After Activity Report">
                            <label for="document-after-activity">After Activity Report</label><br>
                            
                            <input type="radio" id="document-student-activities" class="radio-button" name="document" value="Application for Student Activities">
                            <label for="document-student-activities">Application for Student Activities</label><br>

                            <input type="radio" id="document-recognition-student-organization" class="radio-button" name="document" value="Application for Recognition of Student Organization">
                            <label for="document-recognition-student-organization">Application for Recognition of Student Organization</label><br>

                            <input type="radio" id="document-liquidation-report" class="radio-button" name="document" value="Liquidation Report">
                            <label for="document-liquidation-report">Liquidation Report</label><br>

                            <input type="radio" id="document-request-working-fund" class="radio-button"  name="document" value="Request for Working Fund/Disbursement">
                            <label for="document-request-working-fund">Request for Working Fund/Disbursement</label><br>
                        </label>


                        <label>
                            <h3>Upload Document</h3>
                            <hr>
                            <input class="upload-document" type="file" id="document" name="myfile" accept=".doc, .docx">
                        </label>
                    
                    <div class="buttons">
                        <p class="fill-in" id="message"></p>
                        <button type="button" class="btn-modal-cancel btn-modal">Cancel</button>
                        <button type="submit" class="btn-modal-submit btn-modal" name="submit">Submit</button>
                    </div>
                </form>
                </div>
            </div>

            <div class="modal-bg_02">
                <div class="modal">
                    <h2 class="confirmation">Confirmation</h2>
                    <p class="text">Upon submitting this document, I confirm that all information stipulated in the document are factual and were approved the by all appropriate signatories.</p>

                    <p class="text">In the event that there are erroneous information in the document I submitted, it is my responsibility to have them corrected and be approved by all appropriate signatories; that I may be held liable of fabricating documents or misrepresentation of information if no corrective actions are done to the document.</p>

                    <p class="text">By clicking the SUBMIT button, I understand the above statements.</p>
                        
                    <button type="button" class="btn-modal-submit_02">Submit</button>
                    <button type="button" class="btn-modal-cancel">Cancel</button>
                </div>
            </div>

        </div>

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
            var message = document.getElementById("message");
            if(error == 1){
                alert("FILL IN ALL THE FIELDS!");
                
            }
        </script>
    <script src="javascript/deliverables.js"></script>

    </body>
</html>
