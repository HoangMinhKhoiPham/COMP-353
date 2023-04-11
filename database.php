<?php
require_once 'main/utils/constants.php';
$server = 'vbc353.encs.concordia.ca:3306'; //'vbc353.encs.concordia.ca:3306' will be changed to the Concordia server name once ready to be uploaded
$username = 'vbc353_4'; //vbc353_4
$password = 'GroupCOM';
$database = DBNAME;//DBNAME

try {
    $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}

