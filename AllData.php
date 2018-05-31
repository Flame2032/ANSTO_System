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

                <div class = "rightDiv">
                    <a href="login.php" style = "font-family:helvetica;">Logout</a>
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
					<input type="checkbox" name="filter[]" value ="FilterID"/> Filter ID<br>
                    <input type = 'checkbox' name="filter[]" value ="Code"/>Code<br>
					<input type = 'checkbox' name="filter[]" value ="ExposureDate"/>Exposure Date<br>
					<input type = 'checkbox' name="filter[]" value ="Type"/>Type<br>
                    <input type = 'checkbox' name="filter[]" value ="PreMass"/>Pre Mass<br>
                    <input type = 'checkbox' name="filter[]" value ="PreLaser"/>Pre Laser<br>
                    <input type = 'checkbox' name="filter[]" value ="VacuumValveClosed"/>Vacuum Valve Closed<br>
                    <input type = 'checkbox' name="filter[]" value ="PreVacuum"/>Pre Vacuum<br>
                    <input type = 'checkbox' name="filter[]" value ="PreMassVolume"/>Pre-Mass Volume<br>
                    <input type = 'checkbox' name="filter[]" value ="PostMass"/>Post Mass<br>
                    <input type = 'checkbox' name="filter[]" value ="PostLaser"/>Post Laser<br>
                    <input type = 'checkbox' name="filter[]" value ="PostVacuum"/>Post Vacuum<br>
                    <input type = 'checkbox' name="filter[]" value ="PostMassVolume"/>Post Mass Volume<br>
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
                <div class = 'row'>
                    <input type = 'checkbox' class = 'searchByCheckbox' name = 'column'><p class = 'searchBarText'>By Site:</p>
                </div>
                <div class = 'container-white' style = 'margin-bottom:8px;'>
                    <input type = 'checkbox' name = 'column'>Lucas Heights<br>
                    <input type = 'checkbox' name = 'column'>Warrawong<br>
                    <input type = 'checkbox' name = 'column'>Mayfield<br>
                    <input type = 'checkbox' name = 'column'>Richmond<br>
                    <input type = 'checkbox' name = 'column'>Mascot<br>
                    <input type = 'checkbox' name = 'column'>Cape Grim<br>
                    <input type = 'checkbox' name = 'column'>Liverpool<br>
                </div>
                <div class = 'filterSeparator'></div>
                <input type = 'hidden' name = 'testInput' value = "YOMAMA">
                <input type="submit" class = "btn-ansto" value = "ApplyFilterOptions" method ="POST" style = "width:100%;">
				 
                
            </form>
			
        </div>

        <?php
            //Check if the field has been posted (basically check if the page has been refreshed after clicking the button)
            if(isset($_POST["testInput"])) {
                //Dispay the value of the posted field
                echo $_POST["testInput"];

            }

            // Checks which of the filter checkboxes in the 'column' section have been checked
            if (isset($_POST['filter'])) {
                $columnFilter = $_POST['filter'];
                // Display each ticked option
                for ($i=0; $i < sizeof($columnFilter); $i++) { 
                    echo "<br>".$columnFilter[$i];
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
        </script>
        
    </body>

</html>