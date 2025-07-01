<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'photo_gallery';

try{
    $conn = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected";
}
catch(PDOException $e){

    echo "Can't connect to Database or No Database found ! Please Run the commands in 'database.sql' !";
    echo "Connection Failed" + $e->getMessage();
    die();
}

