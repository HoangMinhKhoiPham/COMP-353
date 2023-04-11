<?php require_once '../../database.php';
if (!empty($_GET)) {
    $statement = $conn->prepare('SELECT * FROM ' . DBNAME . '.hasTaken HT JOIN Vaccine V on HT.vaccineID = V.vaccineID join Employee E on E.id = HT.employeeID
    order by HT.' . $_GET['sort']
    );
    $statement->execute();
} else { // sort by date DESC
    $statement = $conn->prepare('SELECT * FROM ' . DBNAME . '.hasTaken HT JOIN Vaccine V on HT.vaccineID = V.vaccineID join Employee E on E.id = HT.employeeID
    order by dateOfVaccination DESC');
    $statement->execute(); //executes the query above
}

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
        <div class="md">
            <div class="col">
                <h3>Sort</h3>
                <a class="btn btn-secondary" href="displayVaccination.php?sort=employeeID">Sort By Employee ID ASC</a>
                <a class="btn btn-secondary" href="displayVaccination.php?sort=vaccineID">Sort By Vaccine Received</a>
                <a class="btn btn-secondary" href="displayVaccination.php?sort=dateOfVaccination">Sort By Date Of Vaccination ASC</a>
                <a class="btn btn-secondary" href="displayVaccination.php?sort=dateOfVaccination">Sort By Date Of Vaccination DESC</a>
            </div>
        </div>

        <h1 style='text-align:center; font-family:Museosans,serif; margin-top:10px'> List of Vaccinations </h1>

        <div class="table-condensed">
            <table class="table" style="padding:20px;">
                <thead>
                <tr class="hoverUpon">
                    <th scope="col" style="font-size:15px">Date Of Vaccination</th>
                    <th scope="col" style="font-size:15px">Employee ID</th>
                    <th scope="col" style="font-size:15px">Employee Name</th>
                    <th scope="col" style="font-size:15px">Vaccine Received</th>
                    <th scope="col" style="font-size:15px">Vaccine Dose ID</th>
                    <th scope="col" style="font-size:15px">Options</th>



                </tr>
                </thead>
                <tbody>
                <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr class="hoverUpon">
                        <td style="font-size:15px"><?= $row["dateOfVaccination"] ?></td>
                        <td style="font-size:15px"><?= $row["employeeID"] ?></td>
                        <td style="font-size:15px"><?= $row["firstName"] .' ' .$row['lastName'] ?></td>
                        <td style="font-size:15px"><?= $row["vaccineType"] ?></td>
                        <td style="font-size:15px"><?= $row["vaccineDoseID"] ?></td>
                        <td>
                            <a style="font-size:15px" href="deleteVaccination.php?ID=<?= $row["vaccineDoseID"] ?>"> Delete </a>
                            <a style="font-size:15px" href="editVaccination.php?ID=<?= $row["vaccineDoseID"] ?>"> Edit </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div>
                <?php include '../footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>