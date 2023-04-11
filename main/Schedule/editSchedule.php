<?php
require_once '../../database.php';

$statement = $conn->prepare('SELECT * FROM ' . DBNAME . '.Schedule WHERE Schedule.employeeID = :employeeID AND Schedule.facilityID = :facilityID AND Schedule.shiftStart = :shiftStart;');
$statement->bindParam(":employeeID", $employeeID);
$statement->bindParam(":facilityID", $facilityID);
$statement->bindParam(":shiftStart", $shiftStart);
$statement->execute(); //executes the query above
$employeeID = $_GET["employeeID"];
$facilityID = $_GET["facilityID"];
$shiftStart = $_GET["shiftStart"];

if (isset($_POST['submit'])) {
    $employeeID = $_POST['employeeID'];
    $facilityID = $_POST['facilityID'];
    $shiftStart = $_POST['shiftStart'];
    $shiftEnd = $_POST['shiftEnd'];

    // bind the parameters
    $sql = "UPDATE " . DBNAME . ".Schedule 
        SET 
        shiftEnd = :shiftEnd,
        WHERE employeeID = :employeeID AND
        facilityID = :facilityID AND
        shiftStart = :shiftStart";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":shiftEnd", $shiftEnd);
    $stmt->bindParam(":employeeID", $employeeID);
    $stmt->bindParam(":facilityID", $facilityID);
    $stmt->bindParam(":shiftStart", $shiftStart);

    // execute the statement
    if ($stmt->execute() == TRUE) {
        // echo "Entries added";
        $success = true;
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
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