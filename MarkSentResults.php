<?php
    require_once("db_connect.php");

    if (isset($_POST['wedDate'])) {
        $wedDate = $_POST['wedDate'];
        $sunDate = $_POST['sunDate'];
    }

    if (isset($_POST['site'])) {
        $sites = $_POST['site'];

        for ($i=0; $i < sizeof($sites); $i++) { 
            $wedSND[$i] = $sites[$i]." ".$wedDate;
            $sunSND[$i] = $sites[$i]." ".$sunDate;
        }
    }

    for ($i=0; $i < sizeof($sites); $i++) {
        $codeW = $wedSND[$i].' Y';
        $codeS = $sunSND[$i].' R';  
        $filtersQuery[$i] = mysqli_query($connection, "SELECT * FROM asp WHERE PostDate = '' AND (Code = $codeW OR Code = $codeS)");
        if($filtersQuery[$i]){
            echo "YAY";
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Mark Sent Filters</title>
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
                    <a href="login.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <div id = "sentDisplay" class = "container-ansto dynamic-content-700-570" style = "width:700px;">
            <!--Title-->
            <p class = "H190Width">The filters below have been marked as sent</p>
            <table class = "centeredItem" style = "margin:20px;">
                <tr>
                    <th class = "staticData columnTitle smallFont">ID</th>
                    <th class = "staticData columnTitle smallFont">Exposure Code</th>
                    <th class = "staticData columnTitle smallFont">Pre-Mass</th>
                    <th class = "staticData columnTitle smallFont">I<sub>0</sub>(405nm)</th>
                    <th class = "staticData columnTitle smallFont">I<sub>0</sub>(465nm)</th>
                    <th class = "staticData columnTitle smallFont">I<sub>0</sub>(525nm)</th>
                    <th class = "staticData columnTitle smallFont">I<sub>0</sub>(639nm)</th>
                    <th class = "staticData columnTitle smallFont">I<sub>0</sub>(870nm)</th>
                    <th class = "staticData columnTitle smallFont">I<sub>0</sub>(940nm)</th>
                    <th class = "staticData columnTitle smallFont">I<sub>0</sub>(1050nm)</th>
                </tr>
            <table>

            </table>
        </div>


    </body>
</html>