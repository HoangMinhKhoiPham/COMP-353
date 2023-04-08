<?php require_once '../../database.php';
$statement = $conn->prepare("SELECT e.firstName, e.lastName, e.dateOfBirth, e.employeeRole, e.email, MIN(w.startDate) AS firstDayOfWork, SUM(TIMESTAMPDIFF(HOUR, s.shiftStart, s.shiftEnd)) AS totalScheduledHours
FROM Employee e
JOIN WorksAt w ON e.ID = w.employeeID
JOIN Schedule s ON e.ID = s.employeeID AND w.facilityID = s.facilityID
WHERE e.employeeRole IN ('Nurse', 'Doctor') AND e.ID NOT IN (
SELECT employeeID FROM HasCaught)
GROUP BY e.ID
ORDER BY e.employeeRole, e.firstName, e.lastName;"); // to change to school database name
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

            <h1 style='text-align:center; font-family:Museosans; margin-top:10px'> List of Doctors in Quebec (Query 14) </h1>
            <div class="table-condensed">
                <table class="table" style="padding:20px;margin:20px; width:95%">
                    <thead>
                        <tr class="hoverUpon">
                            <th scope="col" style="font-size: 15px" class="px-5">firstName</th>
                            <th scope="col" style="font-size: 15px" class="px-5">lastName</th>
                            <th scope="col" style="font-size: 15px" class="px-5">city</th>
                            <th scope="col" style="font-size: 15px" class="px-5">numberOfFacilitiesWorkedAt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                            <tr class="hoverUpon">
                                <td scope="row" style="font-size: 15px" class="px-5"><?= $row["firstName"] ?></td>
                                <td scope="row" style="font-size: 15px" class="px-5"><?= $row["lastName"] ?></td>
                                <td scope="row" style="font-size: 15px" class="px-5"><?= $row["city"] ?></td>
                                <td scope="row" style="font-size: 15px" class="px-5"><?= $row["numberOfFacilitiesWorkedAt"] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div>
                    <div id="footer">
                        <?php include '../footer.php'; ?>
                        <div>
                            <div>
                                <div>
</body>

</html>