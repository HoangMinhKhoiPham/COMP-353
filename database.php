<?php
require_once 'main/utils/constants.php';
$server = 'localhost'; //'vbc353.encs.concordia.ca:3306' will be changed to the Concordia server name once ready to be uploaded
$username = 'root'; //vbc353_4
$password = '';
$database = 'comp353proj';//DBNAME

try {
    $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}

