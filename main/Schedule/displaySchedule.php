<?php require_once '../../database.php';
$statement = $conn->prepare('SELECT * FROM ' . DBNAME . '.Schedule');
$statement->execute(); //executes the query above
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DisplaySchedulesTable</title>
    <link rel="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div id="page-container">
        <div id="page-wrap">
            <?php include '../navBar.php'; ?>
            <?php include '../searchBar.php'; ?>

            <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Schedule </h1>
            <div class="table-condensed">
                <table class="table" style="padding:20px;">
                    <thead>
                        <tr class="hoverUpon">
                            <th scope="col" style="font-size:10px">employeeID</th>
                            <th scope="col" style="font-size:10px">facilityID</th>
                            <th scope="col" style="font-size:10px">shiftStart</th>
                            <th scope="col" style="font-size:10px">shiftEnd</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                            <tr class="hoverUpon">
                                <td scope="row" style="font-size:10px"><?= $row["employeeID"] ?></td>
                                <td scope="row" style="font-size:10px"><?= $row["facilityID"] ?></td>
                                <td scope="row" style="font-size:10px"><?= $row["shiftStart"] ?></td>
                                <td scope="row" style="font-size:10px"><?= $row["shiftEnd"] ?></td>
                                <td>
                                    <a style="font-size:10px" href="deleteSchedule.php?employeeID=<?= $row["employeeID"] ?>&facilityID=<?= $row["facilityID"] ?>&shiftStart=<?= $row["shiftStart"] ?>"> Delete </a>
                                    <a style="font-size:10px" href="editSchedule.php?employeeID=<?= $row["employeeID"] ?>&facilityID=<?= $row["facilityID"] ?>&shiftStart=<?= $row["shiftStart"] ?>"> Edit </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div>
                    <?php include '../footer.php'; ?>
                    <div>
                        <div>
</body>

</html>