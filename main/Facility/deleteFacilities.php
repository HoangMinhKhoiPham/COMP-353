<?php require_once '../../database.php';
if (isset($conn)) {
    $statement = $conn->prepare('DELETE FROM ' . DBNAME . '.Facilities where Facilities.id = :id');
    $statement->bindParam(":id", $_GET["ID"]);
    error_log(print_r($_GET, true));
    $statement->execute(); //executes the query above
}
header("Location: ../../main/Facility/displayFacilities.php")
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