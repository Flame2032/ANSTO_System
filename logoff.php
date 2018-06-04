<?php
 session_start();
 header("Cache-Control: no-cache");
 header("Expires: -1");
 session_destroy();
 header("location: Login.php");
?> 