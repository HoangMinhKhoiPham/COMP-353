<?php
require_once '../../database.php';
/*
 * For a given employee, get the details of all the schedules she/he has been
 * scheduled during a specific period of time. Details include facility name, day
 * of the year, start time and end time. Results should be displayed sorted in
 * ascending order by facility name, then by day of the year, the by start time.
 */
if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM ' . DBNAME . '.Employee');
    $statement->execute(); //executes the query above
} else {
    print_r("DB Connection error");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query 8</title>
    <link rel ="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"
</head>
<body>

  <div id = "page-container">
          <div id = "page-wrap">
              <?php include '../navBar.php';?>
              <div id = "trueSearchBar">
                    <nav class="navbar navbar-light bg-light" style = "margin-left:auto; margin-right:auto;">
                     <form class="form-inline" method = "get">
                        <input class="form-control mr-sm-2" name = "facilityName" type="search" placeholder="Search by Facility" aria-label="Search" required>
                        <button class="btn btn-outline-success my-2 my-sm-0" value = "submit" type="submit">Search</button>
                     </form>
                    </nav>
                <div>

              <h1 style='text-align:center; font-family:Museosans,serif; margin-top:10px'> Query 8 </h1>
              <div class="table-condensed">
              <table class="table" style= "padding:20px;">
                <thead>
                  <tr class="hoverUpon">
                    <th scope="col" style="font-size:15px">ID</th>
                    <th scope="col" style="font-size:15px">firstName</th>
                    <th scope="col" style="font-size:15px">lastName</th>
                    <th scope="col" style="font-size:15px">employeeRole</th>
                    <th scope="col" style="font-size:15px">city</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr class="hoverUpon">
                      <td scope = "row" style="font-size:15px"><?= $row["ID"] ?></td>
                      <td scope = "row" style="font-size:15px"><?= $row["firstName"] ?></td>
                      <td scope = "row" style="font-size:15px"><?= $row["lastName"] ?></td>
                      <td scope = "row" style="font-size:15px"><?= $row["employeeRole"] ?></td>
                      <td scope = "row" style="font-size:15px"><?= $row["city"] ?></td>
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


