<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Viewing: Pre-Analysis Data</title>
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

        <div class = "content">
            <table class = "centeredItem">
                <tr>
                    <th class = "columnTitle">ID</th>
                    <th class = "columnTitle">Type</th>
                    <th class = "columnTitle">l<sub>0</sub>(405)</th>
                    <th class = "columnTitle">l<sub>0</sub>(465)</th>
                    <th class = "columnTitle">l<sub>0</sub>(525)</th>
                    <th class = "columnTitle">l<sub>0</sub>(639)</th>
                    <th class = "columnTitle">l<sub>0</sub>(870)</th>
                    <th class = "columnTitle">l<sub>0</sub>(940)</th>
                    <th class = "columnTitle">l<sub>0</sub>(1050)</th>
                    <th class = "columnTitle">Pre Mass</th>
                    <th class = "columnTitle">Pre Laser</th>
                    <th class = "columnTitle">Date</th>
                    <th class = "columnTitle">Edit</th>
                </tr>
                <tr>
                    <th class = "staticData">X</th>
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
                    <th><input type = "button" value = "Edit" class = "dataEditButton"></th>
                </tr>
                <tr>
                    <th class = "staticData">X</th>
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
                    <th><input type = "button" value = "Edit" class = "dataEditButton"></th>
                </tr>
                <tr>
                    <th class = "staticData">X</th>
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
                    <th><input type = "button" value = "Edit" class = "dataEditButton"></th>
                </tr>
            </table>
        </div>
    </body>
</html>