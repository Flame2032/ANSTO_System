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

                for ($i=0; $i < sizeof($sites); $i++) {
                    $site = $sites[$i];
                    $filtersQuery[$i] = mysqli_query($connection, "SELECT * FROM asp WHERE 
                        `PostDate` = '' AND 
                        `Site` = '$site' AND 
                        (`Exposure Date` = '$USAWedDate' OR `Exposure Date` = '$USAWedDate'");
                    if($filtersQuery[$i]){
                        echo "YAY";
                    }
                }

                if($filtersQuery[0]){
                    echo '
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
                    </div>';
                } else {
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