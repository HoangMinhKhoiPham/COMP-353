<?php require_once '../database.php';
$statement = $conn->prepare('SELECT * FROM comp353proj.Facility');
$statement->execute(); //executes the query above
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
          <div id = "page-wrap;">
              <?php include 'navBar.php';?>
              <?php include 'searchBar.php';?>
              
              <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Employee </h1>
              <div class="table-responsive" >
              <table class="table" style="margin:10px">
                <thead>
                  <tr class="hoverUpon">
                    <th scope="col" style="font-size:small; width:0">#</th>
                    <th scope="col" style="font-size:small; width:0">firstName</th>
                    <th scope="col" style="font-size:small; width:0">lastName</th>
                    <th scope="col" style="font-size:small; width:0">dateOfBirth</th>
                    <th scope="col" style="font-size:small; width:0">medicareCardNumber</th>
                    <th scope="col" style="font-size:small; width:0">employeeRole</th>
                    <th scope="col" style="font-size:small; width:0">telephoneNumber</th>
                    <th scope="col" style="font-size:small; width:0">citizenship</th>
                    <th scope="col" style="font-size:small; width:0">email</th>
                    <th scope="col" style="font-size:small; width:0">country</th>
                    <th scope="col" style="font-size:small; width:0">province</th>
                    <th scope="col" style="font-size:small; width:0">city</th>
                    <th scope="col" style="font-size:small; width:0">address</th>
                    <th scope="col" style="font-size:small; width:0">postalCode</th>
                    <th scope="col" style="font-size:small; width:0">options</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr class="hoverUpon">
                      <td scope = "row" style="font-size:small"><?= $row["ID"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["firstName"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["lastName"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["dateOfBirth"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["medicareCardNumber"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["employeeRole"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["telephoneNumber"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["citizenship"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["email"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["country"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["province"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["city"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["address"] ?></td>
                      <td scope = "row" style="font-size:small"><?= $row["postalCode"] ?></td>
                      <td>
                        <a href="#" style="font-size:small"> Delete </a>
                        <a href="#" style="font-size:small"> Edit </a>
                      </td>
                    <tr>
                  <?php } ?>
                </tbody>
              </table>
              <div>
          <div>
          <div id = "footer">
              <?php include 'footer.php';?>
          <div>
      <div>
</body>
</html>