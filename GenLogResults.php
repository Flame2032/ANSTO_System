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
            $wedSND[$i+1] = "ASP65 27-09-17";       // TESTING CODE HERE
            $sunSND[$i] = $sites[$i]." ".$sunDate;
            $sunSND[$i+1] = "ASP65 01-10-17";       // TESTING CODE HERE
        }

        $filtersQuery = "SELECT * FROM asp WHERE QA = '' AND (`Site & Date` IN ('" . implode("','", $wedSND) . "') OR `Site & Date` IN ('" . implode("','", $sunSND) . "')) ";
        $filtersResult = mysqli_query($connection, $filtersQuery);
    }

    // Construct the query
    

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

            if (isset($_POST['site']) && $filtersResult) {
                echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px;">';
            } else {
                echo '<div class = "container-ansto dynamic-content-700-570" style = "margin:10px 0px; width:300px;">';
            }

        ?>

        
            <!--Table-->
            <?php 

                if (isset($_POST['site']) && $filtersResult) {
                    echo '<div class = "centeredItem">
            
                
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

                    // Display each filter for the database that does not have a Pre-QA date
                    

                    while ($row = mysqli_fetch_array($filtersResult)) {

                        echo '<tr>
                            <th class = "staticData smallFont">'.$row['aspID'].'</th>
                            <th class = "staticData smallFont">'.$row['Code'].'</th>
                            <th class = "staticData smallFont">'.$row['Pre Filter Mass'].'</th>
                            <th class = "staticData smallFont">'.$row['I0 (405)'].'</th>
                            <th class = "staticData smallFont">'.$row['I0 (465)'].'</th>
                            <th class = "staticData smallFont">'.$row['I0 (525)'].'</th>
                            <th class = "staticData smallFont">'.$row['I0 (639)'].'</th>
                            <th class = "staticData smallFont">'.$row['I0 (870)'].'</th>
                            <th class = "staticData smallFont">'.$row['I0 (940)'].'</th>
                            <th class = "staticData smallFont">'.$row['I0 (1050)'].'</th>
                        </tr>';
                    }
                    echo "</table>";
                } else {
                    echo "<p class = 'H190Width'>No Results</p>";
                } 
            ?>
            <!--Buttons-->
            <div clas = "strip">
                <?php if(isset($_POST['site']) && $filtersResult) {
                    echo 
                    '<input type = "button" class = "btn-ansto font-16" style = "margin-left:10px;margin-bottom:10px;" onclick = "GoBack();" value = "Back">
                    <input class = "btn-ansto font-16 floatRight" type = "button" value = "Generate" style = "margin-right:10px;margin-bottom:10px;" onclick = "Generate();">';
                    } else {
                        echo 
                        '<input type = "button" class = "btn-ansto font-16 centeredItem" style = "margin-bottom:10px;"" onclick = "GoBack();" value = "Back">';
                    }

                ?>
            </div>
        </div>

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