<?php require_once '../../database.php';
if (isset($conn)) {
    $statement = $conn->prepare('DELETE FROM ' . DBNAME . '.Schedule WHERE Schedule.employeeID = :employeeID AND Schedule.facilityID = :facilityID AND Schedule.shiftStart = :shiftStart;');
    $statement->bindParam(":employeeID", $employeeID);
    error_log(print_r($_GET, true));
    $statement->bindParam(":facilityID", $facilityID);
    error_log(print_r($_GET, true));
    $statement->bindParam(":shiftStart", $shiftStart);
    error_log(print_r($_GET, true));
    $statement->execute(); //executes the query above
    $employeeID = $_GET["employeeID"];
    $facilityID = $_GET["facilityID"];
    $shiftStart = $_GET["shiftStart"];
}
header("Location: ../../main/Schedule/displaySchedule.php")
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