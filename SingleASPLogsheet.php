<?php
    session_start();
    require_once("nocache.php");
    require_once("db_connect.php");
    require_once('phpqrcode/qrlib.php');

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

    if (isset($_GET["id"])) {
        $query1 = "SELECT * FROM asp WHERE `aspID` = ".$_GET["id"];
        $results1 = mysqli_query($connection, $query1);
        $query2 = "SELECT * FROM asp WHERE `aspID` = ".($_GET["id"]+1);
        $results2 = mysqli_query($connection, $query2);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Logsheet</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });

            function PrintSheet () {
                var printContents = document.getElementById('PrintDiv').innerHTML;
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
            .OFF {
                margin: 200px 0px 0px 885px;
                width: 1000px;
            }
            .barcodeY {
                margin: 118px 0px 0px 285px;
            }
            .IDY {
                margin: 135px 0px 0px 340px;
                width: 70px;
                text-align:center;
            }
            .barcodeR {
                margin: 174px 0px 0px 285px;
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
            .field7 {
                margin: 379px 0px 0px 300px;
                font-size: 14px;
            }
            .field8 {
                margin: 409px 0px 0px 300px;
                font-size: 14px;
            }
            .field9 {
                margin: 438px 0px 0px 300px;
                font-size: 14px;
            }
            .field10 {
                margin: 578px 0px 0px 300px;
                font-size: 14px;
            }
            .field11 {
                margin: 618px 0px 0px 300px;
                font-size: 14px;
            }
            .field12 {
                margin: 647px 0px 0px 300px;
                font-size: 14px;
            }
            .field13 {
                margin: 676px 0px 0px 300px;
                font-size: 14px;
            }
            .field14 {
                margin: 706px 0px 0px 300px;
                font-size: 14px;
            }
            .field15 {
                margin: 231px 0px 0px 600px;
                font-size: 14px;
            }
            .field16 {
                margin: 261px 0px 0px 600px;
                font-size: 14px;
            }
            .field17 {
                margin: 291px 0px 0px 600px;
                font-size: 14px;
            }
            .field18 {
                margin: 321px 0px 0px 600px;
                font-size: 14px;
            }
            .field19 {
                margin: 379px 0px 0px 600px;
                font-size: 14px;
            }
            .field20 {
                margin: 409px 0px 0px 600px;
                font-size: 14px;
            }
            .field21 {
                margin: 438px 0px 0px 600px;
                font-size: 14px;
            }
            .field22 {
                margin: 618px 0px 0px 600px;
                font-size: 14px;
            }
            .field23 {
                margin: 647px 0px 0px 600px;
                font-size: 14px;
            }
            .field24 {
                margin: 676px 0px 0px 600px;
                font-size: 14px;
            }
            .field25 {
                margin: 706px 0px 0px 600px;
                font-size: 14px;
            }
            .field26 {
                margin: 745px 0px 0px 600px;
                font-size: 14px;
            }
            .field27 {
                margin: 775px 0px 0px 600px;
                font-size: 14px;
            }
            .field28 {
                margin: 815px 0px 0px 600px;
                font-size: 14px;
            }
            .field29 {
                margin: 845px 0px 0px 600px;
                font-size: 14px;
            }
            .commentsField {
                margin: 975px 0px 0px 35px;
                resize:none;
                text-align: center;
            }
        </style>

    </head>

    <body>
        <!--Navigation Bar-->
        <div id="navBar"></div>
        <!--Second Bar-->
        <div class = "secondBarContainer">
            <div class = "secondBar">
                <a href="ExistingASPLogsheets.php" style = "font-family:helvetica;">Back</a>
                <div class = "rightDiv">
                    <a href="logoff.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <div class = "centeredContent container-ansto" style = "padding:20px;">
            <?php
            if ($results1 && $results2) {
                // Display all information on the logsheet for the first filter (Yellow)
                while ($row = mysqli_fetch_array($results1)) {
                    // Get date in AUS format
                    $date = $row['Exposure Day'].'-'.$row['Exposure Month'].'-'.$row['Exposure Year'];
                    $qrString = $row['aspID'].' | '.$row['Site'].' '.$date.' '.$row['Type'].' | Wt '.round($row['Pre Filter Mass'],3).
                    ' | LA '.round($row['Pre Laser'],3).' | MABI '.round($row['I0 (405)'],3).' '.round($row['I0 (465)'],3).' '.round($row['I0 (525)'],3).' '
                    .round($row['I0 (639)'],3).' '.round($row['I0 (870)'],3).' '.round($row['I0 (940)'],3).' '.round($row['I0 (1050)'],3);
                    QRcode::png($qrString, 'GeneratedCodes/qrCode1.png', QR_ECLEVEL_L, 1.3, 1);
                    echo '
                    <img class = "logsheetText barcodeY" style="-webkit-user-select: none;" src="GeneratedCodes/qrCode1.png">
                    <input type = "text" class = "logsheetText IDY" value = "'.$row['aspID'].'" readonly>
                    <input type = "text" class = "logsheetText field1" value = "'.$row['Site'].' '.$date.' '.$row['Type'].'" readonly>
                    <input type = "text" class = "logsheetText field3" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field5" value = "'.$row['Pre Laser'].'" readonly>
                    <input type = "text" class = "logsheetText field15" value = "'.$row['Post Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field17" value = "'.$row['Post Laser'].'" readonly>
                    <input type = "text" class = "logsheetText field11" value = "'.$row['Vacuum'].'" readonly>
                    <input type = "text" class = "logsheetText field12" value = "'.$row['Magnehelic'].'" readonly>
                    <input type = "text" class = "logsheetText field22" value = "'.$row['Vacuum4'].'" readonly>
                    <input type = "text" class = "logsheetText field23" value = "'.$row['Magnehelic5'].'" readonly>
                    <input type = "text" class = "logsheetText field26" value = "'.$row['Elapsed Time'].'" readonly>';

                    // Clean filter detials shared by both filters
                    echo '
                    <input type = "text" class = "logsheetText field7" value = "'.$row['Date'].'" readonly>
                    <input type = "text" class = "logsheetText field8" value = "'.$row['Time'].'" readonly>
                    <input type = "text" class = "logsheetText field9" value = "'.$row['Initials'].'" readonly>
                    <input type = "text" class = "logsheetText field10" value = "'.$row['Vacuum Pinch Tube'].'" readonly>';

                    // Exposed filter detials shared by both filters
                    echo '
                    <input type = "text" class = "logsheetText field19" value = "'.$row['Date2'].'" readonly>
                    <input type = "text" class = "logsheetText field20" value = "'.$row['Time2'].'" readonly>
                    <input type = "text" class = "logsheetText field21" value = "'.$row['Initials2'].'" readonly>
                    <input type = "text" class = "logsheetText field28" value = "'.$row['Temperature Max'].'" readonly>
                    <input type = "text" class = "logsheetText field29" value = "'.$row['Temperature Min'].'" readonly>
                    <textarea rows="2" cols="100" class = "logsheetText commentsField" readonly>'.$row['Comments'].'</textarea>';
                }

                // Display all information on the logsheet for the second filter (Red) 
                while ($row = mysqli_fetch_array($results2)) {
                    // Get date in AUS format
                    $date = $row['Exposure Day'].'-'.$row['Exposure Month'].'-'.$row['Exposure Year'];
                    $qrString = $row['aspID'].' | '.$row['Site'].' '.$date.' '.$row['Type'].' | Wt '.round($row['Pre Filter Mass'],3).
                    ' | LA '.round($row['Pre Laser'],3).' | MABI '.round($row['I0 (405)'],3).' '.round($row['I0 (465)'],3).' '.round($row['I0 (525)'],3).' '
                    .round($row['I0 (639)'],3).' '.round($row['I0 (870)'],3).' '.round($row['I0 (940)'],3).' '.round($row['I0 (1050)'],3);
                    QRcode::png($qrString, 'GeneratedCodes/qrCode2.png', QR_ECLEVEL_L, 1.3, 1);
                    echo '
                    <img class = "logsheetText barcodeR" style="-webkit-user-select: none;" src="GeneratedCodes/qrCode2.png">
                    <input type = "text" class = "logsheetText IDR" value = "'.$row['aspID'].'" readonly>
                    <input type = "text" class = "logsheetText field2" value = "'.$row['Site'].' '.$date.' '.$row['Type'].'" readonly>
                    <input type = "text" class = "logsheetText field4" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field6" value = "'.$row['Pre Laser'].'" readonly>
                    <input type = "text" class = "logsheetText field16" value = "'.$row['Post Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field18" value = "'.$row['Post Laser'].'" readonly>
                    <input type = "text" class = "logsheetText field13" value = "'.$row['Vacuum'].'" readonly>
                    <input type = "text" class = "logsheetText field14" value = "'.$row['Magnehelic'].'" readonly>
                    <input type = "text" class = "logsheetText field24" value = "'.$row['Vacuum4'].'" readonly>
                    <input type = "text" class = "logsheetText field25" value = "'.$row['Magnehelic5'].'" readonly>
                    <input type = "text" class = "logsheetText field27" value = "'.$row['Elapsed Time'].'" readonly>
                    <img class = "printA4" src="Images/ASPLogsheet2.jpg">';
                }
            }
            ?>
            <form action = "SaveSuccess.html">
                <div class = "row">
                    <input type = 'button' class = "btn-ansto" value = "Back" style = "margin-top:15px; font-size:20px;" onclick = "location.href='ExistingASPLogsheets.php'">
                    <input type = "button" class = "btn-ansto floatRight" value = "Print" style = "margin-top:15px; font-size:20px;" onclick = "PrintSheet();">
                </div>
            </form>
        </div>

        <div id = "PrintDiv" stype = "display:none;">
            <?php
            // Re-run Query
            if (isset($_GET["id"])) {
                $query1 = "SELECT * FROM asp WHERE `aspID` = ".$_GET["id"];
                $results1 = mysqli_query($connection, $query1);
                $query2 = "SELECT * FROM asp WHERE `aspID` = ".($_GET["id"]+1);
                $results2 = mysqli_query($connection, $query2);
            }
            if ($results1 && $results2) {
                // Display all information on the logsheet for the first filter (Yellow)
                while ($row = mysqli_fetch_array($results1)) {
                    // Get date in AUS format
                    $date = $row['Exposure Day'].'-'.$row['Exposure Month'].'-'.$row['Exposure Year'];
                    $qrString = $row['aspID'].' | '.$row['Site'].' '.$date.' '.$row['Type'].' | Wt '.round($row['Pre Filter Mass'],3).
                    ' | LA '.round($row['Pre Laser'],3).' | MABI '.round($row['I0 (405)'],3).' '.round($row['I0 (465)'],3).' '.round($row['I0 (525)'],3).' '
                    .round($row['I0 (639)'],3).' '.round($row['I0 (870)'],3).' '.round($row['I0 (940)'],3).' '.round($row['I0 (1050)'],3);
                    QRcode::png($qrString, 'GeneratedCodes/qrCode1.png', QR_ECLEVEL_L, 1.3, 1);
                    echo '
                    <img class = "logsheetText barcodeY" style="-webkit-user-select: none;" src="GeneratedCodes/qrCode1.png">
                    <input type = "text" class = "logsheetText IDY" value = "'.$row['aspID'].'" readonly>
                    <input type = "text" class = "logsheetText field1" value = "'.$row['Site'].' '.$date.' '.$row['Type'].'" readonly>
                    <input type = "text" class = "logsheetText field3" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field5" value = "'.$row['Pre Laser'].'" readonly>
                    <input type = "text" class = "logsheetText field15" value = "'.$row['Post Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field17" value = "'.$row['Post Laser'].'" readonly>
                    <input type = "text" class = "logsheetText field11" value = "'.$row['Vacuum'].'" readonly>
                    <input type = "text" class = "logsheetText field12" value = "'.$row['Magnehelic'].'" readonly>
                    <input type = "text" class = "logsheetText field22" value = "'.$row['Vacuum4'].'" readonly>
                    <input type = "text" class = "logsheetText field23" value = "'.$row['Magnehelic5'].'" readonly>
                    <input type = "text" class = "logsheetText field26" value = "'.$row['Elapsed Time'].'" readonly>';

                    // Clean filter detials shared by both filters
                    echo '
                    <input type = "text" class = "logsheetText field7" value = "'.$row['Date'].'" readonly>
                    <input type = "text" class = "logsheetText field8" value = "'.$row['Time'].'" readonly>
                    <input type = "text" class = "logsheetText field9" value = "'.$row['Initials'].'" readonly>
                    <input type = "text" class = "logsheetText field10" value = "'.$row['Vacuum Pinch Tube'].'" readonly>';

                    // Exposed filter detials shared by both filters
                    echo '
                    <input type = "text" class = "logsheetText field19" value = "'.$row['Date2'].'" readonly>
                    <input type = "text" class = "logsheetText field20" value = "'.$row['Time2'].'" readonly>
                    <input type = "text" class = "logsheetText field21" value = "'.$row['Initials2'].'" readonly>
                    <input type = "text" class = "logsheetText field28" value = "'.$row['Temperature Max'].'" readonly>
                    <input type = "text" class = "logsheetText field29" value = "'.$row['Temperature Min'].'" readonly>
                    <textarea rows="2" cols="100" class = "logsheetText commentsField" readonly>'.$row['Comments'].'</textarea>';
                }

                // Display all information on the logsheet for the second filter (Red) 
                while ($row = mysqli_fetch_array($results2)) {
                    // Get date in AUS format
                    $date = $row['Exposure Day'].'-'.$row['Exposure Month'].'-'.$row['Exposure Year'];
                    $qrString = $row['aspID'].' | '.$row['Site'].' '.$date.' '.$row['Type'].' | Wt '.round($row['Pre Filter Mass'],3).
                    ' | LA '.round($row['Pre Laser'],3).' | MABI '.round($row['I0 (405)'],3).' '.round($row['I0 (465)'],3).' '.round($row['I0 (525)'],3).' '
                    .round($row['I0 (639)'],3).' '.round($row['I0 (870)'],3).' '.round($row['I0 (940)'],3).' '.round($row['I0 (1050)'],3);
                    QRcode::png($qrString, 'GeneratedCodes/qrCode2.png', QR_ECLEVEL_L, 1.3, 1);
                    echo '
                    <img class = "logsheetText barcodeR" style="-webkit-user-select: none;" src="GeneratedCodes/qrCode2.png">
                    <input type = "text" class = "logsheetText IDR" value = "'.$row['aspID'].'" readonly>
                    <input type = "text" class = "logsheetText field2" value = "'.$row['Site'].' '.$date.' '.$row['Type'].'" readonly>
                    <input type = "text" class = "logsheetText field4" value = "'.$row['Pre Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field6" value = "'.$row['Pre Laser'].'" readonly>
                    <input type = "text" class = "logsheetText field16" value = "'.$row['Post Filter Mass'].'" readonly>
                    <input type = "text" class = "logsheetText field18" value = "'.$row['Post Laser'].'" readonly>
                    <input type = "text" class = "logsheetText field13" value = "'.$row['Vacuum'].'" readonly>
                    <input type = "text" class = "logsheetText field14" value = "'.$row['Magnehelic'].'" readonly>
                    <input type = "text" class = "logsheetText field24" value = "'.$row['Vacuum4'].'" readonly>
                    <input type = "text" class = "logsheetText field25" value = "'.$row['Magnehelic5'].'" readonly>
                    <input type = "text" class = "logsheetText field27" value = "'.$row['Elapsed Time'].'" readonly>
                    <img class = "printA4" src="Images/ASPLogsheet2.jpg">';
                }
            }
            ?>
        </div>

        <script type="text/javascript">
            window.onload = function HideDiv () {
                document.getElementById('PrintDiv').style.display = 'none';
            }
        </script>
    </body>
</html>

<?php mysqli_close($connection) ?>