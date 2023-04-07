<?php require_once '../database.php';
$statement = $conn->prepare('SELECT f.*, count(wa.employeeID) as numberOfEmployees
FROM comp353proj.Facilities f, comp353proj.WorksAt wa 
where f.id = wa.facilityID
group by f.id
ORDER BY f.province ASC, f.city ASC, f.facilityType ASC, numberOfEmployees ASC;'); // to change to school database name
$statement->execute(); //executes the query above
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DisplayFacilityTable</title>
    <link rel ="stylesheet" href="displayEmployees.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

  <div id = "page-container">
          <div id = "page-wrap">
              <?php include 'navBar.php';?>
              <?php include 'searchBar.php';?>
              
              <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Facility (Query 6) </h1>
              <div class="table-condensed">
              <table class="table" style= "padding:20px;">
                <thead>
                  <tr class="hoverUpon">
                    <th scope="col" style="font-size:10px">#</th>
                    <th scope="col" style="font-size:10px">facilityType</th>
                    <th scope="col" style="font-size:10px">capacity</th>
                    <th scope="col" style="font-size:10px">phoneNumber</th>
                    <th scope="col" style="font-size:10px">facilityName</th>
                    <th scope="col" style="font-size:10px">managerID</th>
                    <th scope="col" style="font-size:10px">province</th>
                    <th scope="col" style="font-size:10px">city</th>
                    <th scope="col" style="font-size:10px">address</th>
                    <th scope="col" style="font-size:10px">webAddress</th>
                    <th scope="col" style="font-size:10px">numberOfEmployees</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr class="hoverUpon">
                      <td scope = "row" style="font-size:10px"><?= $row["id"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["facilityType"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["capacity"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["phoneNumber"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["facilityName"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["managerID"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["province"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["city"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["address"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["webAddress"] ?></td>
                      <td scope = "row" style="font-size:10px"><?= $row["numberOfEmployees"] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div>
              <?php include 'footer.php';?>
          <div>
      <div>
</body>
</html>