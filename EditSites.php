<?php
    session_start();
    require_once("nocache.php");
    require_once("db_connect.php");

    $admin = null;

    if (isset($_SESSION["user"])) {
        if ($_SESSION["admin"] == true) {
            $admin = true;
        } else {
            $admin = false;
        }
    } else {
        header("location:Login.php");
    }

    $query = 'SELECT * FROM sites';
    $result = mysqli_query($connection, $query);

    // This code is executed if the user deletes a site
    if(isset($_GET['deleteID'])){
        $id = $_GET['deleteID'];
        $deleteQuery = "DELETE FROM sites WHERE SiteID = $id";
        mysqli_query($connection, $deleteQuery);
        header("Refresh:0; url=EditSites.php");
    }

    // This code is executed if the user adds a site
    if(isset($_GET['addName'])){
        $name = $_GET['addName'];
        $type = $_GET['addType'];
        $id = $_GET['addID'];
        $addQuery = "INSERT INTO sites VALUES ('".$id."', '".$name."' ,'".$type."')";
        mysqli_query($connection, $addQuery);
        header("Refresh:0; url=EditSites.php");
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
                <a href="GenerateLogsheets.php" style = "font-family:helvetica;">Back</a>
                <div class = "rightDiv">
                    <a href="logoff.php" style = "font-family:helvetica;">Logout</a>
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
                    $x = 0;

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
                        $siteIDArray[$x] = $row['SiteID'];
                        $x++;
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
                    <div class = "strip" style = "margin: 10px 0px;">
                        <p class = "whiteText">ID: </p><input id = "newID" type = "number" min = "0" style = "padding:5px; border-radius: 5px; border-style: none; width:50px; margin-right:20px;" required>
                        <p class = "whiteText">Site Name: </p><input id = "newName" type = "textbox" style = "padding:5px; border-radius: 5px; border-style: none; width:130px;" required>
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
        window.location.href = "EditSites.php?deleteID=" + selectedID;
    }

    function AddSite () {
        var valid = true;
        var existingID = false;
        var id = document.getElementById('newID').value;
        var name = document.getElementById('newName').value;
        var usedSiteID = <?php echo json_encode($siteIDArray); ?>;
        for (i=0; i<usedSiteID.length; i++){
            if(usedSiteID[i] == id){
                existingID = true;
            }
        }
        // Validation
        if (id == "" || id < 0 || name == "" || existingID) {
            valid = false;
        };

        if (!valid) {
            if (id == "") {
                alert("ID field is required");
            } else if (id < 0) {
                alert("ID can't be a negative number");
            } else if (name == "") {
                alert("Site Name field is required");
            } else if (existingID){
                alert("This ID is already being used")
            };
            
        };
            
        if(valid){
            // Get the entered name and type
            var type = document.getElementById('newType');
            var selectedType = type.options[type.selectedIndex].value;
            window.location.href = "EditSites.php?addName=" + name + "&addType=" + selectedType + "&addID=" + id;
        };
    }

    function ShowAddSite () {
        table.style.display = "none";
        addSite.style.display = "block";
    }

</script>

<?php
    mysqli_close($connection)
?>