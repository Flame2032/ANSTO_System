<?php
    require_once("db_connect.php");

    $query = 'SELECT * FROM sites';
    $result = mysqli_query($connection, $query);

    // This code is executed if the user deletes a site
    if(isset($_GET['deleteID'])){
        $id = $_GET['deleteID'];
        $deleteQuery = "DELETE FROM sites WHERE SiteID = $id";
        mysqli_query($connection, $deleteQuery);
        header("Refresh:0; url=AddSite.php");
    }

    // This code is executed if the user adds a site
    if(isset($_GET['addName'])){
        $name = $_GET['addName'];
        $type = $_GET['addType'];
        $addQuery = "INSERT INTO sites VALUES ('1', '".$name."' ,'".$type."')";
        mysqli_query($connection, $addQuery);
        header("Refresh:0; url=AddSite.php");
    }
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

        <!--Table interface-->
        <div id = "tableContainer" class = "container-ansto centeredItem marginT-20" style = "padding:20px;">
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
                            $siteCode = "(".$row['type']."0".$row['SiteID'].")";
                        } else {
                            $siteCode = "(".$row['type'].$row['SiteID'].")";
                        }
                        echo 
                        '<tr>
                            <td class = "staticData" style = "background-color:white;"><input type = "text" class = "dbReadTB" style = "width:40px;" name = "ID" readonly value = "'.$row['SiteID'].'"></input></td>
                            <td class = "staticData" style = "background-color:white;"><input type = "text" class = "dbReadTB" style = "width:140px;" name = "siteName" readonly value = "'.$row['siteName'].'"></input></td>
                            <td class = "staticData" style = "background-color:white;"><input type = "text" class = "dbReadTB" style = "width:100px;" name = "siteCode" readonly value = "'.$siteCode.'"></td>
                            <td style = "background-color:white;"><input type = "button" class = "siteButton" value = "Delete" onclick = "DisplayConfirmation(';
                                    echo "'".$row['SiteID']."',";
                                    echo "'".$row['siteName']."',";
                                    echo "'".$siteCode."'";
                                    echo ');"></input></td>
                        </tr>';
                    }

                }
            ?>
            </table>
            <input type = "button" class = "btn-ansto centeredContent" value = "Add a Site" style = "display:block; font-size:20px;" onclick = "ShowAddSite();">
        </div>

        <!--Confirmation interface which is initially invisible-->
        <div id = "confirmationContainer" class = "container-ansto centered-800-X marginT-20" style = " width:600px; display:none;">
            <h1 id = "confirmationMsg" class = "H290Width" style = "padding-top:20px;"></h1>
            
            <div class = "strip width-90">  
                <input type = "button" class = "btn-ansto" style = "margin: 40px 0px 50px 40px; font-size:25px" value = "NO. GO BACK" onclick = "GoBack();">
                <input type = "button" class = "btn-ansto floatRight" style = "margin: 40px 50px 50px 0px; font-size:25px" value = "YES" onclick = "DeleteSite();">
            </div>
        </div>

        <!--Add a site interface which is also initially invisible-->
        <div id = "addSiteContainer" class = "container-ansto centered-800-X marginT-20" style = " width:600px; display:none; padding-bottom:20px;">
            <h1 class = "H290Width" style = "padding-top:20px;">Add a new site</h1>
            <div class = "width-90">
                <div class = "centeredContent">
                    <div class = "strip">
                        <p class = "whiteText">Site Name: </p><input id = "newName" type = "textbox" style = "padding:5px; border-radius: 5px; border-style: none;">
                        <p class = "whiteText" style = "margin-left:20px;">Type: </p> 
                        <select id = "newType">
                            <option value = "ASP">ASP</option>
                            <option value = "GAS">GAS</option>
                        </select>
                    </div>
                        
                </div>
                
                <div class = "strip" style = "margin-top:10px;">
                    <input class = "btn-ansto font-16" type = "button" value = "Back" onclick = "GoBack();">
                    <input class = "btn-ansto font-16 floatRight" type = "button" value = "Add" onclick = "AddSite();">
                </div>
            </div>

        </div>

    </body>
</html>

<script type="text/javascript">
    var table = document.getElementById('tableContainer');
    var confirm = document.getElementById('confirmationContainer');
    var addSite = document.getElementById('addSiteContainer');
    var selectedID;

    function DisplayConfirmation (ID, name, code) {
        //Hide table and display confirm screen
        table.style.display = "none";
        confirm.style.display = "block";

        //Set id variable to be accessed globaly
        selectedID = ID;

        document.getElementById('confirmationMsg').innerHTML 
        = "Are you sure you want to delete " + name + " " + code + "?";
    }

    function GoBack () {
        //Hide confirm screen and display table
        table.style.display = "";
        confirm.style.display = "none";
        addSite.style.display = "none";
    }

    function DeleteSite () {
        window.location.href = "AddSite.php?deleteID=" + selectedID;
    }

    function AddSite () {
        // Get the entered name and type
        var name = document.getElementById('newName').value;
        var type = document.getElementById('newType');
        var selectedType = type.options[type.selectedIndex].value;
        window.location.href = "AddSite.php?addName=" + name + "&addType=" + selectedType;
    }

    function ShowAddSite () {
        table.style.display = "none";
        addSite.style.display = "block";
    }

</script>

<?php
    mysqli_close($connection)
?>