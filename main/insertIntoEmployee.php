<?php
require_once '../database.php';

$maxIDFetch = $conn->prepare('SELECT max(Employee.ID) FROM comp353proj.Employee');
$maxIDFetch->execute();
$maxEmployeeID = $maxIDFetch->fetchColumn();
$id = $maxEmployeeID + 1;

// if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["dateOfBirth"]) && isset($_POST["medicareCardNumber"]) && 
// isset($_POST["employeeRole"]) && isset($_POST["telephoneNumber"]) && isset($_POST["citizenship"]) && isset($_POST["email"]) && 
// isset($_POST["country"]) && isset($_POST["province"]) && isset($_POST["city"]) && isset($_POST["address"]) && 
// isset($_POST["postalCode"])) {
//     $employee = $conn->prepare("INSERT INTO comp353proj.Employee (ID, firstName, lastName, 
//     dateOfBirth, medicareCardNumber, employeeRole, telephoneNumber, citizenship, email, 
//     country, province, city, address, postalCode) VALUES (:ID, :firstName, :lastName, 
//     :dateOfBirth, :medicareCardNumber, :employeeRole, :telephoneNumber, :citizenship, :email, 
//     :country, :province, :city, :address, :postalCode)");

//     $employee->bindParam(':ID', $id);
//     $employee->bindParam(':firstName', $_POST["firstName"]);
//     $employee->bindParam(':lastName', $_POST["lastName"]);
//     $employee->bindParam(':dateOfBirth', $_POST["dateOfBirth"]);
//     $employee->bindParam(':medicareCardNumber', $_POST["medicareCardNumber"]);
//     $employee->bindParam(':employeeRole', $_POST["employeeRole"]);
//     $employee->bindParam(':telephoneNumber', $_POST["telephoneNumber"]);
//     $employee->bindParam(':citizenship', $_POST["citizenship"]);
//     $employee->bindParam(':email', $_POST["email"]);
//     $employee->bindParam(':country', $_POST["country"]);
//     $employee->bindParam(':province', $_POST["province"]);
//     $employee->bindParam(':city', $_POST["city"]);
//     $employee->bindParam(':address', $_POST["address"]);
//     $employee->bindParam(':postalCode', $_POST["postalCode"]);

//     if($employee->execute()) {
//         header("location: .");
//     } 
// }

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
    $sql = "INSERT INTO comp353proj.Employee (ID, firstName, lastName, dateOfBirth,medicareCardNumber, employeeRole, telephoneNumber, citizenship, email, country, province, city, address, postalCode) VALUES ($id, '$firstName', '$lastName', '$dateOfBirth', '$medicareCardNumber', '$employeeRole', '$telephoneNumber', '$citizenship', '$email', '$country', '$province', '$city', '$address', '$postalCode');";
    // mysqli_query($conn, $sql)

    // execute the statement
    if($conn->query($sql) == TRUE){
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
              
              <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Insert an employee record </h1>
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
                        <option value="receptionist">Receptionist</option>
                        <option value="pharmacist">Pharmacist</option>
                        <option value="security_personnel">Security personnel</option>
                        <option value="cashier">Cashier</option>
                        <option value="doctor">Doctor</option>
                        <option value="nurse">Nurse</option>
                        <option value="administrative_personnel">Administrative personnel</option>
                        <option selected value="regular_employee">Regular employee</option>
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
                        echo '<h3 style="color:green; text-align:center;font-family:Museosans;transition: color 1s ease-in 1s">Entry Added</h3>';
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