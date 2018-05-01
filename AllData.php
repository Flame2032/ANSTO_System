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
                    <i id = "chevDown" class="fa fa-chevron-down" aria-hidden="true" style = "font-size:20px; text-align:center; vertical-align:middle; color:white"></i>
                    <i id = "chevUp" class="fa fa-chevron-up" aria-hidden="true" style = "display:none; font-size:20px; text-align:center; vertical-align:middle; color:white"></i>
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
            <form>
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
                    <input type = 'checkbox' name = 'column'>Filter ID<br>
                    <input type = 'checkbox' name = 'column'>ASP Code<br>
                    <input type = 'checkbox' name = 'column'>Pre Mass<br>
                    <input type = 'checkbox' name = 'column'>Pre Laser<br>
                    <input type = 'checkbox' name = 'column'>Vacuum Valve Closed<br>
                    <input type = 'checkbox' name = 'column'>Pre Vacuum<br>
                    <input type = 'checkbox' name = 'column'>Pre-Mass Volume<br>
                    <input type = 'checkbox' name = 'column'>Post Mass<br>
                    <input type = 'checkbox' name = 'column'>Post Laser<br>
                    <input type = 'checkbox' name = 'column'>Post Vacuum<br>
                    <input type = 'checkbox' name = 'column'>Post Mass Volume<br>
                    <input type = 'checkbox' name = 'column'>Finish Flow Rate<br>
                    <input type = 'checkbox' name = 'column'>Elapsed Time<br>
                    <input type = 'checkbox' name = 'column'>Temperature Max<br>
                    <input type = 'checkbox' name = 'column'>Temperature Min<br>
                    <input type = 'checkbox' name = 'column'>Comments<br>
                    <input type = 'checkbox' name = 'column'>Pre QA Date<br>
                    <input type = 'checkbox' name = 'column'>Sent Date<br>
                    <input type = 'checkbox' name = 'column'>Return Date<br>
                    <input type = 'checkbox' name = 'column'>Return QA Date<br>
                    <input type = 'checkbox' name = 'column'>Site<br>
                    <input type = 'checkbox' name = 'column'>Exposure Date<br>
                    <input type = 'checkbox' name = 'column'>Filter Type<br>
                    <input type = 'checkbox' name = 'column'>Pre-MABI<br>
                    <input type = 'checkbox' name = 'column'>Post-MABI<br>
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
                
            </form>
        </div>

        <table class = "whiteStrip">
            <tr>
                <th class = "columnTitle">ID</th>
                <th class = "columnTitle">Code</th>
                <th class = "columnTitle">Pre Mass</th>
                <th class = "columnTitle">Pre Laser</th>
                <th class = "columnTitle">Vacuum Valve Closed</th>
                <th class = "columnTitle">Pre Vacuum</th>
                <th class = "columnTitle">Pre Mass Volume</th>
                <th class = "columnTitle">Post Mass</th>
                <th class = "columnTitle">Post Laser</th>
                <th class = "columnTitle">Post Vacuum</th>
                <th class = "columnTitle">Post Mass Volume</th>
                <th class = "columnTitle">Finish Flow Rate</th>
                <th class = "columnTitle">Elapsed Time</th>
                <th class = "columnTitle">Temperature Max</th>
                <th class = "columnTitle">Temperature Min</th>
                <th class = "columnTitle">Comments</th>
                <th class = "columnTitle">Pre QA Date</th>
                <th class = "columnTitle">Sent Date</th>
                <th class = "columnTitle">Return Date</th>
                <th class = "columnTitle">Returned QA Date</th>
                <th class = "columnTitle">Site</th>
                <th class = "columnTitle">Exposure Date</th>
                <th class = "columnTitle">Filter Type</th>
                <th class = "columnTitle">l<sub>0</sub>(405)</th>
                <th class = "columnTitle">l<sub>0</sub>(465)</th>
                <th class = "columnTitle">l<sub>0</sub>(525)</th>
                <th class = "columnTitle">l<sub>0</sub>(639)</th>
                <th class = "columnTitle">l<sub>0</sub>(870)</th>
                <th class = "columnTitle">l<sub>0</sub>(940)</th>
                <th class = "columnTitle">l<sub>0</sub>(1050)</th>
                <th class = "columnTitle">l(405)</th>
                <th class = "columnTitle">l(465)</th>
                <th class = "columnTitle">l(525)</th>
                <th class = "columnTitle">l(639)</th>
                <th class = "columnTitle">l(870)</th>
                <th class = "columnTitle">l(940)</th>
                <th class = "columnTitle">l(1050)</th>
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
                <th class = "staticData">Data</th>
                <th class = "staticData">Data</th>
                <th class = "staticData">Data</th>
                <th class = "staticData">Data</th>
                <th class = "staticData">Data</th>
            </tr>
        </table>

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