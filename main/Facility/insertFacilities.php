<?php
require_once '../../database.php';

$maxIDFetch = $conn->prepare('SELECT max(Facilities.id) FROM Facilities');
$maxIDFetch->execute();
$maxFacilitiesID = $maxIDFetch->fetchColumn();
$id = $maxFacilitiesID + 1;

if (isset($_POST['submit'])) {
    $facilityType = $_POST['facilityType'];
    $capacity = $_POST['capacity'];
    $phoneNumber = $_POST['phoneNumber'];
    $facilityName = $_POST['facilityName'];
    // $managerID = $_POST['managerID'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $webAddress = $_POST['webAddress'];

    // prepare the statement
    $sql = "INSERT INTO facilities (facilityType, capacity, phoneNumber,facilityName, province, city, address, webAddress) VALUES (:facilityType, :capacity, :phoneNumber, :facilityName, :province, :city, :address, :webAddress)";
    $stmt = $conn->prepare($sql);

    // bind the parameters
    $stmt->bindParam(":facilityType", $facilityType);
    $stmt->bindParam(":capacity", $capacity);
    $stmt->bindParam(":phoneNumber", $phoneNumber);
    $stmt->bindParam(":facilityName", $facilityName);
    $stmt->bindParam(":province", $province);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":webAddress", $webAddress);

    // execute the statement

    if ($stmt->execute()) {
        // echo "Entries added";
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
    <title>DisplayFacilitiesTable</title>
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
                            <label for="facilityType">Facility Type</label>
                            <input type="text" class="form-control" id="facilityType" name="facilityType" placeholder="facilityType" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="capacity">Capacity</label>
                            <input type="text" class="form-control" id="capacity" name="capacity" placeholder="capacity" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-row col-md-6">
                            <label for="phoneNumber">PhoneNumber</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="xxx-xxx-xxxx" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="facilityName">Facility Name</label>
                            <input type="text" class="form-control" id="facilityName" name="facilityName" placeholder="facilityName" required>
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <label for="managerID">managerID</label>
                            <input type="text" class="form-control" id="managerID" name="managerID" placeholder="managerID" required>
                        </div> -->
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province" placeholder="province" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="city" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="address" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="webAddress">webAddress</label>
                            <input type="text" class="form-control" id="webAddress" name="webAddress" value="webAddress" required>
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