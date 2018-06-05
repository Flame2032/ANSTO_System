<?php
    require_once("db_connect.php");
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

                <button type = "button" onclick = "ViewASPData();" class = "btn-filter-menu" 
                style = "margin-left:15px; background-color: #162bb3;">
                    <p style = "width:50px; color: #04dcf0;">ASP</p>
                </button>
                <button type = "button" onclick = "ViewGASCData();" class = "btn-filter-menu">
                    <p class = 'whiteText' style = "width:50px;">GAS-C</p>
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
            <form action = "AllASPData.php" method = 'POST'>
                <!--Filter by Searchbox section-->
                <div class = 'row'>
                    <input type = 'checkbox' class = 'searchByCheckbox' name = 'column'><p class = 'searchBarText'>Filter by Search:</p>
                </div>
                <select name = 'filterBy' class = 'width-100' style = 'display:block; margin-bottom:6px;'>
                    <option>Filter ID</option>
                    <option>Post-Mass</option>
                </select>
                <input type = 'textbox' class = 'width-100 centeredItem' style = 'padding:3px;box-sizing: border-box;' placeholder = 'Search'>
                <div class = 'filterSeparator'></div>
                <!--By Columns-->
                <div class = 'row'>
                    <input type = 'checkbox' class = 'searchByCheckbox' name = 'column'><p class = 'searchBarText'>By Columns:</p>
                </div>
                <div class = 'container-white'>
					<input type="checkbox" name="filter[]" value ="`aspID`"/>aspID<br>
                    <input type = 'checkbox' name="filter[]" value ="`Site`"/>Site<br>
					<input type = 'checkbox' name="filter[]" value ="`Exposure Date`"/>Exposure Date<br>
					<input type = 'checkbox' name="filter[]" value ="`Type`"/>Type<br>
                    <input type = 'checkbox' name="filter[]" value ="`Pre Filter Mass`"/>Pre Filter Mass<br>
                    <input type = 'checkbox' name="filter[]" value ="`Pre Laser`"/>Pre Laser<br>
                    <input type = 'checkbox' name="filter[]" value ="`Date`"/>Date<br>
                    <input type = 'checkbox' name="filter[]" value ="`Time`"/>Time<br>
                    <input type = 'checkbox' name="filter[]" value ="`Initials`"/>Initials<br>
					<input type = 'checkbox' name="filter[]" value ="`Vacuum Pinch Tube`"/>Vacuum Pinch Tube<br>
					<input type = 'checkbox' name="filter[]" value ="`Magnehelic`"/>Magnehelic<br>
					<input type = 'checkbox' name="filter[]" value ="`Post Laser`"/>Post Laser<br>
                    <input type = 'checkbox' name="filter[]" value ="`Vacuum`"/>Vacuum<br>
                    <input type = 'checkbox' name="filter[]" value ="`Post Filter Mass`"/>Post Filter Mass<br>
					<input type = 'checkbox' name="filter[]" value ="`TemperatureMax`"/>Temperature Max<br>
                    <input type = 'checkbox' name="filter[]" value ="`TemperatureMin`"/>Temperature Min<br>
                    <input type = 'checkbox' name="filter[]" value ="`Comments`"/>Comments<br>
					<input type = 'checkbox' name="filter[]" value ="`Date2`"/>Date2<br>
                    <input type = 'checkbox' name="filter[]" value ="`Time2`"/>Time2<br>
                    <input type = 'checkbox' name="filter[]" value ="`Initials3`"/>Initials3<br>
					<input type = 'checkbox' name="filter[]" value ="`Vacuum4`"/>Vacuum4<br>
                    <input type = 'checkbox' name="filter[]" value ="`ReturnDate`"/>Return Date<br>
				    <input type = 'checkbox' name="filter[]" value ="`Magnehelic5`"/>Magnehelic5<br>
                    <input type = 'checkbox' name="filter[]" value ="`Elapsed Time`"/>Elapsed Time<br>
                    <input type = 'checkbox' name="filter[]" value ="`PostDate`"/>PostDate<br>
                    <input type = 'checkbox' name="filter[]" value ="`QA`"/>QA<br>
                    <input type = 'checkbox' name="filter[]" value ="`QR barcode Information`"/>QR barcode Information<br>
					<input type = 'checkbox' name="filter[]" value ="`Exposure Day`"/>Exposure Day<br>
                    <input type = 'checkbox' name="filter[]" value ="`Exposure Month`"/>Exposure Month<br>
					<input type = 'checkbox' name="filter[]" value ="`Exposure Year`"/>Exposure Year<br>
                    <input type = 'checkbox' name="filter[]" value ="`SamplingDay`"/>SamplingDay<br>
					<input type = 'checkbox' name="filter[]" value ="`I0 (405`"/>I0 (405 <br>
					<input type = 'checkbox' name="filter[]" value ="`I0 (465)`"/>I0 (465)<br>
                    <input type = 'checkbox' name="filter[]" value ="`I0 (525)`"/>I0 (525)<br>
                    <input type = 'checkbox' name="filter[]" value ="`I0 (639)`"/>I0 (639)<br>
					<input type = 'checkbox' name="filter[]" value ="`I0 (870)`"/>I0 (870)<br>
                    <input type = 'checkbox' name="filter[]" value ="`I0 (940)`"/>I0 (940)<br>
					<input type = 'checkbox' name="filter[]" value ="`I0 (1050)`"/>I0 (1050)<br>
                    <input type = 'checkbox' name="filter[]" value ="`I (405)`"/>I (405)<br>
					<input type = 'checkbox' name="filter[]" value ="`I (465)`"/>I (465)<br>
                    <input type = 'checkbox' name="filter[]" value ="`I (525)`"/>I (525)<br>
					<input type = 'checkbox' name="filter[]" value ="`I (639)`"/>I (639)<br>
                    <input type = 'checkbox' name="filter[]" value ="`I (870)`"/>I (870)<br>
					<input type = 'checkbox' name="filter[]" value ="`I (940)`"/>I (940)<br>
					<input type = 'checkbox' name="filter[]" value ="`I (1050)`"/>I (1050)<br>
					
                </div>
                <div class = 'filterSeparator'></div>
                <!--By Site-->
                <?php
                    $siteQuery = 'SELECT * FROM sites WHERE `type` = "ASP"';
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
                <input type="submit" class = "btn-ansto" name="search" value = "ApplyFilterOptions" method ="POST" style = "width:100%;">
				 
                
            </form>
			
        </div>

 <?php
if(isset($_POST['filter'])) {
 $chkbox = $_POST['filter'];
 $i = 0;
$sql_where = implode (" , ", $chkbox);
 While($i < sizeof($sql_where))
 {
 $i++;


 
 }
 $sql = "SELECT $sql_where FROM asp WHERE `Exposure Date` >= now()-interval 3 month ";
$result = mysqli_query($connection,$sql) or die(mysql_error());
 echo"$sql";

if (mysqli_num_rows($result) == 0)
    {
        echo "Sorry, but we can not find an entry to match your query...<br><br>";
		 }
		     else
    {
       $all_property = array();  //declare an array for saving property
//showing property
echo '<table class="data-table" border="2" width="auto" overflow: "auto" ID="Table1" style="font-size: 70%;">
        <tr class="data-heading">';  //initialize table tag
		while ($property = mysqli_fetch_field($result)) {
    echo '<td>' . $property->name . '</td>';  //get field name for header
    array_push($all_property, $property->name);  //save those to array
}
	}
	echo '</tr>'; //end tr tag
//showing all data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($all_property as $item) {
        echo '<td>' . $row[$item] . '<div style= "width:180px;"</div></td>'; //get items using property value
    }
    echo '</tr>';
	
}
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
        </script>
        
    </body>

</html>