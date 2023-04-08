<?php require_once '../database.php';
if (isset($conn)) {
    $statement = $conn->prepare('DELETE FROM ' . DBNAME . '.Infection where Infection.infectionID = :infectionID');
    $statement->bindParam(":infectionID", $_GET["infectionID"]);
    $statement->execute(); //executes the query above
}
header("Location: ./Infection/displayInfection.php")
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
