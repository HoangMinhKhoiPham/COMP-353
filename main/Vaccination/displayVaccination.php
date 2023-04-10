<?php require_once '../../database.php';
$statement = $conn->prepare('SELECT * FROM ' . DBNAME . '.Vaccine');
$statement->execute(); //executes the query above
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccine Table</title>
    <link rel="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div id="page-container">
        <div id="page-wrap">
            <?php include '../navBar.php'; ?>
            <?php include '../searchBar.php'; ?>

            <h1 style='text-align:center; font-family:Museosans,serif; margin-top:10px'> List of Vaccine </h1>
            <div class="table-condensed">
                <table class="table" style="padding:20px;">
                    <thead>
                        <tr class="hoverUpon">
                            <th scope="col" style="font-size:10px">Vaccine ID</th>
                            <th scope="col" style="font-size:10px">Vaccine Type</th>
                            <th scope="col" style="font-size:10px">Expiration in Months</th>
                            <th scope="col" style="font-size:10px">options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                            <tr class="hoverUpon">
                                <td style="font-size:15px"><?= $row["vaccineID"] ?></td>
                                <td style="font-size:15px"><?= $row["vaccineType"] ?></td>
                                <td style="font-size:15px"><?= $row["timeBeforeExpirationInMonth"] ?></td>
                                <td>
                                    <a style="font-size:15px" href="deleteVaccination.php?ID=<?= $row["VaccineID"] ?>"> Delete </a>
                                    <a style="font-size:15px" href="editVaccination.php?ID=<?= $row["VaccineID"] ?>"> Edit </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div>
                    <div id = 'footer'>
                    <?php include '../footer.php'; ?>
                    <div>
                </div>
            </div>
        </div>
</body>

</html>