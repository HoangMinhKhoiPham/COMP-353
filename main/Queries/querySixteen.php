<?php
require_once '../../database.php';

if (isset($conn)) {
    $statement = $conn->prepare(
        'select * from (
    select firstName, lastName, firstDay, employeeRole, dateOfBirth, email, hour(sum(timediff(shiftEnd, shiftStart))) as hoursScheduled from
        (select ID, firstName, lastName, min(startDate) as firstDay, employeeRole, dateOfBirth, email from
            (select * from
                (select * from
                    (select employeeID, count(*) as timesInfected from HasCaught group by employeeID) as HC
                    where timesInfected >= 3) as infectedOver3
                join Employee E on employeeID = E.ID) as EmpMatched
        join WorksAt on EmpMatched.employeeID = EmpMatched.ID group by EmpMatched.employeeID) as EmployeeAndHours
    join Schedule on employeeID = EmployeeAndHours.ID group by employeeID) as finalTable
where employeeRole in ("Doctor", "Nurse")
order by employeeRole, firstName, lastName;'
    );


    $statement->execute(); //executes the query above

    //echo print_r($statement->fetchAll(), true);

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
    <title>Query 16</title>
    <link rel ="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"
</head>
<body>

<div id = "page-container">
    <div id = "page-wrap">
        <?php include_once '../navBar.php';?>
        <div id = "trueSearchBar">
            <nav class="navbar navbar-light bg-light" style = "margin-left:auto; margin-right:auto;">
                <form class="form-inline" method = "get">
                    <input class="form-control mr-sm-2" name = "facilityName" type="search" placeholder="Search by Facility" aria-label="Search" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" value = "submit" type="submit">Search</button>
                </form>
            </nav>
            <div>
                <h1 style='text-align:center; font-family:Museosans,serif; margin-top:10px'> Query 16 </h1>
                <p style='text-align:center; font-family:Museosans,serif; margin-top:10px'>Details of all nurses and doctors that have been infected more than 3 times</p>

                <div class="table-condensed">
                    <table class="table" style= "padding:20px;">
                        <thead>
                        <tr class="hoverUpon">
                            <th scope="col" style="font-size:15px">First Name</th>
                            <th scope="col" style="font-size:15px">Last Name</th>
                            <th scope="col" style="font-size:15px">First Day</th>
                            <th scope="col" style="font-size:15px">Role</th>
                            <th scope="col" style="font-size:15px">Date Of Birth</th>
                            <th scope="col" style="font-size:15px">Email</th>
                            <th scope="col" style="font-size:15px">Total Hours Scheduled</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {?>
                            <tr class="hoverUpon">
                                <td scope = "row" style="font-size:15px"><?= $row["firstName"] ?></td>
                                <td scope = "row" style="font-size:15px"><?= $row["lastName"] ?></td>
                                <td scope = "row" style="font-size:15px"><?= $row["firstDay"] ?></td>
                                <td scope = "row" style="font-size:15px"><?= $row["employeeRole"] ?></td>
                                <td scope = "row" style="font-size:15px"><?= $row["dateOfBirth"] ?></td>
                                <td scope = "row" style="font-size:15px"><?= $row["email"] ?></td>
                                <td scope = "row" style="font-size:15px"><?= $row["hoursScheduled"] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div id = "footer">
                    <?php include_once '../footer.php';?>
                </div>
</body>
</html>


