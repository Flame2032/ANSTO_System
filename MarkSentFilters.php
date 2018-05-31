<?php
    require_once("db_connect.php");

    $Sitequery = 'SELECT * FROM sites';
    $SiteResult = mysqli_query($connection, $Sitequery);
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
        
        <div id = "Form" class = "container-ansto dynamic-content-700-570" style = "width:700px;">
            <!--Title-->
            <div class = "row">
                <p class = "H190Width">Mark Filters as Sent</p>
            </div>
            <form action = "MarkSentResults.php" method = "POST">
                <!--Site selection-->
                <?php
                    if($SiteResult){

                        echo '<div id = "sites" class = "width-90 container-white">';

                        while ($row = mysqli_fetch_array($SiteResult)) {
                            //Get Site Code & Display sites as selectable checkbox options
                            if($row['SiteID'] < 10) {
                                $siteCode = " (".$row['type']."0".$row['SiteID'].")";
                                echo '<div class = "fill-half-width"><input type = "checkbox" name = "site[]" value = "'.$row['type'].' 0'.$row['SiteID'].'">'.$row['siteName'].$siteCode.'</div>';
                            } else {
                                $siteCode = " (".$row['type'].$row['SiteID'].")";
                                echo '<div class = "fill-half-width"><input type = "checkbox" name = "site[]" value = "'.$row['type'].' '.$row['SiteID'].'">'.$row['siteName'].$siteCode.'</div>';
                            }
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
                            <input type = "text" id = "wedDate" name = "wedDate" value = "" style = "font-family: Arial; font-size: 14px; border-style:none; width:90%; text-align:center;" readonly>
                            <!--These values are hidden but need to be passed to the next screen-->
                            <input type = "hidden" id = "wedDay" name = "wedDay" value = "">
                            <input type = "hidden" id = "wedMonth" name = "wedMonth" value = "">
                            <input type = "hidden" id = "wedYear" name = "wedYear" value = "">
                        </div>
                    </div>
                    <div class = "day-container" style = "border-color: red; margin-right:20px;">
                        <div class = "vertically-aligned">
                            <p class = "no-outer-spaces">Sunday</p>
                            <input type = "text" id = "sunDate" name = "sunDate" value = "" style = "font-family: Arial; font-size: 14px; border-style:none; width:90%; text-align:center;" readonly>
                            <!--These values are hidden but need to be passed to the next screen-->
                            <input type = "hidden" id = "sunDay" name = "sunDay" value = "">
                            <input type = "hidden" id = "sunMonth" name = "sunMonth" value = "">
                            <input type = "hidden" id = "sunYear" name = "sunYear" value = "">
                        </div>  
                    </div>
                    <i class="fa fa-angle-double-right awesome-icon" aria-hidden="true" onclick = "NextWeek();"></i> 
                </div>

                <!--Buttons-->
                <div class = "strip" id = "markStrip">
                    <input type = "Submit" class = "btn-ansto width-90" style = " margin-bottom:20px; margin-top:20px; font-size:20px;" value = "Mark as Sent">
                </div>
            </form>
        </div>
        

        <script type="text/javascript">
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
                if(wedDD < 10){
                    wedDD = "0"+wedDD;
                }
                if(wedMM < 10){
                    wedMM = "0"+wedMM;
                }
                wednesdayDate = wedDD + "-" + wedMM + "-" + wedY;

                // Set indiviudal values
                document.getElementById('wedDay').value = wedDD;
                document.getElementById('wedMonth').value = wedMM;
                document.getElementById('wedYear').value = wedY;

                sunDD = sunday.getDate();
                sunMM = sunday.getMonth() + 1;
                sunY = sunday.getFullYear();
                if(sunDD < 10){
                    sunDD = "0"+sunDD;
                }
                if(sunMM < 10){
                    sunMM = "0"+sunMM;
                }
                sundayDate = sunDD + "-" + sunMM + "-" + sunY;

                // Set indiviudal values
                document.getElementById('sunDay').value = sunDD;
                document.getElementById('sunMonth').value = sunMM;
                document.getElementById('sunYear').value = sunY;
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

            // Display table of sites for the selected options
            markStrip = document.getElementById('markStrip');
            confirmStrip = document.getElementById('confirmStrip');
            filterTable = document.getElementById('filterTable');
        </script>
    </body>
</html>

<?php
    mysqli_close($connection)
?>