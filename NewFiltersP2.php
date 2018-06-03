<!DOCTYPE html>
<html lang="en">
    <head>


        <title>Prepare New Filters</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });

            function uploadCSV() {
                window.alert ("User will be able to select a CSV file from their local drive Hello!");
            }
        </script>

    </head>

    <body>
        <!--Navigation Bar-->
        <div id="navBar"></div>
        <!--Second Bar-->
        <div class = "secondBarContainer">
            <div class = "secondBar">
                <a href="NewFilters.php" style = "font-family:helvetica;">Back</a>
                <div class = "rightDiv">
                    <a href="login.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <?php
            $number = $_POST['number'];
        ?>

        <div class = "container-ansto centered-800-X marginT-20" style = "padding:20px;">
            <div class = "strip">
                <h2 class = "H290Width-left"> <?php echo ($number); ?> Pre-Analysis filter entries have been generated</h2>
                <button class = "btn-ansto font-16 floatRight" style = "padding:10px;" onclick = "uploadCSV()">Import MABI</button>
            </div>
            
            <table>
                <tr>
                    <th class = "staticData columnTitle">ID</th>
                    <th class = "staticData columnTitle">Pre Mass</th>
                    <th class = "staticData columnTitle">Pre Laser</th>
                    <th class = "staticData columnTitle">Type</th>
                    <th class = "staticData columnTitle">l<sub>0</sub>(405)</th>
                    <th class = "staticData columnTitle">l<sub>0</sub>(465)</th>
                    <th class = "staticData columnTitle">l<sub>0</sub>(525)</th>
                    <th class = "staticData columnTitle">l<sub>0</sub>(639)</th>
                    <th class = "staticData columnTitle">l<sub>0</sub>(870)</th>
                    <th class = "staticData columnTitle">l<sub>0</sub>(940)</th>
                    <th class = "staticData columnTitle">l<sub>0</sub>(1050)</th>
                </tr>

                <?php
                    $currentDate = date('d-m-Y');
                    for ($i=0; $i < $number; $i++) { 

                        echo 
                        "<tr>
                            <th class = 'staticData'>$i</th>
                            <th><input type = 'text' class = 'dbTextbox'></input></th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                        </tr>";
                    }
                ?>
            </table>
            <div class = "bottomStrip">
                <form action = "PreData.html">
                    <input class = "btn-ansto font-16 floatRight" type = "submit" value = "Save to Database" style = "height:35px; margin-top:5px;"></input>
                </form>
            </div>
        </div>  

    </body>
</html>