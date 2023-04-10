<?php
require_once 'main/utils/constants.php';
$server = '127.0.0.1:3306'; //'vbc353.encs.concordia.ca:3306' will be changed to the Concordia server name once ready to be uploaded
$username = 'root'; //vbc353_4
$password = '%72%c9w!owzXHrkKt!oW';
$database = 'vbc353_4';//DBNAME

try {
    $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}


