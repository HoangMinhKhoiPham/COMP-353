<?php 
require_once '../../database.php';
if (isset($_GET['facility'])) {
    $facility = $_GET['facility'];
    $statement = $conn->prepare("SELECT 
firstName,lastName,startDate,employeeRole,dateOfBirth,medicareCardNumber,
telephoneNumber,address,city,province,postalCode,
citizenship,email
FROM Employee NATURAL JOIN
(SELECT employeeID AS ID, startDate FROM WorksAt
WHERE facilityID = (SELECT ID FROM  Facilities WHERE
            facilityName = '".$facility."')
        AND endDate IS NULL) AS employeeIDList ORDER BY employeeRole, firstName, lastName;");
    $statement->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DisplayFacilityTable</title>
    <link rel ="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

  <div id = "page-container">
          <div id = "page-wrap">
              <?php include '../navBar.php';?>
              
              <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> List of Employees In <?php echo $_GET['facility'] ?> in Quebec (Query 7) </h1>
              <div class="table-condensed">
              <table class="table" style= "padding:20px;margin:20px; width:95%">
                <thead>
                  <tr class="hoverUpon">
                    <th scope="col" style="font-size: 15px" class = "px-5">firstName</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">lastName</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">dateOfBirth</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">medicareCardNumber</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">telephoneNumber</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">address</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">city</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">province</th>  
                    <th scope="col" style="font-size: 15px" class = "px-5">postalCode</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">citizenship</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">email</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">employeeRole</th>
                    <th scope="col" style="font-size: 15px" class = "px-5">startDate</th>
                </tr>
                </thead>
                <tbody>
                  <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr class="hoverUpon">
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["firstName"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["lastName"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["dateOfBirth"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["medicareCardNumber"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["telephoneNumber"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["address"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["city"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["province"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["postalCode"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["citizenship"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["email"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["employeeRole"] ?></td>
                      <td scope = "row" style="font-size: 15px" class = "px-5"><?= $row["startDate"] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div>
                <div id = "footer">
              <?php include '../footer.php';?>
              <div>
          <div>
      <div>
</body>
</html>