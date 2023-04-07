<?php
require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM comp353proj.Employee WHERE Employee.ID = :EmployeeID;');
$statement->bindParam(":EmployeeID", $_GET["ID"]);
$statement->execute(); //executes the query above
$id = $_GET["ID"];

if(isset($_POST['submit'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $medicareCardNumber = $_POST['medicareCardNumber'];
    $employeeRole = $_POST['employeeRole'];
    $telephoneNumber = $_POST['telephoneNumber'];
    $citizenship = $_POST['citizenship'];
    $email = $_POST['email'];
    $country = "Canada";
    $province = $_POST['province'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $postalCode = $_POST['postalCode'];

    // bind the parameters
    $sql = "UPDATE comp353proj.Employee 
        SET 
        firstName = :firstName,
        lastName = :lastName,
        dateOfBirth = :dateOfBirth,
        medicareCardNumber = :medicareCardNumber,
        employeeRole = :employeeRole,
        telephoneNumber = :telephoneNumber,
        citizenship = :citizenship,
        email = :email,
        country = :country,
        province = :province,
        city = :city,
        address = :address,
        postalCode = :postalCode
        WHERE ID = :id;";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":firstName", $firstName);
    $stmt->bindParam(":lastName", $lastName);
    $stmt->bindParam(":dateOfBirth", $dateOfBirth);
    $stmt->bindParam(":medicareCardNumber", $medicareCardNumber);
    $stmt->bindParam(":employeeRole", $employeeRole);
    $stmt->bindParam(":telephoneNumber", $telephoneNumber);
    $stmt->bindParam(":citizenship", $citizenship);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":country", $country);
    $stmt->bindParam(":province", $province);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":postalCode", $postalCode);
    $stmt->bindParam(":id", $id);

    // execute the statement
    if($stmt->execute() == TRUE){
        // echo "Entries added";
        $success = true;
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>DisplayEmployeesTable</title>
    <link rel ="stylesheet" href="displayEmployees.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

  <div id = "page-container">
          <div id = "page-wrap" style="width:100%">
              <?php include 'navBar.php';?>
              <?php include 'searchBar.php';?>
              
              <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Update an employee record </h1>
              <div id = "insertEmployeeForm" style="margin-top:10px">

              <form style="width:100%; padding:30px" method="POST" >
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name = "firstName" placeholder="FirstName" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name = "lastName" placeholder="LastName" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="dateOfBirth">Date Of Birth (YYYY-MM-DD)</label>
                        <input type="text" class="form-control" id="dateOfBirth" name = "dateOfBirth" placeholder="YYYY-MM-DD" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="medicareCardNumber">MedicareCardNumber</label>
                        <input type="text" class="form-control" id="medicareCardNumber" name = "medicareCardNumber" placeholder="MedicareCardNumber" required>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="employeeRole">Employee Role</label>
                    <select class="form-select" aria-label="Default select example"id="employeeRole" name = "employeeRole" required>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Pharmacist">Pharmacist</option>
                        <option value="Security personnel">Security personnel</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Administrative personnel">Administrative personnel</option>
                        <option selected value="Regular employee">Regular employee</option>
                    </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telephoneNumber">Telephone Number</label>
                        <input type="text" class="form-control" id="telephoneNumber" name = "telephoneNumber" placeholder="xxx-xxx-xxxx" required>
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
                    if ($success == true) {
                        echo '<h3 style="color:green; text-align:center;font-family:Museosans;transition: color 1s ease-in 1s">Update Successful</h3>';
                    }
                    else {
                        echo "";
                    }
                ?>
            </form>
                <div>
            <div>
          <div id = "footer">
              <?php include 'footer.php';?>
          <div>
      <div>
</body>
</html>