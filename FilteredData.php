<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Filtered Data</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar"); 
            });

            function exportCSV() {
                window.alert ("Filtered data will be exported as CSV file");
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

        <div class = "content">
          <table class = "centeredItem">
                <tr>
                    <th class = "staticData columnTitle">ID</th>
                    <th class = "staticData columnTitle">ASP Code</th>
                    <th class = "staticData columnTitle">Filter Type</th>
                    <th class = "staticData columnTitle">Sampling Day</th>
                    <th class = "staticData columnTitle">Pre Mass</th>
                    <th class = "staticData columnTitle">Pre Laser</th>
                    <th class = "staticData columnTitle">Vacuum Pinch Tube</th>
                    <th class = "staticData columnTitle">Vacuum</th>
                    <th class = "staticData columnTitle">Magnehelic</th>
                    <th class = "staticData columnTitle">Post Mass</th>
                    <th class = "staticData columnTitle">Post Laser</th>
                    <th class = "staticData columnTitle">Vacuum4</th>
                    <th class = "staticData columnTitle">Magnehelic5</th>
                    <th class = "staticData columnTitle">Elapsed Time</th>
                    <th class = "staticData columnTitle">Temperature Max</th>
                    <th class = "staticData columnTitle">Temperature Min</th>
                </tr>
                <tr>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                </tr>
                <tr>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                </tr>
                <tr>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                    <th class = "staticData">Data</th>
                </tr>
            </table>
        </div>
    </body>
</html>