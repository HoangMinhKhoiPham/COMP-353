<?php
require_once '../../database.php';
$success = false;
if (isset($conn)) {
    $optionFetch = $conn->prepare('SELECT * FROM ' . DBNAME . '.Infection order by infectionID');
    $optionFetch->execute();
    $options = $optionFetch->fetchAll();

    $employeeList = $conn->prepare('SELECT id, firstName, lastName FROM ' . DBNAME . '.Employee order by id');
    $employeeList->execute();
    $employeeListOption = $employeeList->fetchAll();


    if (isset($_POST['submit'])) {
        $dateOfInfection = $_POST['dateOfInfection'];
        $employeeID = $_POST['employeeID'];
        $infectionID = $_POST['infectionID'];
        $infectionCaseID = $_POST['infectionCaseID'];

        $infectionID = intval($infectionID);


        // prepare the statement
        $sql = "INSERT INTO " . DBNAME . ".HasCaught (dateOfInfection, employeeID, infectionID, infectionCaseID)
            VALUES (:dateOfInfection, :employeeID, :infectionID, :infectionCaseID)";
        $stmt = $conn->prepare($sql);

        // bind the parameters
        $stmt->bindParam(':dateOfInfection', $dateOfInfection);
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->bindParam(':infectionID', $infectionID);
        $stmt->bindParam(':infectionCaseID', $infectionCaseID);


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
    <title>Log A New Infection Case</title>
    <link rel="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div id="page-container">
        <div id="page-wrap" style="width:100%">
            <?php include_once '../navBar.php'; ?>
            <?php include_once '../searchBar.php'; ?>

            <h1 style='text-align:center; font-family:Museosans,serif;serif margin-top:10px'>Log A New Infection Case</h1>
            <div id="insertInfectionForm" style="margin-top:10px">
                <form style="width:100%; padding:30px" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="employeeID">Employee ID</label>
                            <select class="form-select" aria-label="selectEmployee" id="employeeID" name = "employeeID" required>
                                <?php
                                if (isset($employeeListOption)) {
                                    foreach ($employeeListOption as $emp_elem) {
                                        echo "<option value=" . $emp_elem['id'] . ">" . $emp_elem['id'] . ' - '. $emp_elem['firstName'] . ' '. $emp_elem['lastName'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="infectionCaseID">Infection Case ID</label>
                            <input type="text" class="form-control" id="infectionCaseID" name="infectionCaseID" placeholder="infectionCaseID" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="infectionID">Type of Infection</label>
                            <select class="form-select" aria-label="selectTypeOfInfection" id="infectionID" name="infectionID" required>
                                <?php
                                if (isset($options)) {
                                    foreach ($options as $option) {
                                        echo "<option value=" . $option['infectionID'] . ">" . $option['typeOfInfection'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="dateOfInfection">Date of Infection</label>
                            <input type="date" class="form-control" id="dateOfInfection" name="dateOfInfection" placeholder="YYYY-MM-DD" required>
                        </div>
                    </div>
                    <button type="submit" value="Submit" name="submit" class="btn btn-primary">Submit</button>
                    <?php
                    if (isset($success) && $success) {
                        echo '<h3 style="color:green; text-align:center;font-family:Museosans;serif transition: color 1s ease-in 1s">Entry Added</h3>';
                        echo "<script> location.href='" . BASE_URL . "Infection/displayInfection.php'; </script>";
                        exit();
                    } else {
                        echo "";
                    }
                    ?>
            </div>
        </div>
        <div>
            <div>
                <div id="footer">
                    <?php include_once '../footer.php'; ?>
                    <div>
                        <div>
</body>

</html>