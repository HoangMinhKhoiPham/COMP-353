<?php
require_once '../../database.php';

$statement = $conn->prepare('SELECT * FROM Vaccine WHERE Vaccine.vaccineID = :vaccineID;');
$statement->bindParam(":vaccineID", $_GET["ID"]);
$statement->execute(); //executes the query above
$vaccineID = (int) $_GET["ID"];
$success = false;

if (isset($_POST['submit'])) {
    $values = array(
        $vaccineType = $_POST['vaccineType'],
        $timeBeforeExpirationInMonth = $_POST['timeBeforeExpirationInMonth'],
    );
    // filter out empty values
    $values = array_filter($values);

    if ($values) {
        $query = "UPDATE Vaccine SET ";

        $valuesQuery = array();
        foreach ($values as $key=>$value)
            $valuesQuery[] = "$key=:$key";
        
        $query .= implode(', ', $valuesQuery);
        $query .= ' WHERE vaccineID=:vaccineID;';
        var_dump($query);
        $stmt = $conn->prepare($query);
        foreach ($values as $key=>$value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindParam(':vaccineID', $vaccineID);
    // execute the statement
    if ($stmt->execute()) {
        $success = true;
    } else {
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

            <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Update Vaccination Case </h1>
            <div id="insertInfectionForm" style="margin-top:10px">
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
                    <button type="submit" value="Submit" name="submit" class="btn btn-primary">Submit</button>
                    <?php
                    if ($success == true) {
                        echo '<h3 style="color:green; text-align:center;font-family:Museosans;transition: color 1s ease-in 1s">Update Successful</h3>';
                    } else {
                        echo "";
                    }
                    ?>
            </div>
            <div id="footer"><?php include '../footer.php'; ?></div>
        </div>

</body>

</html>