<?php
require_once '../../database.php';

$success = false;
if (isset($conn)) {
    $optionFetch = $conn->prepare('SELECT * FROM ' . DBNAME . '.Schedule');
    $optionFetch->execute();
    $options = $optionFetch->fetchAll();

    if (isset($_POST['submit'])) {
        $employeeID = $_POST['employeeID'];
        $facilityID = $_POST['facilityID'];
        $shiftStart = $_POST['shiftStart'];
        $shiftEnd = $_POST['shiftEnd'];

        // prepare the statement
        $sql = "INSERT INTO " . DBNAME . ".Schedule (employeeID, facilityID, shiftStart, shiftEnd)  
            VALUES (:employeeID, :facilityID, :shiftStart, :shiftEnd)";
        $stmt = $conn->prepare($sql);

        // bind the parameters
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->bindParam(':facilityID', $facilityID);
        $stmt->bindParam(':shiftStart', $shiftStart);
        $stmt->bindParam(':shiftEnd', $shiftEnd);


        // execute the statement
        if ($stmt->execute()) {
            $success = true;
        } else {
            $success = false;
        }
    }
} else {
    print_r("DBO CONN ERROR");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DisplaySchedulesTable</title>
    <link rel="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div id="page-container">
        <div id="page-wrap" style="width:100%">
            <?php include '../navBar.php'; ?>
            <?php include '../searchBar.php'; ?>

            <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Insert a schedule record </h1>
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
                    if (isset($success) && $success) {
                        echo '<h3 style="color:green; text-align:center;font-family:Museosans;transition: color 1s ease-in 1s">Entry Added</h3>';
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