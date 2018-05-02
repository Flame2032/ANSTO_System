<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Add Site</title>
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

        <div class = "container-ansto centeredItem marginT-20" style = "padding:20px;">
            <p class = "H290Width" style = "margin-top:0px;">Site List</p>
            <table>
                <tr>
                    <th class = "columnTitle">ID</th>
                    <th class = "columnTitle">Site Name</th>
                    <th class = "columnTitle">Site Code</th>
                    <th class = "columnTitle" style = "background-color:#0079c0; border-color:#0079c0"></th>
                </tr>
                <tr>
                    <th class = "staticData">1</th>
                    <th class = "staticData">Lucas Heights</th>
                    <th class = "staticData">ASP01</th>
                    <th><button class = "siteButton" onclick = "deleteSite()">Delete</button></th>
                </tr>
                <tr>
                    <th class = "staticData">2</th>
                    <th class = "staticData">Warrawong</th>
                    <th class = "staticData">ASP08</th>
                    <th><button class = "siteButton" onclick = "deleteSite()">Delete</button></th>
                </tr>
                <tr>
                    <th class = "staticData">3</th>
                    <th class = "staticData">Option 3</th>
                    <th class = "staticData">ASPXX</th>
                    <th><button class = "siteButton" onclick = "deleteSite()">Delete</button></th>
                </tr>
                <tr>
                    <th class = "staticData">4</th>
                    <th><input type = "text" class = "dbTextbox"></input></th>
                    <th><input type = "text" class = "dbTextbox"></input></th>
                    <th><button class = "siteButton" onclick = "addSite()">Add</button></th>
                </tr>
            </table>
        </div>

    </body>
</html>