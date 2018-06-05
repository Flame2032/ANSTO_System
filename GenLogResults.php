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

    if (isset($_POST['site'])) {
        $sites = $_POST['site'];
        for ($i=0; $i < sizeof($sites); $i++) { 
            $wedSND[$i] = $sites[$i]." ".$wedDate;
            $sunSND[$i] = $sites[$i]." ".$sunDate;
        }
    }

    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    }

    // Set initial values to false
    $availableFiltersQueryResult = false;
    $availableGasCQueryResult = false;
    $availableGasCQueryResult = false;

    date_default_timezone_set('Australia/Sydney');
    $today = date("d-m-Y");
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Generate Logsheets</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });

            function GoAddSite () {
                window.location.href = "Editsites.php";
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

        <?php
            // Check whether GAS or ASP has been selected
            if($type == "ASP" && isset($_POST['site'])) {
                $availableFiltersQueryResult = mysqli_query($connection, "SELECT * FROM asp WHERE Site = ''");
            } else if ($type == "GAS" && isset($_POST['site'])) {
                $availableGasCQueryResult = mysqli_query($connection, "SELECT * FROM gasc WHERE Site = ''");
                $availableGasFQueryResult = mysqli_query($connection, "SELECT * FROM gasf WHERE Site = ''");
            }
            
            // ------------------------------ASP------------------------------
            if ($availableFiltersQueryResult) {
                // Make sure enough new filters are available for allocation
                $availableFilters = mysqli_num_rows($availableFiltersQueryResult);
                if($availableFilters >= (sizeof($sites)*2)) {

                    // Get the ID of the first filter with no exposure code
                    $minIDQuery = "SELECT aspID FROM asp WHERE aspID =  ( SELECT MIN(aspID) FROM asp WHERE Site = '' )";
                    $minIDResult = mysqli_query($connection, $minIDQuery);
                    while ($row = mysqli_fetch_array($minIDResult)) {
                        $minID = $row['aspID'];
                    }

                    // Get 2 filters for each site that has been selected (1 for wed, 1 for sun)
                    for ($i=0; $i < (sizeof($sites)*2); $i++) { 
                        $filtersQuery[$i] = "SELECT * FROM asp WHERE aspID =  ( SELECT MIN(aspID)+$i FROM asp WHERE Site = ''  )";
                        $filtersResult[$i] = mysqli_query($connection, $filtersQuery[$i]);
                    }

                    // Display
                    echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px;">';
                    echo '<div class = "centeredItem">
                    <p class = "H190Width">ASP Filters have been allocated for exposure</p>
                
                    <table class = "centeredItem" style = "margin:20px;">';

                    // Table headings
                    echo 
                    '<tr>
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
                    </tr>';

                    // Display the filters and their newly assigned Exposure codes
                    $x = 0;
                    for ($i=0; $i < (sizeof($sites)*2); $i++) { 
                        while ($row = mysqli_fetch_array($filtersResult[$i])) {

                            echo '<tr>
                                <th class = "staticData smallFont">'.$row['aspID'].'</th>';
                                // Every Odd entry is Sunday
                                if( ($i % 2) == 0){
                                    echo '<th class = "staticData smallFont">'.$wedSND[$x].' Y</th>';
                                    // Temp Values
                                    $code = $wedSND[$x].' Y';
                                    $id = $minID+$i;
                                    $site = $sites[$x];
                                    // Update the record after it's displayed
                                    $updateQuery = "UPDATE asp SET 
                                    `Exposure Day` = '$wedDay', 
                                    `Exposure Month` = '$wedMonth', 
                                    `Exposure Year` = '$wedYear',
                                    `Exposure Date` = '$USAWedDate',
                                    `Site` = '$site',
                                    `SamplingDay` = 'Wednesday',
                                    `QA` = '$today',
                                    `Type` = 'Y' 
                                    WHERE aspID = '$id'";
                                    $updateResult = mysqli_query($connection, $updateQuery);
                                } else {
                                    echo '<th class = "staticData smallFont">'.$sunSND[$x].' R</th>';
                                    // Temp Values
                                    $code = $sunSND[$x].' R';
                                    $id = $minID+$i;
                                    $site = $sites[$x];
                                    // Update the record after it's displayed
                                    $updateQuery = "UPDATE asp SET 
                                    `Exposure Day` = '$sunDay', 
                                    `Exposure Month` = '$sunMonth', 
                                    `Exposure Year` = '$sunYear',
                                    `Exposure Date` = '$USASunDate',
                                    `Site` = '$site',
                                    `SamplingDay` = 'Sunday',
                                    `QA` = '$today',
                                    `Type` = 'R'  
                                    WHERE aspID = '$id'";
                                    //$updateResult = mysqli_query($connection, $updateQuery);
                                    mysqli_query($connection, $updateQuery) or die(mysqli_error($connection));
                                    $x++;
                                }
                                
                                echo
                                '<th class = "staticData smallFont">'.$row['Pre Filter Mass'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (405)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (465)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (525)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (639)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (870)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (940)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (1050)'].'</th>
                            </tr>';
                        }
                    }
                    
                    echo '
                    </table>
                    <form action = "PrintASPLogsheets.php" method = "POST">
                        <input type = "hidden" name = "minID" value="'.$minID.'">
                        <input type = "hidden" name = "num" value="'.(sizeof($sites)*2).'">
                        <input type = "hidden" name = "type" value="'.$type.'">
                        <button class = "btn-ansto centeredItem" type = "submit" style = "margin-bottom:10px; font-size:20px;">Generate Logsheets</button>
                    </form>';
                    
                    
                }  else {
                    echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px; width:500px;">';
                    echo "<p class = 'H190Width' style = 'font-size:20px;'>Not enough new filters available for allocation</p>";
                    echo '<input type = "button" class = "btn-ansto font-16 centeredItem" style = "margin-bottom:10px;"" onclick = "GoBack();" value = "Back">';
                }
            //------------------------------GAS------------------------------
            } else if ($availableGasCQueryResult && $availableGasFQueryResult) { 

                // Make sure enough new filters are available for allocation (in both course and fine tables)
                $availableCFilters = mysqli_num_rows($availableGasCQueryResult);
                $availableFFilters = mysqli_num_rows($availableGasFQueryResult);
                if($availableCFilters >= (sizeof($sites)*2) && $availableFFilters >= (sizeof($sites)*2)) {

                    // Get the ID of the first filter with no exposure code
                    $minCIDQuery = "SELECT gasCID FROM gasc WHERE gasCID =  ( SELECT MIN(gasCID) FROM gasc WHERE Site = '' )";
                    $minCIDResult = mysqli_query($connection, $minCIDQuery);
                    while ($row = mysqli_fetch_array($minCIDResult)) {
                        $minCID = $row['gasCID'];
                    }
                    $minFIDQuery = "SELECT gasFID FROM gasf WHERE gasFID =  ( SELECT MIN(gasFID) FROM gasf WHERE Site = '' )";
                    $minFIDResult = mysqli_query($connection, $minFIDQuery);
                    if ($minFIDResult) {
                        while ($row = mysqli_fetch_array($minFIDResult)) {
                            $minFID = $row['gasFID'];
                        }
                    }
                    

                    // Get 4 filters for each site that has been selected (G+C for wed, G+C for sun)
                    for ($i=0; $i < (sizeof($sites)*2); $i++) { 
                        $CfiltersQuery[$i] = "SELECT * FROM gasc WHERE gasCID =  ( SELECT MIN(gasCID)+$i FROM gasc WHERE Site = ''  )";
                        $CfiltersResult[$i] = mysqli_query($connection, $CfiltersQuery[$i]);
                        $FfiltersQuery[$i] = "SELECT * FROM gasf WHERE gasFID =  ( SELECT MIN(gasFID)+$i FROM gasf WHERE Site = ''  )";
                        $FfiltersResult[$i] = mysqli_query($connection, $FfiltersQuery[$i]);
                    }

                    // Display
                    echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px;">';
                    echo '<div class = "centeredItem">
                    <p class = "H190Width">GAS Filters have been allocated for exposure</p>
                
                    <table class = "centeredItem" style = "margin:20px;">';

                    // Table headings
                    echo 
                    '<tr>
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
                    </tr>';

                    // Display the filters and their newly assigned Exposure codes
                    $x = 0;
                    for ($i=0; $i < (sizeof($sites)*2); $i++) { 
                        // Gas Course
                        while ($row = mysqli_fetch_array($CfiltersResult[$i])) {

                            echo '<tr>
                                <th class = "staticData smallFont">GC '.$row['gasCID'].'</th>';
                                // Every Odd entry is Sunday
                                if( ($i % 2) == 0){
                                    echo '<th class = "staticData smallFont">'.$wedSND[$x].' C</th>';
                                    // Temp Values
                                    $code = $wedSND[$x].' C';
                                    $id = $minCID+$i;
                                    $site = $sites[$x];
                                    // Update the record after it's displayed
                                    $updateQuery = "UPDATE gasc SET 
                                    `Exposure Day` = '$wedDay', 
                                    `Exposure Month` = '$wedMonth', 
                                    `Exposure Year` = '$wedYear',
                                    `Exposure Date` = '$USAWedDate',
                                    `Site` = '$site',
                                    `SamplingDay` = 'Wednesday',
                                    `QA` = '$today',
                                    `Type` = 'C'   
                                    WHERE gasCID = '$id'";
                                    $updateResult = mysqli_query($connection, $updateQuery);
                                } else {
                                    echo '<th class = "staticData smallFont">'.$sunSND[$x].' C</th>';
                                    // Temp Values
                                    $code = $sunSND[$x].' C';
                                    $id = $minCID+$i;
                                    $site = $sites[$x];
                                    // Update the record after it's displayed
                                    $updateQuery = "UPDATE gasc SET 
                                    `Exposure Day` = '$sunDay', 
                                    `Exposure Month` = '$sunMonth', 
                                    `Exposure Year` = '$sunYear',
                                    `Exposure Date` = '$USASunDate',
                                    `Site` = '$site',
                                    `SamplingDay` = 'Sunday',
                                    `QA` = '$today',
                                    `Type` = 'C'  
                                    WHERE gasCID = '$id'";
                                    $updateResult = mysqli_query($connection, $updateQuery);
                                }
                                
                                echo
                                '<th class = "staticData smallFont">'.$row['Pre Filter Mass'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (405)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (465)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (525)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (639)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (870)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (940)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (1050)'].'</th>
                            </tr>';
                        }
                        // Gas Fine
                        while ($row = mysqli_fetch_array($FfiltersResult[$i])) {

                            echo '<tr>
                                <th class = "staticData smallFont">GF '.$row['gasFID'].'</th>';
                                // Every Odd entry is Sunday
                                if( ($i % 2) == 0){
                                    echo '<th class = "staticData smallFont">'.$wedSND[$x].' F</th>';
                                    // Temp Values
                                    $code = $wedSND[$x].' F';
                                    $id = $minFID+$i;
                                    $site = $sites[$x];
                                    // Update the record after it's displayed
                                    $updateQuery = "UPDATE gasf SET
                                    `Exposure Day` = '$wedDay', 
                                    `Exposure Month` = '$wedMonth', 
                                    `Exposure Year` = '$wedYear',
                                    `Exposure Date` = '$USAWedDate',
                                    `Site` = '$site',
                                    `SamplingDay` = 'Wednesday',
                                    `QA` = '$today',
                                    `Type` = 'F'   
                                    WHERE gasFID = '$id'";
                                    $updateResult = mysqli_query($connection, $updateQuery);
                                } else {
                                    echo '<th class = "staticData smallFont">'.$sunSND[$x].' F</th>';
                                    // Temp Values
                                    $code = $sunSND[$x].' F';
                                    $id = $minFID+$i;
                                    $site = $sites[$x];
                                    // Update the record after it's displayed
                                    $updateQuery = "UPDATE gasf SET
                                    `Exposure Day` = '$sunDay', 
                                    `Exposure Month` = '$sunMonth', 
                                    `Exposure Year` = '$sunYear',
                                    `Exposure Date` = '$USASunDate',
                                    `Site` = '$site',
                                    `SamplingDay` = 'Sunday',
                                    `QA` = '$today',
                                    `Type` = 'F'  
                                    WHERE gasFID = '$id'";
                                    $updateResult = mysqli_query($connection, $updateQuery);
                                    $x++;
                                }
                                
                                echo
                                '<th class = "staticData smallFont">'.$row['Pre Filter Mass'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (405)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (465)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (525)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (639)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (870)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (940)'].'</th>
                                <th class = "staticData smallFont">'.$row['I0 (1050)'].'</th>
                            </tr>';
                        }
                    }
                    echo '
                    </table>
                    <form action = "PrintGASLogsheets.php" method = "POST">
                        <input type = "hidden" name = "minCID" value="'.$minCID.'">
                        <input type = "hidden" name = "minFID" value="'.$minFID.'">
                        <input type = "hidden" name = "num" value="'.(sizeof($sites)*2).'">
                        <input type = "hidden" name = "type" value="'.$type.'">
                        <button class = "btn-ansto centeredItem" type = "submit" value = "Generate Logsheets" style = "margin-bottom:10px; font-size:20px;">Generate Logsheets</button>
                    </form>';
                    
                    
                }  else {
                    echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px; width:500px;">';
                    echo "<p class = 'H190Width' style = 'font-size:20px;'>Not enough new filters available for allocation</p>";
                    echo '<input type = "button" class = "btn-ansto font-16 centeredItem" style = "margin-bottom:10px;"" onclick = "GoBack();" value = "Back">';
                }

            } else {
                echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px; width:500px;">';
                echo "<p class = 'H190Width'>You did not select any sites</p>";
                echo '<input type = "button" class = "btn-ansto font-16 centeredItem" style = "margin-bottom:10px;"" onclick = "GoBack();" value = "Back">';
            }
            echo '</div>';
        ?>

    </body>

</html>

<script type="text/javascript">
    function GoBack () {
        window.location.href = "GenerateLogsheets.php";
    }
</script>

<?php
mysqli_close($connection)
?>