<?php
require_once("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>


        <title>Prepare New Filters</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
        <script src = "JavaScript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            //Load in navigation bar using jquery
            $(function(){
              $("#navBar").load("NavigationBar.php"); 
            });

            function uploadCSV() {
                window.alert ("User will be able to select a CSV file from their local drive");
            }
        </script>

    </head>

    <body>
        <!--Navigation Bar-->
        <div id="navBar"></div>
        <!--Second Bar-->
        <div class = "secondBarContainer">
            <div class = "secondBar">
                <a href="NewFilters.php" style = "font-family:helvetica;">Back</a>
                <div class = "rightDiv">
                    <a href="login.php" style = "font-family:helvetica;">Logout</a>
                </div>
            </div>
        </div>
        <!--Empty block so navbar doesn't overlap contents-->
        <div class = "navSpacer"></div>


        <?php
            if (isset($_POST['number'])) {
                $number = $_POST['number'];
            }

        ?>


        <?php
        function csvImport()
        {
            $fname = $_FILES['select_file']['name'];
            //echo 'Selected CSV File: '.$fname.' '; // THIS IS TO Inform user that file has been selected as a test

            $check_ext = explode(".",$fname);

            //Validation that checks if file type is csv
            if(strtolower(end($check_ext)) == "csv"){
            $filename = $_FILES['select_file']['tmp_name'];
            //Will open and read file with "r"
            $handle = fopen($filename, "r");

            $row = 0; // counter for rows
            $col = 0; // counter for columns

            // If file exists then it will continue to read and get values from csv file
            if($handle){
                while (($row = fgetcsv($handle, 4096)) !== false){
                    // this will make sure to check if array is empty it will equal to row and continue
                    if(empty($fields)){
                    $fields = $row; continue;
                    }

                    /************* FOR LOOP FOR CSV ***********/
                    foreach($row as $key=>$value){
                        $results[$col][$fields[$key]] = $value;
                        $cols = $results[$col];  
                        }
                        $col++; // count all the colummns of the array $row
                        unset($row); // This is to not increment array into numbers
                    }
                    //print_r($results);

                    fclose($handle);
            }
                    //**********************************************TEST THIS SHIT*********************************************
                    echo '<table>';
                        echo
                        "<tr>
                            <th class = 'staticData columnTitle'>ID</th>
                            <th class = 'staticData columnTitle'>Pre Mass</th>
                            <th class = 'staticData columnTitle'>Pre Laser</th>
                            <th class = 'staticData columnTitle'>Type</th>
                            <th class = 'staticData columnTitle'>l<sub>0</sub>(405)</th>
                            <th class = 'staticData columnTitle'>l<sub>0</sub>(465)</th>
                            <th class = 'staticData columnTitle'>l<sub>0</sub>(525)</th>
                            <th class = 'staticData columnTitle'>l<sub>0</sub>(639)</th>
                            <th class = 'staticData columnTitle'>l<sub>0</sub>(870)</th>
                            <th class = 'staticData columnTitle'>l<sub>0</sub>(940)</th>
                            <th class = 'staticData columnTitle'>l<sub>0</sub>(1050)</th>
                        </tr>";

                    //print_r($results);
                    foreach ($results as $row){
                        echo 
                        "<tr>
                          <td class = 'staticData'>" . $row['Sample'] . "</td>
                          <td><input type = 'text' class = 'dbTextbox'></input></td>
                          <td class = 'staticData'>" . $row['Sample'] . "</td>
                          <td class = 'staticData'>" . $row['Type'] . "</td>
                          <td class = 'staticData'>" . $row['  405nm'] . "</td>
                          <td class = 'staticData'>" . $row['  465nm'] . "</td>
                          <td class = 'staticData'>" . $row['  525nm'] . "</td>
                          <td class = 'staticData'>" . $row['  639nm'] . "</td>
                          <td class = 'staticData'>" . $row['  870nm'] . "</td>
                          <td class = 'staticData'>" . $row['  940nm'] . "</td>
                          <td class = 'staticData'>" . $row[' 1050nm'] . "</td>
                        </tr>";
                    }
                    return $results;

                }


            //***********************************TEST*********************************

            else{
                // Validation to prompt user that file has to be CSV file type
                echo " Invalid file, please select a csv file! ";
                }

        }
        ?>


        <div class = "container-ansto centered-800-X marginT-20" style = "padding:20px;">
            <div class = "strip">
                <h2 class = "H290Width-left"> <?php echo ($number); ?> Pre-Analysis filter entries have been generated</h2>
                <!--<button class = "btn-ansto font-16 floatRight" style = "padding:10px;" onclick = "uploadCSV()">Import MABI</button> -->

                    <!-- This is for selection of CSV file with browse button 
                    Once the user selects the file they will need to press submit to add csv data to table -->
                    <form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">
                        <input type = 'hidden' name = 'number' value = '<?php echo ($number); ?>'>
                        <input class = "btn-ansto font-16 floatLeft" style = "padding:10px;" type='file' name='select_file' size='20' >
                       <!-- <input type='submit' name='submit1' value='submit'> -->
                       <?php
                        if (isset($_POST['submit2'])) {
                            echo '<button class = "btn-ansto font-16 floatRight" style = "padding:10px;margin-left:10px;" onclick = "UpdateDatabase();" style = "height:35px; margin-top:5px;">Save to Database</button>';
                        }
                        ?>
                        <button class = "btn-ansto font-16 floatRight" style = "padding:10px;" type = 'submit' name='submit2' value='submit'>Import MABI</button>
                        
                    </form>
                    

            </div>
            
            <!-- Table will allow user to manually input data for Pre Mass and will output data from CSV file -->
            
            <?php
            if (!isset($_POST['submit2'])) {
                echo '
                <table>
                    <tr>
                        <th class = "staticData columnTitle">ID</th>
                        <th class = "staticData columnTitle">Pre Mass</th>
                        <th class = "staticData columnTitle">Pre Laser</th>
                        <th class = "staticData columnTitle">Type</th>
                        <th class = "staticData columnTitle">l<sub>0</sub>(405)</th>
                        <th class = "staticData columnTitle">l<sub>0</sub>(465)</th>
                        <th class = "staticData columnTitle">l<sub>0</sub>(525)</th>
                        <th class = "staticData columnTitle">l<sub>0</sub>(639)</th>
                        <th class = "staticData columnTitle">l<sub>0</sub>(870)</th>
                        <th class = "staticData columnTitle">l<sub>0</sub>(940)</th>
                        <th class = "staticData columnTitle">l<sub>0</sub>(1050)</th>
                    </tr>';


                    for ($i=0; $i < $number; $i++) { 

                        echo 

                        "<tr>
                            <th class = 'staticData'>$i</th>
                            <th><input type = 'text' class = 'dbTextbox'></input></th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                            <th class = 'staticData'>--</th>
                        </tr>";
                    }
                } 

                //************************* Check Filter Type selected from previous page ******************************
                $currentDate = date('d-m-Y'); 
                $SelectASP = false;
                $SelectGASC = false;
                $SelectGASF = false;

                if($number == "ASP" && isset($_POST['number'])) {
                $SelectASP = mysqli_query($connection, "SELECT * FROM asp");
                } else if ($number == "GAS" && isset($_POST['number'])) {
                $SelectGASC = mysqli_query($connection, "SELECT * FROM gasc");
                $SelectGASF = mysqli_query($connection, "SELECT * FROM gasf");
            echo "</table>";}  
            ?>
                
            

            <?php
                //************************************ CSV FILE HANDLE ********************************************** 
                ini_set('display errors', 1);
                $table = 'gasc';
                $found = 'Intensity Results';


                //This will allow user to select CSV file and submit to Table
                if(isset($_POST['submit2'])){
                csvImport();
                
                }
            ?>



            
        </div>  
    </body>
</html>