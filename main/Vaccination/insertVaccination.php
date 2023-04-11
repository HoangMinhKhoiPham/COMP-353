<?php
require_once '../../database.php';

$maxIDFetch = $conn->prepare('SELECT max(Vaccine.vaccineID) FROM Vaccine');
$maxIDFetch->execute();
$maxVaccineID = $maxIDFetch->fetchColumn();
$id = $maxVaccineID + 1;

if (isset($_POST['submit'])) {
    $vaccineType = $_POST['vaccineType'];
    $timeBeforeExpirationInMonth = $_POST['timeBeforeExpirationInMonth'];

    // prepare the statement
    $sql = "INSERT INTO Vaccine (vaccineType, timeBeforeExpirationInMonth) VALUES ( :vaccineType, :timeBeforeExpirationInMonth)";
    $stmt = $conn->prepare($sql);

    // bind the parameters
    $stmt->bindParam(":vaccineType", $vaccineType);
    $stmt->bindParam(":timeBeforeExpirationInMonth", $timeBeforeExpirationInMonth);

    // execute the statement
    if ($stmt->execute()) {
        // echo "Entries added";
        $success = true;
    } else {
        // echo "Error: " . $stmt->errorInfo()[2];
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
    <title>DisplayVaccineTable</title>
    <link rel="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div id="page-container">
        <div id="page-wrap" style="width:100%">
            <?php include '../navBar.php'; ?>
            <?php include '../searchBar.php'; ?>

            <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Insert a facility record </h1>
            <div id="insertEmployeeForm" style="margin-top:10px">

                <form style="width:100%; padding:30px" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="vaccineID">vaccine ID</label>
                            <input type="text" class="form-control" id="vaccineID" name="vaccineID" placeholder="vaccineID" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="vaccitimeBeforeExpirationInMonth">Time Before Expiration In Month</label>
                            <input type="text" class="form-control" id="timeBeforeExpirationInMonth" name="timeBeforeExpirationInMonth" placeholder="timeBeforeExpirationInMonth" required>
                        </div>
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