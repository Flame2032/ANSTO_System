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
                    <a href="login.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <?php
            // Make sure there are enough new filters in the database for allocation
            $availableFiltersQueryResult = mysqli_query($connection, "SELECT * FROM asp WHERE Code = ''");
            if ($availableFiltersQueryResult && isset($_POST['site'])) {
                $availableFilters = mysqli_num_rows($availableFiltersQueryResult);
                if($availableFilters >= (sizeof($sites)*2)) {

                    // Get the ID of the first filter with no exposure code
                    $minIDQuery = "SELECT aspID FROM asp WHERE aspID =  ( SELECT MIN(aspID) FROM asp WHERE Code = ''  )";
                    $minIDResult = mysqli_query($connection, $minIDQuery);
                    while ($row = mysqli_fetch_array($minIDResult)) {
                        $minID = $row['aspID'];
                    }
                    echo $minID;

                    // Get 2 filters for each site that has been selected (1 for wed, 1 for sun)
                    for ($i=0; $i < (sizeof($sites)*2); $i++) { 
                        $filtersQuery[$i] = "SELECT * FROM asp WHERE aspID =  ( SELECT MIN(aspID)+$i FROM asp WHERE Code = ''  )";
                        $filtersResult[$i] = mysqli_query($connection, $filtersQuery[$i]);
                    }

                    // Display
                    if (isset($_POST['site']) && $filtersResult[0]) {
                        echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px;">';
                        echo '<div class = "centeredItem">
                        <p class = "H190Width">Filters have been allocated for exposure</p>
                    
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
                                    } else {
                                        echo '<th class = "staticData smallFont">'.$sunSND[$x].' R</th>';
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
                        
                        echo "</table>";

                        echo '<input class = "btn-ansto font-16 centeredItem" type = "button" value = "Generate" style = "margin-bottom:10px;" onclick = "Generate();">';
                    }
                } else {
                    echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px; width:500px;">';
                    echo "<p class = 'H190Width' style = 'font-size:20px;'>Not enough new filters available for allocation</p>";
                    echo '<input type = "button" class = "btn-ansto font-16 centeredItem" style = "margin-bottom:10px;"" onclick = "GoBack();" value = "Back">';
                }
            } else {
                echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px; width:300px;">';
                echo "<p class = 'H190Width'>No Results</p>";
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
    function Generate () {
        window.location.href = "PrintGeneratedLogsheets.php";
    }
</script>

<?php
mysqli_close($connection)
?>