<?php

	$query = "DELETE FROM sites WHERE SiteID = ".$ID;

    //Execute the query
    $result = mysqli_query($connection, $query);

?>