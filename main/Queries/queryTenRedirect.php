<?php 
require_once '../../database.php';
$statement = $conn->prepare('SELECT * FROM '.DBNAME.'.logTable WHERE sender = :tempo; ORDER BY date ASC');
$statement->bindParam(":tempo", $_GET["facilityName"]);
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
              <?php include '../navBar.php';?>              
              <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> List of Emails by Facility (Query 10) </h1>
              <div class="table-condensed">
              <table class="table" style= "padding:20px;">
                <thead>
                  <tr class="hoverUpon">
                    <th scope="col" style="font-size:15px">emailID</th>
                    <th scope="col" style="font-size:15px">sender</th>
                    <th scope="col" style="font-size:15px">receiver</th>
                    <th scope="col" style="font-size:15px">email</th>
                    <th scope="col" style="font-size:15px">subject</th>
                    <th scope="col" style="font-size:15px">date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr class="hoverUpon">
                      <td scope = "row" style="font-size:15px"><?= $row["emailID"] ?></td>
                      <td scope = "row" style="font-size:15px"><?= $row["sender"] ?></td>
                      <td scope = "row" style="font-size:15px"><?= $row["receiver"] ?></td>
                      <td scope = "row" style="font-size:15px"><?= $row["email"] ?></td>
                      <td scope = "row" style="font-size:15px"><?= $row["subject"] ?></td>
                      <td scope = "row" style="font-size:15px"><?= $row["date"] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div class="text-center">
              <button class="btn btn-outline-success my-2 my-sm-0" onclick="location.href='queryTen.php'" type = "button">Back</button>
                <div>
              <div>
                <div id = "footer">
              <?php include 'footer.php';?>
              <div>
          <div>
      <div>
</body>
</html>