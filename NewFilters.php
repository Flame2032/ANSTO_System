<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Prepare New Filters</title>
        <style>

            input[type="number"] {
                margin-top: 25px;
                width: 100px;
                margin-left: 250px;
                font-size: 16px;
                text-align: center;
            }

        </style>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });

            function validateForm () {
                var x = document.forms["numForm"]["number"].value;
                if (x < 1) {
                    alert("You must input a minimum of 1");
                    return false;
                }
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

        <!--ASP/GAS Button options-->
        <div class = "centered-ASP-GAS" id = "typeSelect" style = "width:800px;">
            <div class = "centeredItem">
                <input class = "btn-ASP-GAS" type = "button" onclick = "SetASP();" value = "ASP">
                <input class = "btn-ASP-GAS"type = "button" style = "margin:0px 10px;" onclick = "SetGASC();" value = "GAS-C">
                <input class = "btn-ASP-GAS"type = "button" onclick = "SetGASF();" value = "GAS-F">
            </div>
        </div>
        
        <div class = "container-ansto dynamic-content-600-200 marginT-20" style = "width:600px; height:200px; display:none;" id = "numPickContainer">
            <form action = "NewFiltersP2.php" name = "numForm" onsubmit = "return validateForm()" method="POST">
                <h1 class = "H290Width">How many pre-analysis filters do you wish to generate?</h1>
                <input type="number" name = "number" value = "0"></input>
                <div class = "bottomStripAbs">
                    <input type = "submit" class = "btn-ansto font-16 floatRight" style = "margin: 10px;"value = "Confirm"></input>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            var numPicker = document.getElementById('numPickContainer');
            var typeSelect = document.getElementById('typeSelect');
            var selectedType;
            function SetASP () {
                typeSelect.style.display = "none";
                numPicker.style.display = "";
                selectedType = "ASP";
            }
            function SetGASC () {
                typeSelect.style.display = "none";
                numPicker.style.display = "";
                selectedType = "GAS-C";
            }
            function SetGASF () {
                typeSelect.style.display = "none";
                numPicker.style.display = "";
                selectedType = "GAS-F";
            }
        </script>
    </body>
</html>