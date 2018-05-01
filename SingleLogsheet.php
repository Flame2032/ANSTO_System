<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Logsheet</title>
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

         <div class = "centeredContent container-ansto">
            <img class = "template" src="LogsheetTemplate.jpg">
            <form action = "SaveSuccess.html">
                <div class = "row">
                    <input type = "button" class = "btn-ansto floatRight" value = "Print" style = "margin:15px; margin-top:0px; font-size:20px;">
                </div>
            </form>
        </div>
    </body>
</html>