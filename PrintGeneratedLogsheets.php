<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Generated Logsheet</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar"); 
            });

            function PrintAllLogsheets (divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                document.body.style.margin = "0px";

                window.print();

                document.body.style.margin = "8px";
                document.body.innerHTML = originalContents;
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
                    <a href="login.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <div class = "content">
            <h2>List of generated logsheets:</h2>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12450-1 ASP01 14-03-18Y/18-03-18R Lucas Heights</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12452-3 ASP01 14-03-18Y/18-03-18R Warrawong</a></div>
            <div class = "generatedSheet"><a href="SingleLogsheet.php">12454-5 ASP01 14-03-18Y/18-03-18R Mascot</a></div>
            
            <div class = "bottomStrip"><button class = "printAllButton" onclick = "PrintAllLogsheets('testDiv');">Print All</button></div>

            <div id = "testDiv" style = "display:none;">
                <img class = "printA4" src="Images/LogsheetTemplate.jpg">
                <img class = "printA4" src="Images/LogsheetTemplate.jpg">
                <img class = "printA4" src="Images/LogsheetTemplate.jpg">
            </div>
            
        </div>  

        

    </body>
</html>