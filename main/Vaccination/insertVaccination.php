<?php
require_once '../../database.php';
$success = false;

if (isset($conn)) {
    $optionFetch = $conn->prepare('SELECT * FROM '.DBNAME.'.Vaccine order by vaccineID');
    $optionFetch->execute();
    $options = $optionFetch->fetchAll();

    $employeeList = $conn->prepare('SELECT id, firstName, lastName FROM ' . DBNAME . '.Employee order by id');
    $employeeList->execute();
    $employeeListOption = $employeeList->fetchAll();

    if (isset($_POST['submit'])) {
        echo print_r($_POST, true);
        $dateOfVaccination = $_POST['dateOfVaccination'];
        $employeeID = $_POST['employeeID'];
        $vaccineID = $_POST['vaccineID'];
        $vaccineDoseID = $_POST['vaccineDoseID'];

        $vaccineID = intval($vaccineID);

        $sql = "INSERT INTO " . DBNAME . ".hasTaken (dateOfVaccination, employeeID, vaccineID, vaccineDoseID)
            VALUES (:dateOfVaccination, :employeeID, :vaccineID, :vaccineDoseID)";

        echo $sql;

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dateOfVaccination', $dateOfVaccination);
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->bindParam(':vaccineID', $vaccineID);
        $stmt->bindParam(':vaccineDoseID', $vaccineDoseID);

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
    <title>Log A New Vaccination Case</title>
    <link rel="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

<div id="page-container">
    <div id="page-wrap" style="width:100%">
        <?php include_once '../navBar.php'; ?>
        <?php include_once '../searchBar.php'; ?>

        <h1 style='text-align:center; font-family:Museosans,serif;serif margin-top:10px'>Log A New Vaccination Case</h1>
        <div id = "EditVaccinationForm" style="margin-top:10px">
            <form style="width:100%; padding:30px" method="POST" >
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
                        <label for="vaccineDoseID">Vaccine Dose ID</label>
                        <input type="text" class="form-control" id="vaccineDoseID" name = "vaccineDoseID"
                               placeholder="vaccineDoseID"
                               required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="vaccineID">Type Of Vaccine</label>
                        <select class="form-select" aria-label="selectTypeOfInfection" id="vaccineID" name = "vaccineID" required>
                            <?php
                            if (isset($options)) {
                                foreach ($options as $option) {
                                    echo "<option value=" . $option['vaccineID'] . ">" . $option['vaccineType'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dateOfVaccination">Date of Vaccination</label>
                        <input type="date" class="form-control" id="dateOfVaccination"
                               name = "dateOfVaccination"
                               placeholder="YYYY-MM-DD"
                               required>
                    </div>
                </div>
                <button type="submit" value="Submit" name = "submit" class="btn btn-primary">Submit</button>
                <?php
                if (isset($success) && $success) {
                    echo '<h3 style="color:green; text-align:center;font-family:Museosans;transition: color 1s ease-in 1s">Entry Updated</h3>';
                    echo "<script> location.href='".BASE_URL."Vaccination/displayVaccination.php'; </script>";
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
            </div>
        </div>
    </div>
</div>
</body>
</html>
