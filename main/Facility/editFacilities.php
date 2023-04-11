<?php
require_once '../../database.php';

$statement = $conn->prepare('SELECT * FROM Facilities WHERE Facilities.id = :id;');
$statement->bindParam(":id", $_GET["ID"]);
$statement->execute(); //executes the query above
$data = $statement->fetchAll()[0];

$id = (int) $_GET["ID"];
$success = false;

$employeeList = $conn->prepare('SELECT id, firstName, lastName FROM ' . DBNAME . '.Employee order by id');
$employeeList->execute();
$employeeListOption = $employeeList->fetchAll();

if (isset($_POST['submit'])) {
    $values = array(
        "facilityType" => $_POST['facilityType'],
        "capacity" => (int) $_POST['capacity'],
        "phoneNumber" => $_POST['phoneNumber'],
        "facilityName" => $_POST['facilityName'],
        "managerID" => $_POST['managerID'],
        "province" => $_POST['province'],
        "city" => $_POST['city'],
        "address" => $_POST['address'],
        "webAddress" => $_POST['webAddress'],
    );

    // filter out empty values
    $values = array_filter($values);
    if ($values) {
        $query = "UPDATE Facilities SET ";

        $valuesQuery = array();
        foreach ($values as $key=>$value)
            $valuesQuery[] = "$key=:$key";

        $query .= implode(', ', $valuesQuery);
        $query .= ' WHERE id=:id;';
        var_dump($query);
        $stmt = $conn->prepare($query);
        foreach ($values as $key=>$value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindParam(':id', $id);
        // execute the statement
        if ($stmt->execute() == TRUE) {
            // echo "Entries added";
            $success = true;
        } else {
            var_dump($stmt->errorInfo());
            $success = false;
        }
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

        <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Update a facility record </h1>
        <div id="insertEmployeeForm" style="margin-top:10px">

            <form style="width:100%; padding:30px" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="facilityType">Facility Type</label>
                        <input type="text" class="form-control" id="facilityType" name="facilityType" placeholder="facilityType"
                               value="<?php echo $data['facilityType']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="capacity">Capacity</label>
                        <input type="text" class="form-control" id="capacity" name="capacity" placeholder="capacity"
                               value="<?php echo $data['capacity']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-row col-md-6">
                        <label for="phoneNumber">PhoneNumber</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="xxx-xxx-xxxx"
                               value="<?php echo $data['phoneNumber']; ?>"
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="facilityName">Facility Name</label>
                        <input type="text" class="form-control" id="facilityName" name="facilityName" placeholder="Facility Name"
                               value="<?php echo $data['facilityName']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="managerID">manager ID</label>
                        <select class="form-select" aria-label="selectEmployee" id="managerID" name = "managerID" required>
                            <?php
                            if (isset($employeeListOption)) {
                                foreach ($employeeListOption as $emp_elem) {
                                    if ($emp_elem['id'] == $data['managerID']) {
                                        echo "<option selected=\"selected\" value=" . $emp_elem['id'] . ">" . $emp_elem['id'] . ' - '. $emp_elem['firstName'] . ' '. $emp_elem['lastName'] . "</option>";

                                    } else {
                                        echo "<option value=" . $emp_elem['id'] . ">" . $emp_elem['id'] . ' - '. $emp_elem['firstName'] . ' '. $emp_elem['lastName'] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" id="province" name="province" placeholder="province"
                               value="<?php echo $data['province']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="city"
                               value="<?php echo $data['city']; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="address"
                               value="<?php echo $data['address']; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="webAddress">webAddress</label>
                        <input type="text" class="form-control" id="webAddress" name="webAddress" placeholder="webAddress"
                               value="<?php echo $data['webAddress']; ?>">
                    </div>
                </div>
                <button type="submit" value="Submit" name="submit" class="btn btn-primary">Submit</button>
                <?php
                if ($success == true) {
                    echo '<h3 style="color:green; text-align:center;font-family:Museosans;transition: color 1s ease-in 1s">Update Successful!!</h3>';
                    echo "<script> location.href='".BASE_URL."Facility/displayFacilities.php'; </script>";
                    exit();
                } else {
                    echo "";
                }
                ?>
            </form>
            <div>
                <div>
                    <div id="footer">
                        <?php include '../footer.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>