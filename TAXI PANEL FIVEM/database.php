<?php
    ini_set("session.hash_function","sha512");
    session_start();

    ini_set("max_execution_time",500);

    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_data = "taxi_panel";

    $con = new mysqli($db_host,$db_user,$db_pass,$db_data);
?>