<?php require_once '../../database.php';
if (!empty($_GET['searchQuery'])) {
    $searchQuery = "%". $_GET['searchQuery'] . "%";
    $statement = $conn->prepare('SELECT * FROM ' . DBNAME . '.Schedule S join Facilities F on S.facilityID = F.id join Employee E on E.id = S.employeeID 
    WHERE facilityName LIKE :searchQuery OR firstName LIKE :searchQuery OR lastName LIKE :searchQuery order by employeeID');
    $statement->bindParam(':searchQuery', $searchQuery);
    $statement->execute(); //executes the query above
} else {
    $statement = $conn->prepare('SELECT * FROM ' . DBNAME . '.Schedule S join Facilities F on S.facilityID = F.id join Employee E on E.id = S.employeeID order by employeeID');
    $statement->execute(); //executes the query above
}

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
        <div id = "trueSearchBar">
            <nav class="navbar navbar-light bg-light " style = "margin-left:auto; margin-right:auto;">
                <form class="form-inline" action = "displaySchedule.php" method = "get">
                    <input class="form-control col-md-8" name = "searchQuery" type="search" placeholder="Search Names" aria-label="Search" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" value = "submit" type="submit">Search</button>
                    <?php
                    if (isset($_GET['searchQuery'])) {
                        echo "<a class='btn btn-secondary' href='displaySchedule.php'>clear</a>";
                    }
                    ?>
                </form>
            </nav>
        </div>
        <div>
            <?php
            if (isset($_GET['searchQuery'])) {
                echo "<h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Schedule for ".$_GET['searchQuery']. "</h1>";
            } else {
                echo "<h1 style='text-align:center; font-family:Museosans; margin-top:10px'> Schedule </h1>";
            }
            ?>

            <div class="table-condensed">
                <table class="table" style="padding:20px;">
                    <thead>
                    <tr class="hoverUpon">
                        <th scope="col" style="font-size:15px">employeeID</th>
                        <th scope="col" style="font-size:15px">Employee Name</th>
                        <th scope="col" style="font-size:15px">Facility ID</th>
                        <th scope="col" style="font-size:15px">Facility Name</th>
                        <th scope="col" style="font-size:15px">shiftStart</th>
                        <th scope="col" style="font-size:15px">shiftEnd</th>
                        <th scope="col" style="font-size:15px">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                        <tr class="hoverUpon">
                            <td scope="row" style="font-size:15px"><?= $row["employeeID"] ?></td>
                            <td scope="row" style="font-size:15px"><?= $row["firstName"] .' ' .$row['lastName'] ?></td>
                            <td scope="row" style="font-size:15px"><?= $row["facilityID"] ?></td>
                            <td scope="row" style="font-size:15px"><?= $row["facilityName"] ?></td>
                            <td scope="row" style="font-size:15px"><?= $row["shiftStart"] ?></td>
                            <td scope="row" style="font-size:15px"><?= $row["shiftEnd"] ?></td>
                            <td>
                                <a style="font-size:15px" href="deleteSchedule.php?employeeID=<?= $row["employeeID"] ?>&facilityID=<?= $row["facilityID"] ?>&shiftStart=<?= $row["shiftStart"] ?>"> Delete </a>
                                <a style="font-size:15px" href="editSchedule.php?employeeID=<?= $row["employeeID"] ?>&facilityID=<?= $row["facilityID"] ?>&shiftStart=<?= $row["shiftStart"] ?>"> Edit </a>
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