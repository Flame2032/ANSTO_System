<?php
    require_once("db_connect.php");

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
            .barcodeY {
                margin: 128px 0px 0px 300px;
                font-size: 16px;
                width: 100px;
            }
            .barcodeR {
                margin: 173px 0px 0px 300px;
                font-size: 16px;
                width: 100px;
            }
            .field1 {
                margin: 128px 0px 0px 470px;
                font-size: 16px;
            }
            .field2 {
                margin: 173px 0px 0px 470px;
                font-size: 16px;
            }
            .field3 {
                margin: 209px 0px 0px 300px;
                font-size: 14px;
            }
            .field4 {
                margin: 239px 0px 0px 300px;
                font-size: 14px;
            }
            .field5 {
                margin: 269px 0px 0px 300px;
                font-size: 14px;
            }
            .field6 {
                margin: 299px 0px 0px 300px;
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
                    echo "[".$row['Code']."] + ";
                }
                while ($row = mysqli_fetch_array($filterResult[$i+1])) {
                    echo "[".$row['Code']."] ";
                }
                echo '</div>';
            }

            echo '
            <div class = "bottomStrip"><button class = "printAllButton" onclick = "PrintAllLogsheets('; echo "'hiddenDiv'"; echo ');">Print All</button></div>

            <div id = "hiddenDiv" style = "display:none;">';

            // Re-run the query
            for ($i=0; $i < $num; $i++) { 
                $filterQuery[$i] = "SELECT * FROM asp WHERE aspID =  ".($min+$i);
                $filterResult[$i] = mysqli_query($connection, $filterQuery[$i]);
            }

            for ($i=0; $i < $num; $i+=2) { 
                echo '<div id = '; echo "'$i'"; echo '>';
                while ($row = mysqli_fetch_array($filterResult[$i])) {
                    echo '
                    <input type = "text" class = "logsheetText barcodeY" value = "Barcode Y" readonly>
                    <input type = "text" class = "logsheetText field1" value = "'.$row['Code'].'" readonly>
                    <input type = "text" class = "logsheetText field3" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field5" value = "'.$row['Pre Laser'].'" readonly>';
                } 
                while ($row = mysqli_fetch_array($filterResult[$i+1])) {
                    echo '
                    <input type = "text" class = "logsheetText barcodeR" value = "Barcode R" readonly>
                    <input type = "text" class = "logsheetText field2" value = "'.$row['Code'].'" readonly>
                    <input type = "text" class = "logsheetText field4" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field6" value = "'.$row['Pre Laser'].'" readonly>
                    <img class = "printA4" src="Images/ASPLogsheet.jpg">';
                }
                echo '</div>';
            }
            echo '</div>';
        ?>
    </body>
</html>