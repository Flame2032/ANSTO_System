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

    $query = 'SELECT * FROM users';
    $result = mysqli_query($connection, $query);

    // This code is executed if the user deletes a site
    if(isset($_GET['deleteID'])){
        $id = $_GET['deleteID'];
        $deleteQuery = "DELETE FROM sites WHERE SiteID = $id";
        mysqli_query($connection, $deleteQuery);
        header("Refresh:0; url=ManageAccounts.php");
    }

    // This code is executed if the user adds a site
    if(isset($_GET['addName'])){
        $name = $_GET['addName'];
        $pass = $_GET['addPass'];
        $pass = hash('sha256', $pass);
        $level = $_GET['level'];
        $addQuery = "INSERT INTO users (`userName`, `password`, `level`) VALUES ('".$name."', '".$pass."' ,'".$level."')";
        mysqli_query($connection, $addQuery);
        header("Refresh:0; url=ManageAccounts.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Account Management</title>
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
                <div class = "rightDiv">
                    <a href="logoff.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <?php 
            if (isset($_GET['accountDeleted'])) {
                echo "<p>Account has been deleted</p>";
            }
        ?>

        <!--Table interface-->
        <div id = "tableContainer" class = "container-ansto centeredItem marginT-20" style = "padding:20px; display:;">
            <p class = "H290Width" style = "margin-top:0px;">Existing Users</p>

            <?php 
                if($result){
                    $x = 0;

                    echo 
                    '<table style = "margin:0px 20px;">
                        <tr>
                            <td class = "columnTitle">User ID</td>
                            <td class = "columnTitle">User Name</td>
                            <td class = "columnTitle">Level</td>
                            <td class = "columnTtle" style = "background-color:#0079c0; border-color:#0079c0"></td>
                        </tr>'
                    ;

                    while ($row = mysqli_fetch_array($result)) {
                        $level = null;
                        if ($row['level'] == '1') {
                            $level = 'Admin';
                        } else {
                            $level = 'User';
                        }
                        echo 
                        '<tr>
                            <td class = "staticData" style = "background-color:white;"><input type = "text" class = "dbReadTB" style = "width:40px;" name = "ID" readonly value = "'.$row['usersID'].'"></input></td>
                            <td class = "staticData" style = "background-color:white;"><input type = "text" class = "dbReadTB" name = "siteName" readonly value = "'.$row['userName'].'"></input></td>
                            <td class = "staticData" style = "background-color:white;"><input type = "text" class = "dbReadTB" style = "width:80px;" name = "siteName" readonly value = "'.$level.'"></input></td>
                            <td style = "background-color:white;"><input type = "button" class = "siteButton" value = "Edit" onclick = "EditUser(';
                                    echo "'".$row['usersID']."', ";
                                    echo "'".$row['userName']."'";
                                    echo ');"></input></td>
                        </tr>';
                    }

                }
            ?>
            </table>
            <input type = "button" class = "btn-ansto centeredContent" value = "Create New Account" style = "display:block; font-size:20px;" onclick = "ShowAddUser();">
        </div>

        <!--Add a site interface which is also initially invisible-->
        <div id = "addAccountContainer" class = "container-ansto fully-centered-known-size marginT-20" style = " width:400px; display:none; padding-bottom:20px;">
            <h1 class = "H290Width" style = "padding-top:20px;">Create a new user account</h1>
            <div class = "width-90">
                <div class = "centeredContent">
                    <div class = "strip" style = "margin: 10px 0px;">
                        <p class = "whiteText">Username: </p><input id = "newName" type = "textbox" class = "modernTextBox"
                        style = "display: block; width:130px; margin-bottom:10px;" required>
                        <p class = "whiteText">Password: </p><input id = "pass" type = "password" class = "modernTextBox"
                        style = "display: block; width:130px; margin-bottom:10px;" required>
                        <p class = "whiteText">Confirm Password: </p><input id = "confirmPass" type = "password" class = "modernTextBox"
                        style = "display: block; width:130px; margin-bottom:10px;" required>
                        <p class = "whiteText">Account Level:</p>
                        <select id = "levelSelect" style = "display: block; width:130px;">
                            <option value = "0">User</option>
                            <option value = "1">Admin</option>
                        </select>
                    </div>
                </div>
                
                <div class = "strip" style = "margin-top:10px;">
                    <input class = "btn-ansto font-16" type = "button" value = "Back" onclick = "GoBack();">
                    <input class = "btn-ansto font-16 floatRight" type = "button" value = "Confirm" onclick = "AddUser();">
                </div>
            </div>

        </div>

    </body>
</html>

<script type="text/javascript">
    var table = document.getElementById('tableContainer');
    var addUser = document.getElementById('addAccountContainer');
    var selectedID;

    function EditUser (ID, name) {
        window.location.href = "EditAccount.php?id=" + ID + "&name=" + name;
    }

    function GoBack () {
        //Hide confirm screen and display table
        table.style.display = "";
        addUser.style.display = "none";
    }

    function AddUser () {
        var matchingPass = false;
        var valid = true;
        var name = document.getElementById('newName').value;
        var pass = document.getElementById('pass').value;
        var confirmPass = document.getElementById('confirmPass').value;
        var level = document.getElementById('levelSelect').value;
        // Validation
        if (name == "" || pass == "" || confirmPass == "" || pass != confirmPass) {
            valid = false;
        } else if (pass == confirmPass){
            matchingPass = true;
        };

        if (!valid) {
            if (name == "") {
                alert("Username is required");
            } else if (pass == "" || confirmPass == "") {
                alert("Both password fields are required");
            } else if (!matchingPass){
                alert("Passwords entered do not match");
            };
        };
            
        if(valid){
            window.location.href = "ManageAccounts.php?addName=" + name + "&addPass=" + pass + "&level=" + level;
        };
    }

    function ShowAddUser () {
        table.style.display = "none";
        addUser.style.display = "block";
    }

</script>

<?php
    mysqli_close($connection)
?>