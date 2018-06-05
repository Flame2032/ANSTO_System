<?php
    session_start();
    require_once("nocache.php");
    require_once("db_connect.php");

    $admin = null;

    if (isset($_SESSION["user"])) {
        if ($_SESSION["admin"] == true) {
            $admin = true;
        } else {
            $admin = false;
        }
    } else {
        header("location:Login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Viewing: Existing Logsheets</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });

            function deleteSite() {
                window.alert ("Site Deleted");
            }

            function addSite() {
                window.alert ("New Site Added");
            }
        </script>
    
        <style>
            
            /*Content*/
            .content {
                margin-top: 10px;
                width: 100%;
            }

            .generatedSheet {
                border-bottom: 1px solid black;
                margin-top: 3px;
            }

            a {
                text-decoration: none;
                color: #0000EE;
            }

            .headingText {
                font-size: 18px;
                margin-top: 5px;
            }

        </style>

    </head>

    <body>
        <!--Navigation Bar-->
        <div id="navBar"></div>
        <!--Second Bar-->
        <div class = "secondBarContainer">
            <div class = "secondBar">
                <div class = "rightDiv">
                    <a href="logoff.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <div class = "content">
            <p class = "headingText">List of all existing logsheets:</p>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
        </div>

    </body>
</html>