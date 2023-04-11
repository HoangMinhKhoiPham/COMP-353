<?php require_once '../database.php';
$statement = $conn->prepare('DELETE FROM ' . DBNAME . '.hasTaken HT where HT.vaccineCaseID = :vaccineCaseID');
$statement->bindParam(":vaccineCaseID", $_GET["ID"]);
$statement->execute(); //executes the query above
header("Location: ../../main/Vaccination/displayVaccination.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Successfully Deleted</h1>
</body>

</html>