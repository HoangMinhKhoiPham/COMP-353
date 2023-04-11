<?php require_once '../../database.php';
$statement = $conn->prepare("SELECT f.province, f.facilityName, f.capacity, COUNT(h.employeeID) as infectedCount
FROM Facilities f
LEFT JOIN WorksAt w ON f.id = w.facilityID
LEFT JOIN HasCaught h ON w.employeeID = h.employeeID
WHERE h.dateOfInfection BETWEEN DATE_SUB(NOW(), INTERVAL 2 WEEK) AND NOW()
GROUP BY f.id
ORDER BY f.province, infectedCount"); // to change to school database name
$statement->execute();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DisplayFacilityTable</title>
    <link rel="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div id="page-container">
        <div id="page-wrap">
            <?php include '../navBar.php'; ?>
            <?php include '../searchBar.php'; ?>

            <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> (Query 13) </h1>
            <div class="table-condensed">
                <table class="table" style="padding:20px;margin:20px; width:95%">
                    <thead>
                        <tr class="hoverUpon">
                            <th scope="col" style="font-size: 15px" class="px-5">facilityName</th>
                            <th scope="col" style="font-size: 15px" class="px-5">capacity</th>
                            <th scope="col" style="font-size: 15px" class="px-5">infectedCount</th>
                            <th scope="col" style="font-size: 15px" class="px-5">province</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                            <tr class="hoverUpon">
                                <td scope="row" style="font-size: 15px" class="px-5"><?= $row["facilityName"] ?></td>
                                <td scope="row" style="font-size: 15px" class="px-5"><?= $row["capacity"] ?></td>
                                <td scope="row" style="font-size: 15px" class="px-5"><?= $row["infectedCount"] ?></td>
                                <td scope="row" style="font-size: 15px" class="px-5"><?= $row['province'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
                <div id="footer">
                    <?php include '../footer.php'; ?>
                </div>
        </div>
    </div>                            
</body>

</html>