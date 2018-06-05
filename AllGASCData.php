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
?>


<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Viewing: All Data</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar"); 
            });
        </script>

    </head>

    <body>
        <!--Navigation Bar-->
        <div id="navBar"></div>
        <!--Second Bar-->
        <div class = "secondBarContainer">
            <div class = "secondBar">
                <button type = "button" onclick = "ToggleFilterMenu();" class = "btn-filter-menu">
                    <p class = 'whiteText'>Filter By Options</p>
                </button>

                <button type = "button" onclick = "ViewASPData();" class = "btn-filter-menu" style = "margin-left:15px;">
                    <p class = 'whiteText' style = "width:50px;">ASP</p>
                </button>
                <button type = "button" onclick = "ViewGASCData();" class = "btn-filter-menu" style = "background-color: #162bb3;">
                    <p class = 'whiteText' style = "width:50px; color: #04dcf0;">GAS-C</p>
                </button>
                <button type = "button" onclick = "ViewGASFData();" class = "btn-filter-menu">
                    <p class = 'whiteText' style = "width:50px;">GAS-F</p>
                </button>

                <div class = "rightDiv">
                    <a href="logoff.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>
		
        <!--Dropdown filter bar-->
        <div class = 'filterBar' id = "filterBar">
            <form action = "AllData.php" method = 'POST'>
                <!--Filter by Searchbox section-->
                <div class = 'row'>
                    <input type = 'checkbox' class = 'searchByCheckbox' name = 'column'><p class = 'searchBarText'>Filter by Search:</p>
                </div>
                <select id = "filterBy" name = 'filterBy' class = 'width-100' style = 'display:block; margin-bottom:6px;' onchange = "FilterByChanged();">
                    <option value = "FilterID">Filter ID</option>
                    <option value = "Exposure">Exposure Date</option>
                </select>
                <input id = "filterTextBox" type = 'textbox' class = 'width-100 centeredItem' style = 'padding:3px;box-sizing: border-box;' placeholder = 'Enter Filter ID'>
                <div id = "exposureDiv" style = "display:none;">
                    <div class = "strip">
                        <p class = "whiteText" style = "width:20%;">From:</p>
                        <input type = 'textbox' class = 'centeredItem' 
                        style = 'padding:3px; width: 70%; display:inline-block;' placeholder = 'dd-mm-yy'>
                    </div>
                    <div class = "strip">
                        <p class = "whiteText" style = "width:20%;">To:</p>
                        <input type = 'textbox' class = 'centeredItem' 
                        style = 'padding:3px; width: 70%; display:inline-block; margin-top:6px;' placeholder = 'dd-mm-yy'>
                    </div>
                </div>

                <div class = 'filterSeparator'></div>
                <!--By Columns-->
                <div class = 'row'>
                    <input type = 'checkbox' class = 'searchByCheckbox' name = 'column'><p class = 'searchBarText'>By Columns:</p>
                </div>
                <div class = 'container-white'>
					<input type="checkbox" name="filter[]" value ="aspID"/> aspID<br>
                    <input type = 'checkbox' name="filter[]" value ="Site"/>Site<br>
					<input type = 'checkbox' name="filter[]" value ="Exposure Date"/>Exposure Date<br>
					<input type = 'checkbox' name="filter[]" value ="Type"/>Type<br>
                    <input type = 'checkbox' name="filter[]" value ="Pre Filter Mass"/>Pre Filter Mass<br>
                    <input type = 'checkbox' name="filter[]" value ="Pre Laser"/>Pre Laser<br>
                    <input type = 'checkbox' name="filter[]" value ="Date"/>Date<br>
                    <input type = 'checkbox' name="filter[]" value ="Pre Vacuum"/>Pre Vacuum<br>
                    <input type = 'checkbox' name="filter[]" value ="Post Mass"/>Post Mass<br>
                    <input type = 'checkbox' name="filter[]" value ="Post Laser"/>Post Laser<br>
                    <input type = 'checkbox' name="filter[]" value ="Post Vacuum"/>Post Vacuum<br>
                    <input type = 'checkbox' name="filter[]" value ="Post Mass Volume"/>Post Mass Volume<br>
                    <input type = 'checkbox' name="filter[]" value ="FinishFlowRate"/>Finish Flow Rate<br>
                    <input type = 'checkbox' name="filter[]" value ="ElapsedTime"/>Elapsed Time<br>
                    <input type = 'checkbox' name="filter[]" value ="TemperatureMax"/>Temperature Max<br>
                    <input type = 'checkbox' name="filter[]" value ="TemperatureMin"/>Temperature Min<br>
                    <input type = 'checkbox' name="filter[]" value ="Comments"/>Comments<br>
                    <input type = 'checkbox' name="filter[]" value ="PreQADate"/>Pre QA Date<br>
                    <input type = 'checkbox' name="filter[]" value ="SentDate"/>Sent Date<br>
                    <input type = 'checkbox' name="filter[]" value ="ReturnDate"/>Return Date<br>
                    <input type = 'checkbox' name="filter[]" value ="ReturnQADate"/>Return QA Date<br>
                    <input type = 'checkbox' name="filter[]" value ="ExposureDate"/>Exposure Date<br>
                    <input type = 'checkbox' name="filter[]" value ="FilterType"/>Filter Type<br>
                    <input type = 'checkbox' name="filter[]" value ="PreMABI"/>Pre-MABI<br>
                    <input type = 'checkbox' name="filter[]" value ="PostMABI"/>Post-MABI<br>
					
                </div>
                <div class = 'filterSeparator'></div>
                <!--By Site-->
                <?php
                    $siteQuery = 'SELECT * FROM sites WHERE `type` = "GAS"';
                    $siteResults = mysqli_query($connection, $siteQuery);
                ?>
                <div class = 'row'>
                    <input type = 'checkbox' class = 'searchByCheckbox' name = 'column'><p class = 'searchBarText'>By Site:</p>
                </div>
                <?php
                    if($siteResults){
                        echo "<div class = 'container-white' style = 'margin-bottom:8px;'>";
                        while ($row = mysqli_fetch_array($siteResults)) {
                            // Make sure siteID is two digits
                            if($row["SiteID"] < 10){
                                $id = '0'.$row["SiteID"];
                            } else {
                                $id = $row["SiteID"];
                            }
                            echo "<input type = 'checkbox' name = 'column'>".$row["siteName"]." (".$row["type"].$id.")<br>";
                        }
                        echo "</div>
                        <div class = 'filterSeparator'></div>";
                    }
                ?>
                <input type="submit" class = "btn-ansto" value = "ApplyFilterOptions" method ="POST" style = "width:100%;">
				 
                
            </form>
			
        </div>

