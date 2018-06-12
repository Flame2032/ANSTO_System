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
        function ImportCSV2Array($filename)
        {
            $fname = $_FILES['select_file']['name'];
            echo 'Uploaded CSV File Name: '.$fname.' ';

            $check_ext = explode(".",$fname);

            //Validation that checks if file type is csv
            if(strtolower(end($check_ext)) == "csv"){
            $filename = $_FILES['select_file']['tmp_name'];
            //Will open and read file with "r"
            $handle = fopen($filename, "r");

            $row = 0;
            $col = 0;
            if($handle){
            while (($row = fgetcsv($handle, 4096)) !== false){
                if(empty($fields)){
                    $fields = $row;
                    continue;
                }
                foreach($row as $k=>$value){
                    $results[$col][$fields[$k]] = $value;
                    }
                $col++;
                unset($row);
                //print_r($results);
                }
                if(!feof($handle)){
                echo "Error: unexpected fgets() failn";
                }
                fclose($handle);
                }
                return $results;                              
                }


                //***********************************TEST*********************************




                else{
                // Validation to prompt user that file has to be CSV
                echo " --INVALID FILE, PLEASE SELECT CSV FILE-- ";
                        }
        }
        ?>


        <div class = "container-ansto centered-800-X marginT-20" style = "padding:20px;">
            <div class = "strip">
                <h2 class = "H290Width-left"> <?php echo ($number); ?> Pre-Analysis filter entries have been generated</h2>
                <button class = "btn-ansto font-16 floatRight" style = "padding:10px;" onclick = "uploadCSV()">Import MABI</button>

                    <!-- This is for selection of CSV file with browse button 
                    Once the user selects the file they will need to press submit to add csv data to table -->
                    <form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">
                        <input type = 'hidden' name = 'number' value = '<?php echo ($number); ?>'>
                        <input type='file' name='select_file' size='20' >
                        <input type='submit' name='submit1' value='submit'>
                        <button type = 'submit' name='submit2' value='submit'>Confirm</button>
                    </form>

            </div>
            
            <!-- Table will allow user to manually input data for Pre Mass and will output data from CSV file -->
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
                </tr>

                <?php


                    //************************* This will input the row num of user input ******************************
                    $currentDate = date('d-m-Y');

                    if (isset($_POST['number'])) {
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
                    

                    if(isset($_POST['submit2'])){
                        for ($j=0; $j < sizeof($number); $j++){ 
                        # code...
                            // This is to echo out arrays into table
                            $filename = "MABI_V2_AspEx40802_40785.csv";
                            $csvArray = ImportCSV2Array($filename);
                            foreach ($csvArray as $row){   
                            echo$row['Sample'];
                            //echo $row['Type'];
                            //echo $row['405nm'];

                            }
                        }
                    }


                    //************************************ CSV FILE HANDLE ********************************************** 
                    ini_set('display errors', 1);
                    $table = 'gasc';
                    $found = 'Intensity Results';
                    //$result = array();
                    require_once("db_connect.php");
    
                    //This will allow user to select CSV file and submit to Table
                    if(isset($_POST['submit2'])){
                    ImportCSV2Array($filename);

                    
                    // This is to echo out arrays into table
                    //$filename = "MABI_V2_AspEx40802_40785.csv";
                    //$csvArray = ImportCSV2Array($filename);
                    //foreach ($csvArray as $row)
                        //{   
                            //echo$row['Sample'];
                            //echo $row['Type'];
                            //echo $row['405nm'];
                        //}
                            
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