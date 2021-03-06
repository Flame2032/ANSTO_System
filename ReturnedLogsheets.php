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

        <title>Editing: Returned Logsheets</title>
        <style>

            /*Input fields positioned on template*/
            input[type="text"] {
                position: absolute;
            }
            .field7 {
                margin-left: 280px;
                margin-top: 350px;
                width: 200px;
            }
            .field8 {
                margin-left: 280px;
                margin-top: 379px;
                width: 200px;
            }
            .field9 {
                margin-left: 280px;
                margin-top: 407px;
                width: 200px;
            }
            .field19 {
                margin-left: 545px;
                margin-top: 350px;
                width: 180px;
            }
            .field20 {
                margin-left: 545px;
                margin-top: 379px;
                width: 180px;
            }
            .field21 {
                margin-left: 545px;
                margin-top: 407px;
                width: 180px;
            }

        </style>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });
        </script>

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

        <div class = "centeredContent container-ansto">
            <input type = "text" class = "field7"></input>
            <input type = "text" class = "field8"></input>
            <input type = "text" class = "field9"></input>
            <input type = "text" class = "field19"></input>
            <input type = "text" class = "field20"></input>
            <input type = "text" class = "field21"></input>
            <img class = "template" src="Images/ASPLogsheet.jpg">
            <form action = "SaveSuccess.html">
                <div class = "row">
                    <input type = "button" class = "btn-ansto floatRight" value = "Save" style = "margin:15px; margin-top:0px; font-size:20px;">
                </div>
            </form>
            
        </div>
    </body>
</html>