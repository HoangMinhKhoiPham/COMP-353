<?php
require_once '../../database.php';

if (isset($conn)) {
    $statement = $conn->prepare(
        'select facilityName,
            Date(shiftStart) as Day,
            time(shiftStart) as start_time,
            time(shiftEnd) as end_time
            from Facilities join Schedule S on Facilities.id = S.facilityID
            where employeeID = :givenEmployee and date(shiftStart) >= date(:startDate) and date(shiftEnd) <= date(:endDate)
            order by facilityName, Day, start_time;'
    );

    $setEmployee = setEmployee();
    $statement->bindParam(':givenEmployee', $setEmployee);
    $setStartDate = setStartDate();
    $statement->bindParam(':startDate', $setStartDate);
    $setEndDate = setEndDate();
    $statement->bindParam(':endDate', $setEndDate);

    $statement->execute(); //executes the query above

    $employeeInfo = $conn->prepare('select firstName, lastName, employeeRole from Employee where ID = :givenEmployee');
    $employeeInfo->bindParam(':givenEmployee', $setEmployee);
    $employeeInfo->execute();


} else {
    print_r("DB Connection error");
}

function setEmployee()
{
    return $_POST['employeeID'] ?? 6;
}

function setStartDate()
{
    return $_POST['start_date'] ?? "2023-04-02";
}

function setEndDate()
{
    return $_POST['end_date'] ?? "2023-04-29";
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
        <?php include_once '../navBar.php';?>
            <div>
                <h1 style='text-align:center; font-family:Museosans,serif; margin-top:10px'> Query 8 </h1>
                <p style='text-align:center; font-family:Museosans,serif; margin-top:10px'>Details of all hours of given employee within the specified time frame</p>
                <p style='text-align:center; font-family:Museosans,serif; margin-top:10px'>For the purpose of the demo, use employee ID 6, 106, 162 or 251 </p>

                <div class="row">
                    <div class="col-md-4">
                        <table class="table" style= "padding:20px;">
                            <caption style="caption-side: top; text-align: center">Selected Employee Info</caption>
                            <thead>
                            <tr class="hoverUpon">
                                <th scope="col" style="font-size:15px">First Name</th>
                                <th scope="col" style="font-size:15px">Last Name</th>
                                <th scope="col" style="font-size:15px">Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = $employeeInfo->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                <tr class="hoverUpon">
                                    <td scope = "row" style="font-size:15px"><?= $row["firstName"]  ?></td>
                                    <td scope = "row" style="font-size:15px"><?= $row["lastName"] ?></td>
                                    <td scope = "row" style="font-size:15px"><?= $row["employeeRole"] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8" id = "queryEditForm" style="margin-top:10px">
                        <form style="width:100%; padding:30px" method="POST" >
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="employeeID">Employee ID</label>
                                    <label for="employeeID"></label><input type="number" min="0" class="form-control" id="employeeID" name = "employeeID"
                                                                           placeholder="employeeID"
                                                                           value="<?php echo setEmployee() ?>"
                                                                           required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="start_date">Start Of Time Period</label>
                                    <input type="date" class="form-control" id="start_date"
                                           name = "start_date"
                                           placeholder="YYYY-MM-DD"
                                           value="<?php echo setStartDate()?>"
                                           required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="end_date">End Of Time Period</label>
                                    <input type="date" class="form-control" id="end_date"
                                           name = "end_date"
                                           placeholder="YYYY-MM-DD"
                                           value="<?php echo setEndDate()?>"
                                           required>
                                </div>
                                <button type="submit" value="Submit" name = "submit" class="btn btn-ternary">Submit</button>
                                <?php
                                if (isset($success) && $success) {
                                    echo "<script> location.href='".BASE_URL."Queries/queryEight.php'; </script>";
                                    exit();
                                } else {
                                    echo "";
                                }
                                ?>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-condensed">
                    <table class="table" style= "padding:20px;">
                        <thead>
                        <tr class="hoverUpon">
                            <th scope="col" style="font-size:15px">Facility Name</th>
                            <th scope="col" style="font-size:15px">Day</th>
                            <th scope="col" style="font-size:15px">Shift Start Time</th>
                            <th scope="col" style="font-size:15px">Shift End Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                            <tr class="hoverUpon">
                                <td scope = "row" style="font-size:15px"><?= $row["facilityName"] ?></td>
                                <td scope = "row" style="font-size:15px"><?= $row["Day"] ?></td>
                                <td scope = "row" style="font-size:15px"><?= $row["start_time"] ?></td>
                                <td scope = "row" style="font-size:15px"><?= $row["end_time"] ?></td>
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


