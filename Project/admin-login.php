<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SLEP: Admin's Login">
    <meta name="author" content="Giorgio Armani Magno">
    <link rel="stylesheet" type="text/css" href="css/admins-login.css">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SLEP: Admin's Login</title>
</head>
<body>
    <?php
              session_start();
              session_unset();
              session_destroy();


           ?>
    <div class="page-wrap">
        <div class=main>
                  <div class="sidebar">
                       <div class="header">
                            <header>
                                 <img class="logo" src="images/sleplogonoBG.png" alt="logo">
                            </header>
                       </div> <!--header-->

                       <h1 class="greetings">Welcome, OSA Staffs!</h1>
                       <p class="caption-01">Enter your personal details and</p>
                       <p class="caption-02">start leading your organization with us.</p>
                       
                       
                       <a href="students-login.php">
                       <div class="btn-container">
                            <button class="btn-admin">STUDENTS?</button>
                       </div> <!--btn-container-->
                       </a>
                    </div> <!--sidebar-->
                    
                    <div class="main-content">
                        <form action="includes/admin-login.inc.php" method="POST">
                        <h1 class="h1-sign-in">SIGN IN TO YOUR ACCOUNT</h1>
                        
                        <div class="input-container">
                            <i class="fa fa-id-card icon" style="font-size: 22px;"></i>
                            <input class="input-field" type="number" name="input-id" placeholder="User ID Number">
                        </div>

                        <div class="input-container">
                            <i class="fa fa-user icon" style="font-size: 22px;"></i>
                            <input class="input-field" type="text" name="input-email" placeholder="User ID">
                        </div>

                        <div class="input-container">
                            <i class="fa fa-lock icon" style="font-size: 18px;"></i>
                            <input id="input-password" class="input-field" type="password" name="input-password" placeholder="Password">
                            <span class="field-icon" onclick="onClickEye()">
                                <i id="hide1" class="fa fa-eye"></i>
                                <i id="hide2" class="fa fa-eye-slash"></i>
                            </span>
                        </div>

                        <div class="input-container">
                            <a href="#"><h2 class="forgot-password">Forgot your password?</h2></a>
                        </div>
                        
                        <div class="btn-container-login">
                                <button class="btn-login" type="submit" name="submit">Login</button>
                        </div>
                </form>
                <?php
                              if(isset($_GET["error"])){
                                   if($_GET["error"] == "EmptyInput"){
                                        echo "<p class='fill-in'>Fill in all fields!</p>";
                                   }
                                   if($_GET["error"] == "InvalidCredentials"){
                                        echo "<p class='fill-in'>Invalid Credentials!</p>";
                                   }
                              }
                         ?>
            </div> <!--main-content-->
        </div> <!--main-->
    </div> <!--page-wrap-->

    <script>
        function onClickEye() {
            var x = document.getElementById("input-password");
            var y = document.getElementById("hide1");
            var z = document.getElementById("hide2");

            if (x.type === 'password'){
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            } else {
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }
    </script>
    
</body>
</html>