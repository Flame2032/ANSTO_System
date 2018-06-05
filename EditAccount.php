<?php
    require_once("db_connect.php");

    $query = 'SELECT * FROM users';
    $result = mysqli_query($connection, $query);

    if(isset($_GET['id']) || isset($_POST['id'])){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $getUser = mysqli_query($connection, "SELECT * FROM users WHERE usersID = $id");
        while ($row = mysqli_fetch_array($getUser)) {
            $password = $row['password'];
            $userName = $row['userName'];
        }
    }

    if (isset($_GET['newName'])) {
        $newName = $_GET['newName'];
        $UpdateName = mysqli_query($connection, "UPDATE users SET `userName` = '$newName' WHERE usersID = $id");
        if($UpdateName){
            header("Refresh:0; url=EditAccount.php?id=".$id."&nameUpdated=true");
        }
    }

    if (isset($_GET['delete'])) {
        $deleteAdmin = false;
        $getUser = mysqli_query($connection, "SELECT * FROM users WHERE usersID = $id");
        while ($row = mysqli_fetch_array($getUser)) {
            if($row['level'] == '1'){
                // User tried to delete an admin account (don't allow)
                $deleteAdmin = true;
            } else {
                // Delete account
                $deleteQuery = mysqli_query($connection, "DELETE FROM users WHERE `usersID` = $id");
                if($deleteQuery){
                    header("Location: ManageAccounts.php?accountDeleted=true");
                }
            }
        }
                
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Account</title>
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
                <a href="ManageAccounts.php" style = "font-family:helvetica;">Back</a>
                <div class = "rightDiv">
                    <a href="logoff.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap content-->
        <div class = "navSpacer"></div>

        <?php
            if (isset($_GET['nameUpdated'])) {
                echo "<p>Username has successfully been updated!</p>";
            }
            if (isset($_GET['delete'])) {
                if($deleteAdmin){
                    echo "<p>You cannot delete an admin account</p>";
                }
            }

            if (isset($_POST['currentPass'])) {
                $currentPassword = hash('sha256', $_POST['currentPass']);
                $getUser = mysqli_query($connection, "SELECT * FROM users WHERE usersID = $id");
                while ($row = mysqli_fetch_array($getUser)) {
                    if($currentPassword == $row['password']){
                        if($_POST['newPass'] == $_POST['confirmPass']){
                            $newPass = hash('sha256', $_POST['newPass']);
                            $updateQuery = mysqli_query($connection, "UPDATE users SET `password` = '$newPass' WHERE usersID = $id");
                            echo "<p>Password has successfully been updated!</p>";
                        } else {
                            echo "<ul class = 'errors'>";
                            echo "<li>New passwords do not match</li>";
                        }
                    } else {
                        echo "<ul class = 'errors'>";
                        echo "<li>Current Password was entered incorrectly</li>";
                    }
                }
                echo "</ul>";
            }
        ?>

        <!--Overview interface-->
        <div id = "overViewDiv" class = "container-ansto centeredItem marginT-20" style = "padding:20px; display:;">
            <p class = "H290Width" style = "margin-top:0px;"> Edit Account:</p>
                
            <?php 
                echo "<p class = 'whiteText centeredItem'>Account ID: $id</p>";
            ?>
            
            <p class = 'whiteText centeredItem' style = 'margin-top: 20px; margin-bottom:20px;'>Username: 
                <?php
                    $getUser = mysqli_query($connection, "SELECT * FROM users WHERE usersID = $id");
                    while ($row = mysqli_fetch_array($getUser)) {
                        echo $row['userName'];
                    }
                ?>
            </p>

            <div class = "centeredContent">
                <button class = "btn-ansto" style = "margin-right:20px;" onclick = "GoChangeUsername();">Change Username</button>
                <button class = "btn-ansto" onclick = "GoChangePassword();">Change Password</button>
            </div>

            <div class = "centeredContent">
                <button class = "btn-ansto" style = "margin-top:10px;" onclick = "GoDeleteAccount();">Delete Account</button>
            </div>
            
        </div>

        <!--Change Name interface-->
        <div id = "editNameDiv" class = "container-ansto centeredItem marginT-20" style = "padding:20px; display:none;">
            <div class = "strip">
                <p class = "H290Width" style = "margin-top:0px;">Edit Username</p>
                <p class = "whiteText">New Username: </p><input class = "modernTextBox" type = "textbox" id = "newName" value = "<?php echo $userName ?>">
            </div>
            <div class = "strip" style = "margin-top:10px;">
                <button class = "btn-ansto" onclick = "GoMenu();">Cancel</button>
                <?php 
                echo '<button class = "btn-ansto floatRight" onclick = "UpdateName(';
                echo "'".$id."'";
                echo ');">Confirm</button>';
                ?>
            </div>
        </div>

        <!--Change Password interface-->
        <div id = "changePassDiv" class = "container-ansto centeredItem marginT-20" style = "padding:20px; display:none; width:300px;">
            <p class = "H290Width" style = "margin-top:0px;">Change Password</p>
            <form action = "EditAccount.php" method = "POST">
            <div class = "centeredContent">
                    <div class = "strip" style = "margin: 10px 0px;">
                        <p class = "whiteText">Current Password: </p><input id = "currentPass" name = "currentPass" type = "password" class = "modernTextBox"
                        style = "display: block; width:130px; margin-bottom:10px;" required>
                        <p class = "whiteText">New Password: </p><input id = "newPass" name = "newPass" type = "password" class = "modernTextBox"
                        style = "display: block; width:130px; margin-bottom:10px;" required>
                        <p class = "whiteText">Confirm: </p><input id = "confirmPass" name = "confirmPass" type = "password" class = "modernTextBox"
                        style = "display: block; width:130px;" required>
                        <?php echo '<input type = "hidden" name = "id" value = "'.$id.'">'; ?>
                    </div>
                </div>
            <div class = "strip" style = "margin-top:10px;">
                <button type = "submit" class = "btn-ansto" onclick = "GoMenu();">Cancel</button>
                <?php 
                echo '<button class = "btn-ansto floatRight" onclick = "ChangePassword(';
                echo "'".$id."'";
                echo ');">Confirm</button>';
                ?>
            </div>
            </form>
        </div>

        <!-- Delete Account interface-->
        <div id = "deleteAccountDiv" class = "container-ansto centeredItem marginT-20" style = "padding:20px; display:none; width: 600px;">
            <h1 class = "H290Width" style = "margin-top:0px;">Are you sure you want to delete this account?</h1>
            <div class = "centeredContent">
                <button class = "btn-ansto" onclick = "GoMenu();"
                style = "width:100px; height:50px; font-size: 25px; margin-right:100px;">NO</button>
                <?php 
                echo '<button class = "btn-ansto" onclick = "DeleteAccount(';
                echo "'".$id."'";
                echo ');" style = "width:100px; height:50px; font-size: 25px;">YES</button>';
                ?>
            </div>
        </div>

    </body>
</html>

<script type="text/javascript">
    var mainScreen = document.getElementById('overViewDiv');
    var editNameScreen = document.getElementById('editNameDiv');
    var changePassScreen = document.getElementById('changePassDiv');
    var deleteScreen = document.getElementById('deleteAccountDiv');

    function GoMenu () {
        mainScreen.style.display = "";
        editNameScreen.style.display = "none";
        changePassScreen.style.display = "none";
        deleteScreen.style.display = "none";
    }

    function GoChangeUsername () {
        mainScreen.style.display = "none";
        editNameScreen.style.display = "";
    }

    function GoChangePassword () {
        mainScreen.style.display = "none";
        changePassScreen.style.display = "";
    }

    function GoDeleteAccount () {
        mainScreen.style.display = "none";
        deleteScreen.style.display = "";
    }

    function ChangePassword (id) {
        var currentPass = document.getElementById('currentPass').value;
        var newPass = document.getElementById('newPass').value;
        var confirmPass = document.getElementById('confirmPass').value;
    }

    function UpdateName (id) {
        var newName = document.getElementById('newName').value;
        var id = id;
        window.location.href = "EditAccount.php?newName=" + newName + "&id=" + id;
    }

    function DeleteAccount (id) {
        var id = id;
        window.location.href = "EditAccount.php?delete=true&id=" + id;
    }

</script>

<?php
    mysqli_close($connection)
?>