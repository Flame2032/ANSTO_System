<?php
	session_start();
    require_once("nocache.php");

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

        <title>Home</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script>
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });
        </script>
        <script type="text/javascript">
            function GoPrepFilters () {
                window.location.href = "NewFilters.php";
            }
            function GoGenLogs () {
                window.location.href = "GenerateLogsheets.php";
            }
            function GoEditLogs () {
                window.location.href = "ReturnedLogsheets.php";
            }
            function GoPostAnalysis () {
                window.location.href = "PostScan.php";
            }
            function GoViewData () {
                window.location.href = "AllData.php";
            }
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
    
        <div class = "container-ansto fully-centered-known-size marginT-20" style = "width:400px; padding:20px;">
            <h1 class = "H190Width">Home</h1>
            <div class = "centeredItem">
                <button class = "btn btn-ansto indexOption" onclick = "GoPrepFilters();">Prepare Filters</button>
            </div>
            <div class = "centeredItem">
                <button class = "btn btn-ansto indexOption" onclick = "GoGenLogs();" style = "font-size:24px;">Generate Logsheets</button>
            </div>
            <div class = "centeredItem">
                <button class = "btn btn-ansto indexOption" onclick = "GoEditLogs();">Edit Logsheets</button>
            </div>
            <div class = "centeredItem">
                <button class = "btn btn-ansto indexOption" onclick = "GoPostAnalysis();">Post-Analysis</button>
            </div>
            <div class = "centeredItem">
                <button class = "btn btn-ansto indexOption" onclick = "GoViewData();">View Data</button>
            </div>
        </div>

    </body>
</html>