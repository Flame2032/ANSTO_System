<?php

	//Get the posted ID
    //$ID = $_POST['ID'];

    require_once("db_connect.php");

    $query = 'DELETE FROM sites WHERE ID = "1"';
    $result = mysqli_query($connection, $query);

    mysqli_close($connection)
?>