<?php

function conn(){
    $servername = 'localhost';
    $username = 'Auto';
    $password = 'LabaiSlaptas123';
    $dbname = 'auto';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error){
        die('Connection failed: '.$conn->connect_error);
    }
    return $conn;
}

?>