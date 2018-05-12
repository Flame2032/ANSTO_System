<?php
    require_once("db_connect.php");

    $query = 'SELECT * FROM sites';
    $result = mysqli_query($connection, $query);
?>

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

            <?php   
                if($result){

                    echo 
                    '<table style = "margin:0px 20px;">
                        <tr>
                            <td class = "columnTitle">ID</td>
                            <td class = "columnTitle">Site Name</td>
                            <td class = "columnTitle">Site Code</td>
                            <td class = "columnTitle" style = "background-color:#0079c0; border-color:#0079c0"></td>
                        </tr>'
                    ;

                    while ($row = mysqli_fetch_array($result)) {
                        if($row['SiteID'] < 10) {
                            $siteCode = $row['type']."(0".$row['SiteID'].")";
                        } else {
                            $siteCode = $row['type']."(".$row['SiteID'].")";
                        }
                        echo 
                        '<form action = "deleteSite.php" method = "post">
                            <tr>
                                <td class = "staticData">'.$row['SiteID'].'</td>
                                <td class = "staticData">'.$row['siteName'].'</td>
                                <td class = "staticData" style = "text-align: center;">'.$siteCode.'</td>
                                <td><button class = "siteButton" type = "submit">Delete</button></td>
                            </tr>
                        </form>'
                        ;
                    }

                }
            ?>
            <tr>
                <th class = "staticData">x</th>
                <th><input type = "text" class = "dbTextbox" style = "width:120px;"></input></th>
                <th><input type = "text" class = "dbTextbox" style = "width:100px;"></input></th>
                <th><button class = "siteButton" onclick = "addSite()">Add</button></th>
            </tr>
            </table>
        </div>

    </body>
</html>

<?php
    mysqli_close($connection)
?>