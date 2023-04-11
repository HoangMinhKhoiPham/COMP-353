<?php require_once '../../database.php';
$statement = $conn->prepare('DELETE FROM Schedule WHERE Schedule.employeeID = :employeeID AND Schedule.facilityID = :facilityID AND Schedule.shiftStart = :shiftStart;');
$statement->bindParam(":employeeID", $_GET["employeeID"]);
$statement->bindParam(":facilityID", $_GET["facilityID"]);
$statement->bindParam(":shiftStart", $_GET["shiftStart"]);
$statement->execute(); //executes the query above
header("Location: ./displaySchedule.php")
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