<?php
if(isset($_POST['filter'])) {
 $chkbox = $_POST['filter'];
 $i = 0;
$sql_where = implode (" , ", $chkbox);
 While($i < sizeof($sql_where))
 {
$result = "SELECT  $sql_where FROM asp WHERE `Exposure Date` >= now()-interval 3 month " ;
 $i++;


 
 }

 echo"$result"; 
}
 ?>

        <script type="text/javascript">
            function ToggleFilterMenu () {
                var filterBar = document.getElementById("filterBar");
                var chevUp = document.getElementById("chevUp");
                var chevDown = document.getElementById("chevDown");
                var style = window.getComputedStyle(filterBar, null).getPropertyValue("display");;
                if(style == "none"){
                    filterBar.style.display = "block";
                    chevUp.style.display = "block";
                    chevDown.style.display = "none";
                } else {
                    filterBar.style.display = "none";
                    chevUp.style.display = "none";
                    chevDown.style.display = "block";
                }
            }
            function ViewASPData () {
                window.location.href = "AllASPData.php";
            }
            function ViewGASCData () {
                window.location.href = "AllGASCData.php";
            }
            function ViewGASFData () {
                window.location.href = "AllGASFData.php";
            }
            function FilterByChanged () {
                var filterBy = document.getElementById("filterBy");
                var filterTB = document.getElementById("filterTextBox");
                var exposureDiv = document.getElementById("exposureDiv");

                if (filterBy.value == 'FilterID') {
                    filterTB.style.display = "";
                    exposureDiv.style.display = "none";
                } else if (filterBy.value == 'Exposure'){
                    filterTB.style.display = "none";
                    exposureDiv.style.display = "";
                };
            }
        </script>
        
    </body>

</html>