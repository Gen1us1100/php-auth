<!-- PHP script for connecting to database
change the parameters according to hosting condition -->

<?php
    $user = "sam";
    $host = "localhost";
    $dbname = "basic_auth";
    $password = "123456789";
    $conn = mysqli_connect($host, $user, $password, $dbname);
    if (mysqli_connect_errno()) {
        echo "". mysqli_connect_error();
    }
?>