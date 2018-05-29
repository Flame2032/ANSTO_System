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
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
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
            /*Load in custom barcode font*/
            @font-face{
                font-family: 'Code128';
                src:url('CSS/Code_128/Code128.woff') format('woff'),
                    url('CSS/Code_128/Code128.woff2') format('woff2');
            }
            .barcodeY {
                margin: 120px 0px 0px 285px;
            }
            .IDY {
                margin: 135px 0px 0px 340px;
                width: 70px;
				text-align:center;
            }
            .barcodeR {
                margin: 175px 0px 0px 285px;
            }
            .IDR {
                margin: 190px 0px 0px 340px;
                width: 70px;
				text-align:center;
            }
            .barcode {
                font-family: 'Code128';
                width: 126px;
                padding: 0px;
                text-align: center;
                font-size: 40px;
                border-style: none;
                display: block;
            }
            .barcodeID {
                width: 126px;
                padding: 0px;
                font-size: 12px;
                text-align: center;
                border-style: none;
                display: block;
            }
            .field1 {
                margin: 135px 0px 0px 470px;
                font-size: 16px;
            }
            .field2 {
                margin: 190px 0px 0px 470px;
                font-size: 16px;
            }
            .field3 {
                margin: 231px 0px 0px 300px;
                font-size: 14px;
            }
            .field4 {
                margin: 261px 0px 0px 300px;
                font-size: 14px;
            }
            .field5 {
                margin: 291px 0px 0px 300px;
                font-size: 14px;
            }
            .field6 {
                margin: 321px 0px 0px 300px;
                font-size: 14px;
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
            if (isset($_POST['minID'])) {
                $min = $_POST['minID'];
            }
            if (isset($_POST['num'])) {
                $num = $_POST['num'];
            }

            // Get filter information to be placed on logsheets
            for ($i=0; $i < $num; $i++) { 
                $filterQuery[$i] = "SELECT * FROM asp WHERE aspID =  ".($min+$i);
                $filterResult[$i] = mysqli_query($connection, $filterQuery[$i]);
            }

            // Display individual logsheet links
            echo 
            '<div class = "content">
            <h2>List of generated logsheets:</h2>';

            for ($i=0; $i < $num; $i+=2) { 
                echo '<div class = "generatedSheet logsheetLink" onclick = "PrintSingleLogsheet('; echo "'$i'"; echo ');">';
                while ($row = mysqli_fetch_array($filterResult[$i])) {
                    echo $row['aspID'];
                    echo " [".$row['Code'].", ".$row['Exposure Date']." ".$row['Type']."] + ";
                }
                while ($row = mysqli_fetch_array($filterResult[$i+1])) {
                    echo $row['aspID'];
                    echo " [".$row['Code'].", ".$row['Exposure Date']." ".$row['Type']."]";
                }
                echo '</div>';
            }

            echo '
            <div class = "bottomStrip"><button class = "printAllButton" onclick = "PrintAllLogsheets('; echo "'hiddenDiv'"; echo ');">Print All</button></div>

            <div id = "hiddenDiv">';


            // Re-run the query
            for ($i=0; $i < $num; $i++) { 
                $filterQuery[$i] = "SELECT * FROM asp WHERE aspID =  ".($min+$i);
                $filterResult[$i] = mysqli_query($connection, $filterQuery[$i]);
            }

            for ($i=0; $i < $num; $i+=2) { 
                echo '<div id = '; echo "'$i'"; echo '>';
                while ($row = mysqli_fetch_array($filterResult[$i])) {
                    QRcode::png($row['aspID'], 'GeneratedCodes/qrCode'.$i.'.png', QR_ECLEVEL_L, 2, 1);
                    echo '
                    <img class = "logsheetText barcodeY" style="-webkit-user-select: none;" src="GeneratedCodes/qrCode'.$i.'.png">
                    <input type = "text" class = "logsheetText IDY" value = "'.$row['aspID'].'" readonly>
                    <input type = "text" class = "logsheetText field1" value = "'.$row['Code'].' '.$row['Exposure Date'].' '.$row['Type'].'" readonly>
                    <input type = "text" class = "logsheetText field3" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field5" value = "'.$row['Pre Laser'].'" readonly>';
                } 
                while ($row = mysqli_fetch_array($filterResult[$i+1])) {
                    QRcode::png($row['aspID'], 'GeneratedCodes/qrCode'.($i+1).'.png', QR_ECLEVEL_L, 2, 1);
                    echo '
                    <img class = "logsheetText barcodeR" style="-webkit-user-select: none;" src="GeneratedCodes/qrCode'.($i+1).'.png">
                    <input type = "text" class = "logsheetText IDR" value = "'.$row['aspID'].'" readonly>
                    <input type = "text" class = "logsheetText field2" value = "'.$row['Code'].' '.$row['Exposure Date'].' '.$row['Type'].'" readonly>
                    <input type = "text" class = "logsheetText field4" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field6" value = "'.$row['Pre Laser'].'" readonly>
                    <img class = "printA4" src="Images/ASPLogsheet2.jpg">';
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