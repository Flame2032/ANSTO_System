<?php
    session_start();
    require_once("nocache.php");

    $admin = null;

    if (isset($_SESSION["user"])) {
        if ($_SESSION["admin"] == true) {
            $admin = true;
        } else {
            $admin = false;
        }
    }
?>

<script type="text/javascript">
    function GoHome () {
        window.location.href = "index.php";
    }
</script>

<!--Navigation Bar-->
<div class = "navBarContainer"> 
    <div class = "navBar">
        <input type = "image" class = "navLogo" src = "Images/ANSTO48H.jpg" onclick = "GoHome()">
        <div class = "myDropdown">
            <button class = "myDropbtn">View Data
                <i class="fa fa-caret-down"></i> 
            </button>
            <div class = "myDropdown-content">
                <a href="AllASPData.php">All</a>
                <a href="PreData.php">Pre-Analysis</a>
                <a href="PostData.php">Post-Analysis</a>
                <a href="EditLog.php">Edit Log</a>
            </div>
        </div>
        <div class = "myDropdown">
            <button class = "myDropbtn">Update Database
                <i class="fa fa-caret-down"></i> 
            </button>
            <div class = "myDropdown-content">
                <a href="NewFilters.php">Prepare New Filters</a>
                <a href="MarkSentFilters.php">Mark Sent Filters</a>
                <a href="PostScan.php">Post-Analysis</a>
            </div>
        </div>
        <div class = "myDropdown">
            <button class = "myDropbtn">Logsheets
                <i class="fa fa-caret-down"></i> 
            </button>
            <div class = "myDropdown-content">
                <a href="ExistingLogsheets.php">View Existing Logsheets</a>
                <a href="GenerateLogsheets.php">Generate New Logsheets</a>
                <a href="ReturnedLogsheets.php">Edit Returned Logsheets</a>
            </div>
        </div>
        <?php 
            if ($_SESSION["admin"]) {
                echo '
                <div class = "myDropdown">
                    <button class = "myDropbtn">Management
                        <i class="fa fa-caret-down"></i> 
                    </button>
                    <div class = "myDropdown-content">
                        <a href="ManageAccounts.php">Account Management</a>
                    </div>
                </div>';
            } 
        ?>
    </div>
</div> 