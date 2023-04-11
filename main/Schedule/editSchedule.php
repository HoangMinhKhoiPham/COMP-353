<?php
require_once '../../database.php';

$statement = $conn->prepare('SELECT * FROM Schedule WHERE Schedule.employeeID = :employeeID AND Schedule.facilityID = :facilityID AND Schedule.shiftStart = :shiftStart;');
$statement->bindParam(":employeeID", $_GET["employeeID"]);
$statement->bindParam(":facilityID", $_GET["facilityID"]);
$statement->bindParam(":shiftStart", $_GET["shiftStart"]);
$statement->execute(); //executes the query above
$employeeID = (int) $_GET["employeeID"];
$facilityID = (int) $_GET["facilityID"];
$shiftStart = $_GET["shiftStart"];
$success = false;



if (isset($_POST['submit'])) {
    $values = array(
        "employeeID" => $_POST['employeeID'],
        "shiftStart" => $_POST['shiftStart'],
        "facilityID" => $_POST['facilityID'],
        "shiftEnd" => $_POST['shiftEnd'],
    );
    // filter out empty values
    $values = array_filter($values);
    if ($values) {
        $query = "UPDATE Schedule SET ";
        $valuesQuery = array();
        foreach ($values as $key=>$value)
            $valuesQuery[] = "$key=:$key";
        
        $query .= implode(', ', $valuesQuery);
        $query .= ' WHERE employeeID=:employeeID AND facilityID = :facilityID AND shiftStart = :shiftStar;';
        var_dump($query);
        $stmt = $conn->prepare($query);
        foreach ($values as $key=>$value) {
            if ($key == 'employeeID') {
                $stmt->bindParam(":employeeID", $employeeID);
            } else if ($key == 'facilityID') {
                $stmt->bindParam(":facilityID", $facilityID);
            } else if ($key == 'shiftStart') {
                $stmt->bindParam(":shiftStart", $shiftStart);
            } else {
                $stmt->bindValue($key, $value);
            }
        }
    // execute the statement
    if ($stmt->execute() == TRUE) {
        // echo "Entries added";
        $success = true;
    } else {
        var_dump($stmt->errorInfo());
        $success = false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DisplayScheduleTable</title>
    <link rel="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div id="page-container">
        <div id="page-wrap" style="width:100%">
            <?php include '../navBar.php'; ?>
            <?php include '../searchBar.php'; ?>

            <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Update a schedule record </h1>
            <div id="insertEmployeeForm" style="margin-top:10px">

                <form style="width:100%; padding:30px" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="employeeID">Employee ID</label>
                            <input type="text" class="form-control" id="employeeID" name="employeeID" placeholder="employeeID" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="facilityID">Facility ID</label>
                            <input type="text" class="form-control" id="facilityID" name="facilityID" placeholder="facilityID" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-row col-md-6">
                            <label for="shiftStart">shiftStart</label>
                            <input type="text" class="form-control" id="shiftStart" name="shiftStart" placeholder="YYYY/MM/DD HH:MM:SS" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="shiftEnd">shiftEnd</label>
                            <input type="text" class="form-control" id="shiftEnd" name="shiftEnd" placeholder="YYYY/MM/DD HH:MM:SS" required>
                        </div>
                    </div>
                    <button type="submit" value="Submit" name="submit" class="btn btn-primary">Submit</button>
                    <?php
                    if ($success == true) {
                        echo '<h3 style="color:green; text-align:center;font-family:Museosans;transition: color 1s ease-in 1s">Update Successful</h3>';
                    } else {
                        echo "";
                    }
                    ?>
                </form>
                <div>
                    <div>
                        <div id="footer">
                            <?php include '../footer.php'; ?>
                            <div>
                                <div>
</body>

</html>