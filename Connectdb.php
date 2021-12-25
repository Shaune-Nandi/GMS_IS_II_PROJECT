<?php
    // Change this to your connection info.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'GMSdb';

    
    // Try and connect using the info above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


    // If there is an error with the connection, stop the script and display the error.
    if (mysqli_connect_errno()){
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
?>