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
                    $currentDate = date('d-m-Y');

                    ini_set('display errors', 1);
                    $table = 'gasc';
                    $found = 'Intensity Results';
                    //$result = array();
                    require_once("db_connect.php");

                    //This will allow user to select CSV file and submit to Table
                    if(isset($_POST['submit2'])){
                    $fname = $_FILES['select_file']['name'];
                    echo 'upload file name: '.$fname.' ';

                    $check_ext = explode(".",$fname);

                    //Validation that checks if file type is csv
                    if(strtolower(end($check_ext)) == "csv"){
                    $filename = $_FILES['select_file']['tmp_name'];
                    //Will open and read file with "r"
                    $handle = fopen($filename, "r");

                    $result =[];

                    $first = strtolower(fgets($handle, 4096));
                    $keys = str_getcsv($first);

                    while(($buffer = fgets($handle, 4096)) !== false){

                    $array = str_getcsv($buffer);
                    if(empty($array)) continue;

                        $row = [];
                        $i=0;

                        foreach($keys as $key){
                        $row[$key] = $array[$i];
                        $i++;
                        }
                            $result[] = $row;
                            //print_r($result);


                    }
                    echo "!----successfully imported----!";
                    fclose($handle);
                    return $result;


                                                      
                    }
                            
             
                    else{
                    // Validation to prompt user that file has to be CSV
                    echo " --INVALID FILE, PLEASE SELECT CSV FILE-- ";
                        }
                    }




                    //************************* This will input the row number of user input ******************************
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
                    

                    if(isset($_POST['number'])){
                        for ($j=0; $j < sizeof($number); $j++) { 
                        # code...
                        //echo "hello";
                        }
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