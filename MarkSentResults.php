<?php
    require_once("db_connect.php");

    if (isset($_POST['wedDate'])) {
        $wedDate = $_POST['wedDate'];
        $wedDay = $_POST['wedDay'];
        $wedMonth = $_POST['wedMonth'];
        $wedYear = $_POST['wedYear'];
        $USAWedDate = $wedYear.'-'.$wedMonth.'-'.$wedDay;

        $sunDate = $_POST['sunDate'];
        $sunDay = $_POST['sunDay'];
        $sunMonth = $_POST['sunMonth'];
        $sunYear = $_POST['sunYear'];
        $USASunDate = $sunYear.'-'.$sunMonth.'-'.$sunDay;
    }

    date_default_timezone_set('Australia/Sydney');
    $today = date("d-m-Y");

    $ASPResultsFound = false;
    $GASResultsFound = false;
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

        <?php 
            if (isset($_POST['site'])) {
                $sites = $_POST['site'];

                // Get exposure code
                for ($i=0; $i < sizeof($sites); $i++) { 
                    $wedSND[$i] = $sites[$i]." ".$wedDate;
                    $sunSND[$i] = $sites[$i]." ".$sunDate;
                }

                // Get filters information to display for ASP
                for ($i=0; $i < sizeof($sites); $i++) {
                    $ASPSite = $sites[$i];
                    $ASPQuery[$i] = mysqli_query($connection, "SELECT * FROM asp WHERE 
                        (`PostDate` = '' OR `PostDate` IS NULL) AND 
                        `Site` = '$ASPSite' AND 
                        (`Exposure Day` = '$wedDay' OR `Exposure Day` = '$sunDay') AND 
                        (`Exposure Month` = '$wedMonth' OR `Exposure Month` = '$sunMonth') AND 
                        (`Exposure Year` = '$wedYear' OR `Exposure Year` = '$sunYear')");
                    if (mysqli_num_rows($ASPQuery[$i]) > 0) {
                        $ASPResultsFound = true;
                    }
                }

                // Get filters information to display for GAS
                for ($i=0; $i < sizeof($sites); $i++) {
                    $GASSite = $sites[$i];
                    $GASCQuery[$i] = mysqli_query($connection, "SELECT * FROM gasc WHERE 
                        (`PostDate` = '' OR `PostDate` IS NULL) AND 
                        `Site` = '$GASSite' AND 
                        (`Exposure Day` = '$wedDay' OR `Exposure Day` = '$sunDay') AND 
                        (`Exposure Month` = '$wedMonth' OR `Exposure Month` = '$sunMonth') AND 
                        (`Exposure Year` = '$wedYear' OR `Exposure Year` = '$sunYear')");
                    if (mysqli_num_rows($GASCQuery[$i]) > 0) {
                        $GASResultsFound = true;
                    }
                    $GASFQuery[$i] = mysqli_query($connection, "SELECT * FROM gasf WHERE 
                        (`PostDate` = '' OR `PostDate` IS NULL) AND 
                        `Site` = '$GASSite' AND 
                        (`Exposure Day` = '$wedDay' OR `Exposure Day` = '$sunDay') AND 
                        (`Exposure Month` = '$wedMonth' OR `Exposure Month` = '$sunMonth') AND 
                        (`Exposure Year` = '$wedYear' OR `Exposure Year` = '$sunYear')");
                    if (mysqli_num_rows($GASFQuery[$i]) > 0) {
                        $GASResultsFound = true;
                    }
                }

                // Set the current date as PostDate for each resulting filter
                for ($i=0; $i < sizeof($sites); $i++) {
                    $site = $sites[$i];
                    $ASPUpdateQuery[$i] = mysqli_query($connection, "UPDATE asp SET `PostDate` = '$today' WHERE 
                        (`PostDate` = '' OR `PostDate` IS NULL) AND 
                        `Site` = '$site' AND 
                        (`Exposure Day` = '$wedDay' OR `Exposure Day` = '$sunDay') AND 
                        (`Exposure Month` = '$wedMonth' OR `Exposure Month` = '$sunMonth') AND 
                        (`Exposure Year` = '$wedYear' OR `Exposure Year` = '$sunYear')");
                    $GASCUpdateQuery[$i] = mysqli_query($connection, "UPDATE gasc SET `PostDate` = '$today' WHERE 
                        (`PostDate` = '' OR `PostDate` IS NULL) AND 
                        `Site` = '$site' AND 
                        (`Exposure Day` = '$wedDay' OR `Exposure Day` = '$sunDay') AND 
                        (`Exposure Month` = '$wedMonth' OR `Exposure Month` = '$sunMonth') AND 
                        (`Exposure Year` = '$wedYear' OR `Exposure Year` = '$sunYear')");
                    $GASFUpdateQuery[$i] = mysqli_query($connection, "UPDATE gasf SET `PostDate` = '$today' WHERE 
                        (`PostDate` = '' OR `PostDate` IS NULL) AND 
                        `Site` = '$site' AND 
                        (`Exposure Day` = '$wedDay' OR `Exposure Day` = '$sunDay') AND 
                        (`Exposure Month` = '$wedMonth' OR `Exposure Month` = '$sunMonth') AND 
                        (`Exposure Year` = '$wedYear' OR `Exposure Year` = '$sunYear')");
                }

                if(sizeof($sites) > 0 && $ASPResultsFound || $GASResultsFound){

                    echo '
                    <div id = "sentDisplay" class = "container-ansto dynamic-content-700-570">
                        <!--Title-->
                        <p class = "H190Width" style = "font-size:25px;">Filters below have been marked as sent</p>
                        <table class = "centeredItem" style = "margin:20px;">
                            <tr>
                                <th class = "staticData columnTitle smallFont">ID</th>
                                <th class = "staticData columnTitle smallFont">Site</th>
                                <th class = "staticData columnTitle smallFont">Exposure Date</th>
                                <th class = "staticData columnTitle smallFont">Sampling Day</th>
                                <th class = "staticData columnTitle smallFont">Pre-Mass</th>
                                <th class = "staticData columnTitle smallFont">Pre-Laser</th>
                                <th class = "staticData columnTitle smallFont">Sent Date</th>
                            </tr>';

                    if($ASPResultsFound){
                        for ($i=0; $i < sizeof($sites); $i++) {
                            // Display all resulting rows for ASP
                            while ($row = mysqli_fetch_array($ASPQuery[$i])) {
                                // Construct AUS Exposure Date
                                $day = $row['Exposure Day'];
                                $month = $row['Exposure Month'];
                                $year = $row['Exposure Year'];
                                $date = $day.'-'.$month.'-'.$year;

                                echo '
                                    <tr>
                                        <th class = "staticData smallFont">'.$row['aspID'].'</th>
                                        <th class = "staticData smallFont">'.$row['Site'].'</th>
                                        <th class = "staticData smallFont">'.$date.' '.$row['Type'].'</th>
                                        <th class = "staticData smallFont">'.$row['SamplingDay'].'</th>
                                        <th class = "staticData smallFont">'.$row['Pre Filter Mass'].'</th>
                                        <th class = "staticData smallFont">'.$row['Pre Laser'].'</th>
                                        <th class = "staticData smallFont">'.$today.'</th>
                                    </tr>
                                ';

                            }
                        }
                    }
                    if($GASResultsFound){
                        for ($i=0; $i < sizeof($sites); $i++) {
                            // Display all resulting rows for GAS-C
                            while ($row = mysqli_fetch_array($GASCQuery[$i])) {
                                // Construct AUS Exposure Date
                                $day = $row['Exposure Day'];
                                $month = $row['Exposure Month'];
                                $year = $row['Exposure Year'];
                                $date = $day.'-'.$month.'-'.$year;

                                echo '
                                    <tr>
                                        <th class = "staticData smallFont">GC '.$row['gasCID'].'</th>
                                        <th class = "staticData smallFont">'.$row['Site'].'</th>
                                        <th class = "staticData smallFont">'.$date.' '.$row['Type'].'</th>
                                        <th class = "staticData smallFont">'.$row['SamplingDay'].'</th>
                                        <th class = "staticData smallFont">'.$row['Pre Filter Mass'].'</th>
                                        <th class = "staticData smallFont">'.$row['Pre Laser'].'</th>
                                        <th class = "staticData smallFont">'.$today.'</th>
                                    </tr>
                                ';

                            }
                            // Display all resulting rows for GAS-F
                            while ($row = mysqli_fetch_array($GASFQuery[$i])) {
                                // Construct AUS Exposure Date
                                $day = $row['Exposure Day'];
                                $month = $row['Exposure Month'];
                                $year = $row['Exposure Year'];
                                $date = $day.'-'.$month.'-'.$year;

                                echo '
                                    <tr>
                                        <th class = "staticData smallFont">GF '.$row['gasFID'].'</th>
                                        <th class = "staticData smallFont">'.$row['Site'].'</th>
                                        <th class = "staticData smallFont">'.$date.' '.$row['Type'].'</th>
                                        <th class = "staticData smallFont">'.$row['SamplingDay'].'</th>
                                        <th class = "staticData smallFont">'.$row['Pre Filter Mass'].'</th>
                                        <th class = "staticData smallFont">'.$row['Pre Laser'].'</th>
                                        <th class = "staticData smallFont">'.$today.'</th>
                                    </tr>
                                ';

                            }
                        }
                    }
                        
                    // End of Table
                    echo '</table>
                    <input type = "button" class = "btn-ansto font-16 centeredItem" style = "margin-bottom:10px;"" onclick = "GoBack();" value = "Continue">
                    </div>';
                } else if (sizeof($sites) > 0 && !$ASPResultsFound && !$GASResultsFound) {
                    echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px; width:300px;">';
                    echo "<p class = 'H190Width'>No Results</p>";
                    echo '<input type = "button" class = "btn-ansto font-16 centeredItem" style = "margin-bottom:10px;"" onclick = "GoBack();" value = "Back">';
                }
            } else {
                echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px; width:500px;">';
                echo "<p class = 'H190Width'>You did not select any sites</p>";
                echo '<input type = "button" class = "btn-ansto font-16 centeredItem" style = "margin-bottom:10px;"" onclick = "GoBack();" value = "Back">';
            }
            
        ?>

    </body>
</html>

<script type="text/javascript">
    function GoBack () {
        window.location.href = "MarkSentFilters.php";
    }
</script>

<?php
mysqli_close($connection)
?>