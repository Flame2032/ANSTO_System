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

    $query = "SELECT * FROM gasc UNION SELECT * FROM gasf";
    $results = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Viewing: Existing Logsheets</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });

            function DisplayLogsheet (id) {
                window.location.href = "SingleLogsheet.php?id="+id;
            }

        </script>   
    
        <style>
            

        </style>

    </head>

    <body>
        <!--Navigation Bar-->
        <div id="navBar"></div>
        <!--Second Bar-->
        <div class = "secondBarContainer">
            <div class = "secondBar">
                <button type = "button" onclick = "location.href='ExistingASPLogsheets.php'" class = "btn-filter-menu">
                    <p class = 'whiteText' style = "width:50px;">ASP</p>
                </button>
                <button type = "button" class = "btn-filter-menu"  
                style = "background-color: #162bb3;">
                    <p style = "width:50px; color: #04dcf0;">GAS</p>
                </button>
                <div class = "rightDiv">
                    <a href="logoff.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <div class = "content">
            <p class = "headingText">List of all GAS logsheets:</p>
            <?php 

            if ($results) {
                $i = 1;
                while ($row = mysqli_fetch_array($results)) {
                    // Get date in AUS format
                    $date = $row['Exposure Day'].'-'.$row['Exposure Month'].'-'.$row['Exposure Year'];
                    if ($i%2 == 1) {
                        $id = $row['gasCID'];
                        echo '<div class = "generatedSheet logsheetLink" onclick = "DisplayLogsheet('; echo "'$id'"; echo ');">[';
                        echo $row['Site'].' | ';
                        echo $date.' C] + [';
                    }
                    if ($i%2 == 0) {
                        echo $row['Site'].' | ';
                        echo $date;
                        echo ' C]';
                    }
                    $date = $row['Exposure Day'].'-'.$row['Exposure Month'].'-'.$row['Exposure Year'];
                    if ($i%2 == 1) {
                        $id = $row['gasFID'];
                        echo $row['Site'].' | ';
                        echo $date.' F] + [';
                    }
                    if ($i%2 == 0) {
                        echo ' + ['.$row['Site'].' | ';
                        echo $date;
                        echo ' F]</div>';
                    }
                    $i++;
                }
            }

            ?>
        </div>

    </body>
</html>

<?php mysqli_close($connection) ?>