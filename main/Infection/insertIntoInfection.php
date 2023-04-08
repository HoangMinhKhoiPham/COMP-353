<?php
require_once '../../database.php';
$success = false;
if (isset($conn)) {
    $maxIDFetch = $conn->prepare('SELECT max(' . DBNAME . '.Infection.infectionID) FROM ' . DBNAME . '.Infection');
    $maxIDFetch->execute();
    $maxInfectionID = $maxIDFetch->fetchColumn();
    $id = $maxInfectionID + 1;


    if (isset($_POST['submit'])) {
        $typeOfInfection = $_POST['lastName'];


        // prepare the statement
        $sql = "INSERT INTO " . DBNAME . ".Infection (infectionID, typeOfInfection) VALUES (:infectionID, :typeOfInfection)";
        $stmt = $conn->prepare($sql);

        // bind the parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':typeOfInfection', $typeOfInfection);


        // execute the statement
        if ($stmt->execute()) {
            // echo "Entries added";
            $success = true;
        } else {
            // echo "Error: " . $stmt->errorInfo()[2];
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
    <link rel ="stylesheet" href="displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

  <div id = "page-container">
          <div id = "page-wrap" style="width:100%">
              <?php include_once '../navBar.php';?>
              <?php include_once '../searchBar.php';?>
              
              <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Insert an employee record </h1>
              <div id = "insertEmployeeForm" style="margin-top:10px">

              <form style="width:100%; padding:30px" method="POST" >
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name = "firstName" placeholder="FirstName" required>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name = "lastName" placeholder="LastName" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dateOfBirth">Date Of Birth (YYYY-MM-DD)</label>
                        <input type="text" class="form-control" id="dateOfBirth" name = "dateOfBirth" placeholder="YYYY-MM-DD" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="citizenship">Citizenship</label>
                        <input type="text" class="form-control" id="citizenship" name = "citizenship" placeholder="Citizenship" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name = "email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name = "country" value = "Canada" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                    <label for="province">Province</label>
                    <input type="text" class="form-control" id="province" name = "province" placeholder = "Province" required>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name = "city" placeholder = "City" required>
                    </div>                    
                    <div class="form-group col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name = "address" placeholder = "Address" required>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="postalCode">Postal Code</label>
                    <input type="text" class="form-control" id="postalCode" name = "postalCode" placeholder = "Postal Code">
                    </div>
                </div>
                <button type="submit" value="Submit" name = "submit" class="btn btn-primary">Submit</button>
                <?php
                if (isset($success) && $success == true) {
                    echo '<h3 style="color:green; text-align:center;font-family:Museosans;transition: color 1s ease-in 1s">Entry Added</h3>';
                } else {
                    echo "";
                }
                ?>
            </form>
                <div>
            <div>
          <div id = "footer">
              <?php include_once '../footer.php';?>
          <div>
      <div>
</body>
</html>
