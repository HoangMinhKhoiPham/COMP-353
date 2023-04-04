<?php
$server = 'localhost:3306'; // will be changed to the Concordia server name once ready to be uploaded
$username = 'root';
$password = '';
$database = 'comp353proj';

try {
    $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}
?>