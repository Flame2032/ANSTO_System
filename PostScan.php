<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Scanning: Returned Filters</title>
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
                <div class = "rightDiv">
                    <a href="login.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

         <div class = "container-ansto centered-800-X marginT-20" style = " width:600px;">
            <form action = "PostAnalysis.php" name = "numForm" onsubmit = "return validateForm()" method="POST" style = "margin:20px 0px;">
                <h1 class = "H290Width">Scan Filters</h1>

                <div class = "width-90 container-white">
                    <div class = "centeredItem" style = "padding:5px;">
                        Scan Next Barcode:
                        <input type = "textbox" style = "display:inline-block; width: ;">
                    </div>
                </div>
                
                <div class = "width-90 container-white" style = "margin-top:5px;">
                    <div class = "centeredItem" style = "padding:5px;">
                        Scanned Barcodes:
                    </div>
                    <div class = "centeredItem" style = "padding:2px;">
                        ID: 12432415
                    </div>
                    <div class = "centeredItem" style = "padding:2px;">
                        ID: 42315423
                    </div>
                </div>
                
                <div class = "strip width-90">
                    <input type = "submit" class = "btn-ansto font-16 floatRight" style = "margin:10px 0px;" value = "Finish Scanning">
                </div>
            </form>
        </div>

    </body>
</html>