<?php
    session_start();
    require_once("nocache.php");
    require_once("db_connect.php");

    $userQuery = mysqli_query($connection, "SELECT * FROM users");
    echo "<ul class = 'errors'>";
    if(isset($_POST['userName'])){
        if ($_POST['userName'] == "") {
            echo "<li>Username Required</li>";        
        } else {
            $userName = $_POST['userName'];
        }    
    } 

    if(isset($_POST['pass'])){
        $pass = $_POST['pass'];
        $pass = hash('sha256', $pass);
    }

    if (isset($userName) && isset($_POST['pass'])) {
        $existingUserName = false;
        $validPassword = false;
        $admin = false;
        while ($row = mysqli_fetch_array($userQuery)) {
            if ($row['userName'] == $userName) {
                $existingUserName = true;
                if($row['password'] == $pass){
                    // Successful Login Credentials
                    $validPassword = true;
                    // Check user privilege
                    if($row['level'] == 1){
                        $admin = true;
                    }
                } 
            }
        }

        if ($validPassword) {
            $_SESSION["user"] = $userName;
            if($admin){
                $_SESSION["admin"] = true;
            } else {
                $_SESSION["admin"] = false;
            }
            header("location:index.php");
        } else {
            // Display error message for 
            // incorrect username or password
            if(!$existingUserName){
                echo "<li>Invalid Username</li>";
            } else {
                echo "<li>Incorrect Password</li>";
            }
        }
    }

    echo "</ul>";

    mysqli_close($connection);
	
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>

    </head>

    <body>
        <!--This screen was made using bootstrap-->
        <div class = "container-fluid">
            <div class = "row justify-content-center">
                <div class = "col-auto "><img src="Images/LOGOBlock.jpg"></div>
            </div>
            <!--Blue container-->
            <div class = "row justify-content-center">
                <div class = "col-auto" style = " width: 800px; padding: 50px 0px; margin-top: 10px; background-color: #0079c0;">
                    
                    <!--Login Title-->
                    <div class = "row justify-content-center">
                        <div class = "col-10">
                            <h1 class = "H190Width" style = "margin-top:0px; font-size:36px;">Login</h1>
                        </div>
                    </div>
                    <!--Login Form-->
                    <form action = "login.php" method = "POST">
                        <div class = "container-fluid">
                            <!--Username-->
                            <div class = "row justify-content-center" style = "margin-top:30px;">
                                <div class = "col-4">
                                    <input class = "form-control" type = "textbox" name = "userName" placeholder = "Username">
                                </div>
                            </div>
                            <!--Password-->
                            <div class = "row justify-content-center" style = "margin-top:30px;">
                                <div class = "col-4">
                                    <input class = "form-control" type = "password" name = "pass" placeholder = "Password">
                                </div>
                            </div>
                            <!--Confirm Button & Remember Me Checkbox-->
                            <div class = "row justify-content-center" style = "margin-top:30px;">
                                <div class = "col-4" style = "">
                                    <div class = "d-flex justify-content-between">
                                        <div class = "checkbox">
                                            <label  class = "vertically-aligned"style = "color: white; margin:0px; vertical-align:middle;"><input type = "checkbox" style = "margin-right:10px;">Remember Me</label>
                                        </div>
                                        <button type = "submit" class = "btn-ansto">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>