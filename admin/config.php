<?php
    // Read config.ini file
    $config = parse_ini_file('config.ini'); 

    // Set database connection
    $con = new mysqli($config['hostname'],$config['username'],$config['password'],$config['dbname']);

    // if there is a problem, show error message
    if (mysqli_connect_errno()) {
        printf("Connection failed: %s\n", mysqli_connect_error());
        exit();
    }