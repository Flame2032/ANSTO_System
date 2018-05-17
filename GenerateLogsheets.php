<?php
    require_once("db_connect.php");

    $ASPquery = 'SELECT * FROM sites WHERE type = "ASP"';
    $ASPResult = mysqli_query($connection, $ASPquery);
    $GASquery = 'SELECT * FROM sites WHERE type = "GAS"';
    $GASResult = mysqli_query($connection, $GASquery);

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

        <!--ASP/GAS Button options-->
        <div class = "centered-ASP-GAS" id = "typeSelect">
            <input class = "btn-ASP-GAS" type = "button" onclick = "GoASP();" value = "ASP">
            <input class = "btn-ASP-GAS"type = "button" onclick = "GoGAS();" value = "GAS">
        </div>
        
        <div id = "Form" class = "container-ansto dynamic-content-700-570" style = "width:700px;">
            <!--Title-->
            <div class = "row">
                <p class = "H190Width">Generate Logsheets</p>
            </div>
            <form action = "GenLogResults.php" method = "POST">
                <!--Site selection-->
                <?php
                    if($ASPResult){

                        echo '<div id = "ASP" class = "width-90 container-white" style = "display:none;">';
                        

                        while ($row = mysqli_fetch_array($ASPResult)) {
                            //Get Site Code
                            if($row['SiteID'] < 10) {
                                $siteCode = " (".$row['type']."0".$row['SiteID'].")";
                            } else {
                                $siteCode = " (".$row['type'].$row['SiteID'].")";
                            }
                            //Display all sites as selectable checkbox options
                            echo '<div class = "fill-half-width"><input type = "checkbox" name = "site[]" value = "'.$row['type'].$row['SiteID'].'">'.$row['siteName'].$siteCode.'</div>';
                        }

                        echo "</div>";
                    }

                    if($GASResult){

                        echo '<div id = "GAS" class = "width-90 container-white" style = "display:none;">';

                        while ($row = mysqli_fetch_array($GASResult)) {
                            //Get Site Code
                            if($row['SiteID'] < 10) {
                                $siteCode = " (".$row['type']."0".$row['SiteID'].")";
                            } else {
                                $siteCode = " (".$row['type'].$row['SiteID'].")";
                            }
                            //Display all sites as selectable checkbox options
                            echo '<div class = "fill-half-width"><input type = "checkbox" name = "site[]" value = "'.$row['type'].$row['SiteID'].'">'.$row['siteName'].$siteCode.'</div>';
                        }


                        echo "</div>";
                    }
                ?>
                

                <!--Day-Pair Selection-->
                <div class = "centeredContent">
                    <i class="fa fa-angle-double-left awesome-icon" aria-hidden="true" onclick = "PrevWeek();"></i> 
                    <div class = "day-container" style = "border-color: yellow; margin-left:20px;">
                        <div class = "vertically-aligned">
                            <p class = "no-outer-spaces">Wednesday</p>
                            <input type = "text" id = "wedDate" name = "wedDate" value = "" style = "font-family: Arial; font-size: 14px; border-style:none; width:100%; text-align:center;" readonly>
                        </div>
                        
                    </div>
                    <div class = "day-container" style = "border-color: red; margin-right:20px;">
                        <div class = "vertically-aligned">
                            <p class = "no-outer-spaces">Sunday</p>
                            <input type = "text" id = "sunDate" name = "sunDate" value = "" style = "font-family: Arial; font-size: 14px; border-style:none; width:100%; text-align:center;" readonly>
                        </div>  
                    </div>
                    <i class="fa fa-angle-double-right awesome-icon" aria-hidden="true" onclick = "NextWeek();"></i> 
                </div>

                <!--Buttons-->
                <div clas = "row">
                    <input type = "button" class = "btn-ansto font-16" style = "margin-left:10px;margin-bottom:10px;" onclick = "GoAddSite();" value = "Edit Sites">
                    <input type = "Submit" class = "btn-ansto font-16 floatRight" style = "margin-right:10px;margin-bottom:10px;" value = "View Results">
                </div>
            </form>
        </div>
        

        <script type="text/javascript">
            // Display ASP/GAS Options 
            if(window.location.href == "http://localhost/ANSTO_System/GenerateLogsheets.php"){
                document.getElementById("typeSelect").style.display = "";
                document.getElementById("Form").style.display = "none";
            } else {
                document.getElementById("typeSelect").style.display = "none";
                document.getElementById("Form").style.display = "table";
            }
            // Display either ASP or GAS options depending on which button is pressed
            function GoASP () {
                document.getElementById("typeSelect").style.display = "none";
                document.getElementById("Form").style.display = "table";
                document.getElementById("ASP").style.display = "table";
            }

            function GoGAS () {
                document.getElementById("typeSelect").style.display = "none";
                document.getElementById("Form").style.display = "table";
                document.getElementById("GAS").style.display = "table";
            }

            var wedDD, wedMM, wedY, wednesdayDate;
            var sunDD, sunMM, sunY, sundayDate;

            // Get the dates for Wednesday and Sunday this week
            var today = new Date();
            var todayDay = today.getDay();

            var wednesday = new Date();
            var sunday = new Date();

            var wedDiff =  3 - todayDay;
            var sunDiff =  7 - todayDay;

            wednesday.setDate(today.getDate() + wedDiff);
            sunday.setDate(today.getDate() + sunDiff);

            // Format the dates to look nice a dilectable
            function FormatDates(){
                wedDD = wednesday.getDate();
                wedMM = wednesday.getMonth() + 1;
                wedY = wednesday.getFullYear();
                wednesdayDate = wedDD + "-" + wedMM + "-" + wedY;

                sunDD = sunday.getDate();
                sunMM = sunday.getMonth() + 1;
                sunY = sunday.getFullYear();
                sundayDate = sunDD + "-" + sunMM + "-" + sunY;
            }
            // Update date on screen
            function UpdateDate() {
                document.getElementById("wedDate").value = wednesdayDate;
                document.getElementById("sunDate").value = sundayDate;
            }

            FormatDates();
            UpdateDate();

            function NextWeek(){
                wednesday.setDate(wednesday.getDate() + 7);
                sunday.setDate(sunday.getDate() + 7);
                FormatDates();
                UpdateDate();
            }

            function PrevWeek(){
                wednesday.setDate(wednesday.getDate() - 7);
                sunday.setDate(sunday.getDate() - 7);
                FormatDates();
                UpdateDate();
            }
        </script>
    </body>
</html>

<?php
    mysqli_close($connection)
?>