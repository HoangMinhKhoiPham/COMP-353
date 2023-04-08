<?php require_once '../database.php';
$statement = $conn->prepare('DELETE FROM '.DBNAME.'.Employee where Employee.ID = :EmployeeID');
$statement->bindParam(":EmployeeID", $_GET["ID"]);
$statement->execute(); //executes the query above
header("Location: ./displayEmployees.php")
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