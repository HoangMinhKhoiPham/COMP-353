<?php require_once '../../database.php';
if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM '.DBNAME.'.Infection');
    $statement->execute(); //executes the query above
} else {
    print_r("PDO CONN ERROR");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infection Table</title>
    <link rel ="stylesheet" href="../../css/infection.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

  <div id = "page-container">
          <div id = "page-wrap">
              <?php include '../navBar.php';?>
              <?php include '../searchBar.php';?>
              
              <h1 style='text-align:center; font-family:Museosans,serif; margin-top:10px'> Infections </h1>
              <div class="table-condensed">
              <table class="table" style= "padding:20px;">
                <thead>
                  <tr class="hoverUpon">
                    <th scope="col" style="font-size:10px">Infection ID</th>
                    <th scope="col" style="font-size:10px">Type of Infection</th>

                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr class="hoverUpon">
                      <td tyle="font-size:10px"><?= $row["infectionID"] ?></td>
                      <td style="font-size:10px"><?= $row["typeOfInfection"] ?></td>

                      <td>
                        <a style="font-size:10px" href="deleteEmployee.php?ID=<?= $row["infectionID"] ?>"> Delete </a>
                        <a style="font-size:10px" href="editEmployee.php?ID=<?= $row["infectionID"] ?>"> Edit </a>
                      </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div>
              <?php include '../footer.php';?>
          <div>
      <div>
</body>
</html>
