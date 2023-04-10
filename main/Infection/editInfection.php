<?php
require_once '../../database.php';
if (isset($conn)) {
    $optionFetch = $conn->prepare('SELECT * FROM '.DBNAME.'.Infection order by infectionID');
    $optionFetch->execute();
    $options = $optionFetch->fetchAll();

    $statement = $conn->prepare('SELECT * FROM '.DBNAME.'.HasCaught WHERE HasCaught.infectionCaseID = :infectionCaseID;');
    $statement->bindParam(":infectionCaseID", $_GET["ID"]);
    $statement->execute(); //executes the query above
    $id = $_GET["ID"];

    $current_case = $statement->fetchAll();

    if (isset($_POST['submit'])) {
        $dateOfInfection = $_POST['dateOfInfection'];
        $employeeID = $_POST['employeeID'];
        $infectionID = $_POST['infectionID'];
        $infectionCaseID = $id;

        $infectionID = intval($infectionID);

        // bind the parameters
        $sql = "UPDATE ".DBNAME.".HasCaught 
        SET
        dateOfInfection = :dateOfInfection,
        employeeID = :employeeID,
        infectionID = :infectionID
        WHERE infectionCaseID = :infectionCaseID;";

        error_log($sql);

        $stmt = $conn->prepare($sql);
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
    <title>DisplayEmployeesTable</title>
    <link rel ="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<div id = "page-container">
    <div id = "page-wrap" style="width:100%">
        <?php include '../navBar.php';?>
        <?php include '../searchBar.php';?>

        <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Update Infection Case </h1>
        <div id = "insertInfectionForm" style="margin-top:10px">
            <form style="width:100%; padding:30px" method="POST" >
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="typeOfInfection">Employee ID</label>
                        <label for="employeeID"></label><input type="number" min="0" class="form-control" id="employeeID" name = "employeeID"
                                                               placeholder="employeeID"
                                                               value="<?php echo isset($current_case[0]['employeeID']) ? ($current_case[0]['employeeID']) : "" ?>"
                                                               required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="infectionCaseID">Infection Case ID</label>
                        <input type="text" class="form-control" id="infectionCaseID" name = "infectionCaseID"
                               placeholder="infectionCaseID"
                               value = "<?php echo isset($current_case[0]['infectionCaseID']) ? ($current_case[0]['infectionCaseID']) : "" ?>"
                               disabled
                               required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="infectionID">Type of Infection</label>
                        <select class="form-select" aria-label="selectTypeOfInfection" id="infectionID" name = "infectionID" required>
                            <?php
                            if (isset($options)) {
                                foreach ($options as $option) {
                                    if ($option['infectionID'] == $current_case[0]['infectionID']) {
                                        echo "<option selected=\"selected\" value=" . $option['infectionID'] . ">" . $option['typeOfInfection'] . "</option>";

                                    } else {
                                        echo "<option value=" . $option['infectionID'] . ">" . $option['typeOfInfection'] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dateOfInfection">Date of Infection</label>
                        <input type="date" class="form-control" id="dateOfInfection"
                               name = "dateOfInfection"
                               placeholder="YYYY-MM-DD"
                               value="<?php echo isset($current_case[0]['dateOfInfection']) ? ($current_case[0]['dateOfInfection']) : "" ?>"
                               required>
                    </div>
                </div>
                <button type="submit" value="Submit" name = "submit" class="btn btn-primary">Submit</button>
                <?php
                if (isset($success) && $success) {
                    echo '<h3 style="color:green; text-align:center;font-family:Museosans;transition: color 1s ease-in 1s">Entry Updated</h3>';
                    echo "<script> location.href='".BASE_URL."Infection/displayInfection.php'; </script>";
                    exit();
                } else {
                    echo "";
                }
                ?>
        </div>
        <div id = "footer"><?php include '../footer.php';?></div>
    </div>

</body>
</html>
