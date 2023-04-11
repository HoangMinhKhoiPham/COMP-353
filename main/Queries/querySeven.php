<?php
require_once '../../database.php';
$optionFetch = $conn->prepare('SELECT id, facilityName FROM ' . DBNAME . '.Facilities order by id');
$optionFetch->execute();
$options = $optionFetch->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DisplayFacilityTable</title>
    <link rel="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

<div id="page-container">
    <div id="page-wrap">
        <?php include_once '../navBar.php'; ?>
        <div class="container">
            <form class="form" action="getEmployee.php" method="GET">
                <label class="md-4" style="margin-top: 15px" for="facility">Which facility would you like to see a list of all the employees currently working there?</label>
                <div class="form-group col-md-6">
                    <label for="facilityID">Facility ID</label>
                    <select class="form-select" aria-label="selectFacility" id="facilityID" name = "facilityID" required>
                        <?php
                        if (isset($options)) {
                            foreach ($options as $option) {
                                echo "<option value=" . $option['id'] . ">" . $option['id'] . ' - '. $option['facilityName'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <button style="margin: 10px" type="submit" class="btn btn-primary my-1">Submit</button>
            </form>
        </div>
        <div id="footer">
            <?php include_once '../footer.php'; ?>
        </div>
    </div>
</div>
</body>

</html>