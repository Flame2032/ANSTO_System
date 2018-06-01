<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Viewing: Post-Analysis Data</title>
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

<?php
include 'db_connect.php';
//get results from database
$result = mysqli_query($connection,"SELECT `gasFID`, `Site`,`Exposure Date`, Type, `Post Filter Mass`, `Post Laser`, `Date2`, `Time2`, `Initials2`,`I0 (405)`, `I0 (465)`, `I0 (525)`, `I0 (639)`, `I0 (870)`, `I0 (940)`, `I0 (1050)`, `I (405)`, `I (465)`, `I (525)`, `I (639)`, `I (870)`, `I (940)`, `I (1050)` FROM `gasf`");
$all_property = array();  //declare an array for saving property
//showing property
echo '<table class="data-table" border="2" width="auto" overflow: "auto" ID="Table1" style="font-size: 70%;">
        <tr class="data-heading">';  //initialize table tag
while ($property = mysqli_fetch_field($result)) {
    echo '<td>' . $property->name . '</td>';  //get field name for header
    array_push($all_property, $property->name);  //save those to array
}
echo '</tr>'; //end tr tag
//showing all data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($all_property as $item) {
        echo '<td>' . $row[$item] . '<div style= "width:180px;"</div></td>'; //get items using property value
    }
    echo '</tr>';
	
}
echo "</table>";
?>
<?php
include 'db_connect.php';
//get results from database
$result = mysqli_query($connection,"SELECT `gasCID`, `Site`,`Exposure Date`, Type, `Post Filter Mass`, `Post Laser`, `Date2`, `Time2`, `Initials2`,`I0 (405)`, `I0 (465)`, `I0 (525)`, `I0 (639)`, `I0 (870)`, `I0 (940)`, `I0 (1050)`, `I (405)`, `I (465)`, `I (525)`, `I (639)`, `I (870)`, `I (940)`, `I (1050)` FROM `gasc`");
$all_property = array();  //declare an array for saving property
//showing property
echo '<table class="data-table" border="2" width="auto" overflow: "auto" ID="Table1" style="font-size: 70%;">
        <tr class="data-heading">';  //initialize table tag
while ($property = mysqli_fetch_field($result)) {
    echo '<td>' . $property->name . '</td>';	//get field name for header
    array_push($all_property, $property->name);  //save those to array
}
echo '</tr>'; //end tr tag
//showing all data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($all_property as $item) {
        echo '<td>' . $row[$item] . '<div style= "width:180px;"</div></td>'; //get items using property value
    }
    echo '</tr>';
	
}

echo "</table>";
?>
    </body>
</html>