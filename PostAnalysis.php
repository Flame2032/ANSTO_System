<?php
    session_start();
    require_once("nocache.php");
    require_once("db_connect.php");
	$retrievepre[][]=null;
    $admin = null;
	if(isset($_POST["myList"])){
		$myList=$_POST["myList"];
		$filtercount=$myList.length;
		for ($row=0;$row<$filtercount;$row++){
			//GAS Fine statement loop
			if(substr($myList[$row],0,2)=='GF'){
			$query[$row]="SELECT gasFID, Site, 'Pre Filter Mass',Type, 'I0 (405)', 'I0 (465)', 'I0 (525)', 'I0 (639)', 'I0 (870)', 'I0 (940)', 'I0 (1050)'  FROM asp WHERE gasFID =".substr($myList[$row],-4,4);
			}else if(substr($myList[$row],0,2)=='GC'){
			//GAS Coarse statement loop
			$query[$row]="SELECT gasCID, Site, 'Pre Filter Mass',Type, 'I0 (405)', 'I0 (465)', 'I0 (525)', 'I0 (639)', 'I0 (870)', 'I0 (940)', 'I0 (1050)'  FROM asp WHERE gasCID =".substr($myList[$row],-4,4);
			}
			else{
			$query[$row]="SELECT aspID, Site, 'Pre Filter Mass',Type, 'I0 (405)', 'I0 (465)', 'I0 (525)', 'I0 (639)', 'I0 (870)', 'I0 (940)', 'I0 (1050)'  FROM asp WHERE aspID =".$myList[$row];
			//ASP statement loop
			}
			require_once("db_connect.php");
			$retrievepre[$row][]=$connection->query($query);
		}
	}else{
		$myList=0;		
		$filtercount=0;
	}
    if (isset($_SESSION["user"])) {
        if ($_SESSION["admin"] == true) {
            $admin = true;
        } else {
            $admin = false;
        }
    } else {
        header("location:Login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Post Analysis</title>
        <script type="text/javascript">

            function uploadCSV() {
                window.alert ("You will select a CSV from your local drive to populate the remaining data");
            }

        </script>
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

            <div class = "container-ansto main-content-centered marginT-20" style = "padding:20px;">
            <div class = "strip">
                <h2 class = "H290Width-left"><?php  echo $filtercount ?> Post-Analysis filters have been scanned in</h2>
                <button class = "btn-ansto font-16 floatRight" style = "padding:10px;" onclick = "uploadCSV()">Import CSV</button>
            </div>
            
            <table>
                <tr>
                    <th class = "columnTitle">ID</th>
                    <th class = "columnTitle">Site</th>
                    <th class = "columnTitle">Pre Mass</th>
                    <th class = "columnTitle">Type</th>
                    <th class = "columnTitle">l<sub>0</sub>(405)</th>
                    <th class = "columnTitle">l<sub>0</sub>(465)</th>
                    <th class = "columnTitle">l<sub>0</sub>(525)</th>
                    <th class = "columnTitle">l<sub>0</sub>(639)</th>
                    <th class = "columnTitle">l<sub>0</sub>(870)</th>
                    <th class = "columnTitle">l<sub>0</sub>(940)</th>
                    <th class = "columnTitle">l<sub>0</sub>(1050)</th>
                    <th class = "columnTitle">Post Mass</th>
                    <th class = "columnTitle">l(405)</th>
                    <th class = "columnTitle">l(465)</th>
                    <th class = "columnTitle">l(525)</th>
                    <th class = "columnTitle">l(639)</th>
                    <th class = "columnTitle">l(870)</th>
                    <th class = "columnTitle">l(940)</th>
                    <th class = "columnTitle">l(1050)</th>
                    <th class = "columnTitle">Date</th>
                </tr>
				<?php 
				for($row=0;$row<$filtercount;$row++){
				echo '<tr>
                    <th class = "staticData">'.$myList[$row].'</th>
                    <th class = "staticData">'.$retrievepre[$row][1].'</th>
                    <th class = "staticData">'.$retrievepre[$row][2].'</th>
                    <th class = "staticData">'.$retrievepre[$row][3].'</th>
                    <th class = "staticData">'.$retrievepre[$row][4].'</th>
                    <th class = "staticData">'.$retrievepre[$row][5].'</th>
                    <th class = "staticData">'.$retrievepre[$row][6].'</th>
                    <th class = "staticData">'.$retrievepre[$row][7].'</th>
                    <th class = "staticData">'.$retrievepre[$row][8].'</th>
                    <th class = "staticData">'.$retrievepre[$row][9].'</th>
                    <th class = "staticData">'.$retrievepre[$row][10].'</th>
                    <th><input type = "text" class = "dbTextbox"></input></th>
                    <th class = "staticData">--</th>
                    <th class = "staticData">--</th>
                    <th class = "staticData">--</th>
                    <th class = "staticData">--</th>
                    <th class = "staticData">--</th>
                    <th class = "staticData">--</th>
                    <th class = "staticData">--</th>
                    <th class = "staticData">--</th>
                </tr>';
				}
				
				?>
                
            </table>
            <div class = "bottomStrip">
                <form action = "PreData.html">
                    <input class = "btn-ansto font-16 floatRight" type = "submit" value = "Save to Database" style = "height:35px; margin-top:5px;"></input>
                </form>
            </div>
        </div>  

    </body>
</html>