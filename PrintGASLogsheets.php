<?php
    require_once("db_connect.php");
    require_once('phpqrcode/qrlib.php');

    $hiddenDiv = "hiddenDiv";
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Generated Logsheet</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome. .css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });

            function PrintAllLogsheets (divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                document.body.style.margin = "0px";

                window.print();

                document.body.style.margin = "8px";
                document.body.innerHTML = originalContents;
            }

            function PrintSingleLogsheet (num) {
                var id = num;
                var printContents = document.getElementById(id).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                document.body.style.margin = "0px";

                window.print();

                document.body.style.margin = "8px";
                document.body.innerHTML = originalContents;
            }
        </script>

        <style type="text/css">
            /*QR-Codes*/
            .YC-Code {
                margin: 121px 0px 0px 180px;
            }
            .YF-Code {
                margin: 121px 0px 0px 477px;
            }
            .RC-Code {
                margin: 178px 0px 0px 180px;
            }
            .RF-Code {
                margin: 178px 0px 0px 477px;
            }
            /*ID values next to QR Codes*/
            .IDYC, .IDRC, .IDYF, .IDRF {
                width: 70px;
                text-align:center;
            }
            .IDYC {
                margin: 135px 0px 0px 230px;
            }
            .IDRC {
                margin: 195px 0px 0px 230px;
            }
            .IDYF {
                margin: 135px 0px 0px 525px;
            }
            .IDRF {
                margin: 195px 0px 0px 525px;
            }
            /*Remaining Fields*/
            .field1C, .field1F, .field2C, .field2F {
                font-size: 15px;
                width: 160px;
                
                text-align: center;
            }
            .field3CY, .field4FY, .field5CY, .field6FY, 
            .field3CR, .field4FR, .field5CR, .field6FR {
                font-size: 14px;
                width: 110px;
            }
            .field1C {
                margin: 135px 0px 0px 305px;
            }
            .field1F {
                margin: 135px 0px 0px 605px;
            }
            .field2C {
                margin: 192px 0px 0px 305px;
            }
            .field2F {
                margin: 192px 0px 0px 605px;
            }
            .field3CY {
                margin: 263px 0px 0px 270px;
            }
            .field4FY {
                margin: 293px 0px 0px 270px;
            }
            .field5CY {
                margin: 322px 0px 0px 270px;
            }
            .field6FY {
                margin: 352px 0px 0px 270px;
            }
            .field3CR {
                margin: 263px 0px 0px 420px;
            }
            .field4FR {
                margin: 293px 0px 0px 420px;
            }
            .field5CR {
                margin: 322px 0px 0px 420px;
            }
            .field6FR {
                margin: 352px 0px 0px 420px;
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
                    <a href="login.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <?php

            if (isset($_POST['type'])) {
            }
            if (isset($_POST['minCID'])) {
                $minC = $_POST['minCID'];
            }
            if (isset($_POST['minFID'])) {
                $minF = $_POST['minFID'];
            }
            if (isset($_POST['num'])) {
                $num = $_POST['num'];
            }

            // Get filter information to be placed on logsheets
            for ($i=0; $i < $num; $i++) { 
                $filterCQuery[$i] = "SELECT * FROM gasc WHERE gasCID =  ".($minC+$i);
                $filterCResult[$i] = mysqli_query($connection, $filterCQuery[$i]);
                $filterFQuery[$i] = "SELECT * FROM gasf WHERE gasFID =  ".($minF+$i);
                $filterFResult[$i] = mysqli_query($connection, $filterFQuery[$i]);
            }

            // Display individual logsheet links
            echo 
            '<div class = "content">
            <h2>List of generated logsheets:</h2>';

            for ($i=0; $i < $num; $i+=2) { 
                echo '<div class = "generatedSheet logsheetLink" onclick = "PrintSingleLogsheet('; echo "'$i'"; echo ');">';
                while ($row = mysqli_fetch_array($filterCResult[$i])) {
                    echo "GC ".$row['gasCID'];
                    echo " [".$row['Code']."] + ";
                }
                while ($row = mysqli_fetch_array($filterCResult[$i+1])) {
                    echo "GC ".$row['gasCID'];
                    echo " [".$row['Code']."] + ";
                }
                while ($row = mysqli_fetch_array($filterFResult[$i])) {
                    echo "GF ".$row['gasFID'];
                    echo " [".$row['Code']."] + ";
                }
                while ($row = mysqli_fetch_array($filterFResult[$i+1])) {
                    echo "GF ".$row['gasFID'];
                    echo " [".$row['Code']."] ";
                }
                echo '</div>';
            }

            echo '
            <div class = "bottomStrip"><button class = "printAllButton" onclick = "PrintAllLogsheets('; echo "'hiddenDiv'"; echo ');">Print All</button></div>

            <div id = "hiddenDiv">';

            // Re-run the query
            for ($i=0; $i < $num; $i++) { 
                $filterCQuery[$i] = "SELECT * FROM gasc WHERE gasCID =  ".($minC+$i);
                $filterCResult[$i] = mysqli_query($connection, $filterCQuery[$i]);
                $filterFQuery[$i] = "SELECT * FROM gasf WHERE gasFID =  ".($minF+$i);
                $filterFResult[$i] = mysqli_query($connection, $filterFQuery[$i]);
            }

            for ($i=0; $i < $num; $i+=2) { 
                echo '<div id = '; echo "'$i'"; echo '>';
                while ($row = mysqli_fetch_array($filterCResult[$i])) {
                    QRcode::png('GC '.$row['gasCID'], 'GeneratedCodes/gasCQR_'.$i.'.png', QR_ECLEVEL_L, 2, 1);
                    echo '
                    <img class = "logsheetText YC-Code" style="-webkit-user-select: none;" src="GeneratedCodes/gasCQR_'.$i.'.png">
                    <input type = "text" class = "logsheetText IDYC" value = "GC '.$row['gasCID'].'" readonly>
                    <input type = "text" class = "logsheetText field1C" value = "'.$row['Code'].'" readonly>
                    <input type = "text" class = "logsheetText field3CY" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field5CY" value = "'.$row['Pre Laser'].'" readonly>';
                } 
                while ($row = mysqli_fetch_array($filterCResult[$i+1])) {
                    QRcode::png('GC '.$row['gasCID'], 'GeneratedCodes/gasCQR_'.($i+1).'.png', QR_ECLEVEL_L, 2, 1);
                    echo '
                    <img class = "logsheetText RC-Code" style="-webkit-user-select: none;" src="GeneratedCodes/gasCQR_'.($i+1).'.png">
                    <input type = "text" class = "logsheetText IDRC" value = "GC '.$row['gasCID'].'" readonly>
                    <input type = "text" class = "logsheetText field2C" value = "'.$row['Code'].'" readonly>
                    <input type = "text" class = "logsheetText field3CR" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field5CR" value = "'.$row['Pre Laser'].'" readonly>';
                }
                while ($row = mysqli_fetch_array($filterFResult[$i])) {
                    QRcode::png('GF '.$row['gasFID'], 'GeneratedCodes/gasFQR_'.$i.'.png', QR_ECLEVEL_L, 2, 1);
                    echo '
                    <img class = "logsheetText YF-Code" style="-webkit-user-select: none;" src="GeneratedCodes/gasFQR_'.$i.'.png">
                    <input type = "text" class = "logsheetText IDYF" value = "GF '.$row['gasFID'].'" readonly>
                    <input type = "text" class = "logsheetText field1F" value = "'.$row['Code'].'" readonly>
                    <input type = "text" class = "logsheetText field4FY" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field6FY" value = "'.$row['Pre Laser'].'" readonly>';
                } 
                while ($row = mysqli_fetch_array($filterFResult[$i+1])) {
                    QRcode::png('GF '.$row['gasFID'], 'GeneratedCodes/gasFQR_'.($i+1).'.png', QR_ECLEVEL_L, 2, 1);
                    echo '
                    <img class = "logsheetText RF-Code" style="-webkit-user-select: none;" src="GeneratedCodes/gasFQR_'.($i+1).'.png">
                    <input type = "text" class = "logsheetText IDRF" value = "GF '.$row['gasFID'].'" readonly>
                    <input type = "text" class = "logsheetText field2F" value = "'.$row['Code'].'" readonly>
                    <input type = "text" class = "logsheetText field4FR" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field6FR" value = "'.$row['Pre Laser'].'" readonly>
                    <img class = "printA4" src="Images/GASLogsheet2.png">';
                }
                echo '</div>';
            }
            echo '</div>';
        ?>

        <script type="text/javascript">
            window.onload = function HideDiv () {
                document.getElementById('hiddenDiv').style.display = 'none';
            }
        </script>
    </body>
</html>