<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Save Successful!</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.css">
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
                    <a href="logoff.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <form class = "centeredContent" action = "ReturnedLogsheets.html">
            <div class = "centeredTextBox">
                <p>Data has successfully been saved to the database!</p>
            </div>
            <div class = "bottomStrip">
                <input type = "submit" value = "Continue" class = "centeredItem"></input>
            </div>
        </form>
    </body>
</html>