<?php

    $servername = "localhost";
    $DBuser = "root";
    $DBpassword ="";
    $Dbname = "blogu";

    $geri = "geri";

    $conn = mysqli_connect($servername, $DBuser, $DBpassword, $Dbname);

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

