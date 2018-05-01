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
              $("#navBar").load("NavigationBar.html"); 
            });

            function GoAddSite () {
                window.location.href = "AddSite.html";
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
                    <a href="login.html" style = "font-family:helvetica;">Logout</a>
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
        
        <div id = "Form" class = "container-ansto dynamic-content-700-570" style = "width:700px; display:none;">
            <!--Title-->
            <div class = "row">
                <p class = "H190Width">Generate Logsheets</p>
            </div>
            <form action = "PrintGeneratedLogsheets.html">
                <!--Site selection-->
                <div id = "ASP" class = "width-90 container-white noDisplay">
                    <div class = "fill-half-width"><input type = "checkbox">Lucas Heights (ASP01)</div>
                    <div class = "fill-half-width"><input type = "checkbox">Warrawrong (ASP08)</div>
                    <div class = "fill-half-width"><input type = "checkbox">ASP 3</div>
                    <div class = "fill-half-width"><input type = "checkbox">ASP 4</div>
                    <div class = "fill-half-width"><input type = "checkbox">ASP 5</div>
                </div>

                <div id = "GAS" class = "width-90 container-white noDisplay">
                    <div class = "fill-half-width"><input type = "checkbox">Lucas Heights (GAS)</div>
                    <div class = "fill-half-width"><input type = "checkbox">Warrawrong (GAS)</div>
                    <div class = "fill-half-width"><input type = "checkbox">GAS 3</div>
                    <div class = "fill-half-width"><input type = "checkbox">GAS 4</div>
                    <div class = "fill-half-width"><input type = "checkbox">GAS 5</div>
                </div>

                <!--Day-Pair Selection-->

                <?php
                    echo "hey uncle donald!";
                ?>

                <div class = "centeredContent">
                    <i class="fa fa-angle-double-left awesome-icon" aria-hidden="true"></i> 
                    <div class = "day-container" style = "border-color: yellow; margin-left:20px;">
                        <p class = "vertically-aligned no-outer-spaces">Wednesday <br> 18-02-2018</p>
                    </div>
                    <div class = "day-container" style = "border-color: red; margin-right:20px;">  
                        <p class = "vertically-aligned no-outer-spaces">Sunday <br> 18-02-2018</p>
                    </div>
                    <i class="fa fa-angle-double-right awesome-icon" aria-hidden="true"></i> 
                </div>
                <!--Table-->
                <div class = "width-90">
                    <table class = "centeredItem" style = "margin: 10px 0px;">
                        <tr>
                            <th class = "staticData columnTitle smallFont">ID</th>
                            <th class = "staticData columnTitle smallFont">Exposure Code</th>
                            <th class = "staticData columnTitle smallFont">Pre-Mass</th>
                            <th class = "staticData columnTitle smallFont">405nm</th>
                            <th class = "staticData columnTitle smallFont">455nm</th>
                            <th class = "staticData columnTitle smallFont">525nm</th>
                            <th class = "staticData columnTitle smallFont">639nm</th>
                            <th class = "staticData columnTitle smallFont">870nm</th>
                            <th class = "staticData columnTitle smallFont">940nm</th>
                            <th class = "staticData columnTitle smallFont">1050nm</th>
                        </tr>
                        <tr>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                        </tr>
                        <tr>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                        </tr>
                        <tr>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                        </tr>
                        <tr>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                        </tr>
                        <tr>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                        </tr>
                        <tr>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                        </tr>
                        <tr>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                            <th class = "staticData smallFont">Data</th>
                        </tr>
                    </table>
                </div>

                <!--Buttons-->

                <div clas = "row">
                    <input type = "button" class = "btn-ansto font-16" style = "margin-left:10px;margin-bottom:10px;" onclick = "GoAddSite();" value = "Add Site">
                    <input class = "btn-ansto font-16 floatRight" type = "submit" value = "Generate" style = "margin-right:10px;margin-bottom:10px;">
                </div>
            </form>
        </div>
        

        <script type="text/javascript">
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
        </script>
    </body>
</html>