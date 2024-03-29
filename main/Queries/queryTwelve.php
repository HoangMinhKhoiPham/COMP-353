<?php
require_once '../../database.php';

if (isset($conn)) {
    $optionFetch = $conn->prepare('SELECT id, facilityName FROM '.DBNAME.'.Facilities order by id');
    $optionFetch->execute();
    $options = $optionFetch->fetchAll();

    $statement = $conn->prepare(
        'select facilityName, sum(hoursScheduled) as totalHoursScheduled, employeeRole from
                    (select facilityID, facilityName, day, hoursScheduled, employeeID from
                        (select *, hour(sum(timediff(shiftEnd, shiftStart))) as hoursScheduled, date(shiftEnd) as day
                        from Facilities join Schedule S on Facilities.id = S.facilityID group by employeeID, day, facilityName) as allHours
                    where day >= date(:startDate) and day <= date(:endDate)) as hoursInTimeframe
                join Employee E on employeeID = E.ID
                where facilityID = :chosenFacility
                group by employeeRole order by employeeRole;'
    );

    $setFacilityId = setFacilityId();
    $statement->bindParam(':chosenFacility', $setFacilityId);
    $setStartDate = setStartDate();
    $statement->bindParam(':startDate', $setStartDate);
    $setEndDate = setEndDate();
    $statement->bindParam(':endDate', $setEndDate);


    $statement->execute(); //executes the query above

} else {
    print_r("DB Connection error");
}

function setFacilityId()
{
    return $_POST['facilityID'] ?? 8;
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
    <title>Query 12</title>
    <link rel ="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"
</head>
<body>

<div id = "page-container">
    <div id = "page-wrap">
        <?php include_once '../navBar.php';?>
        <div>
            <h1 style='text-align:center; font-family:Museosans,serif; margin-top:10px'> Query 12 </h1>
            <p style='text-align:center; font-family:Museosans,serif; margin-top:10px'>All hours scheduled for all roles for the selected facility for the specified time frame</p>

            <div id = "queryEditForm" style="margin-top:10px">
                <form style="width:100%; padding:30px" method="POST" >
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="facilityID">Facility Selected</label>
                            <select class="form-select" aria-label="selectFacility" id="facilityID" name = "facilityID" required>
                                <?php
                                if (isset($options)) {
                                    foreach ($options as $option) {
                                        if ($option['id'] == setFacilityId()) {
                                            echo "<option selected=\"selected\" value=" . $option['id'] . ">" . $option['facilityName'] . "</option>";
                                        } else {
                                            echo "<option value=" . $option['id'] . ">" . $option['facilityName'] . "</option>";
                                        }

                                    }
                                }
                                ?>
                            </select>
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
                            echo "<script> location.href='".BASE_URL."Queries/queryTwelve.php'; </script>";
                            exit();
                        } else {
                            echo "";
                        }
                        ?>

                    </div>
                </form>
            </div>
            <div class="table-condensed">
                <table class="table" style= "padding:20px;">
                    <thead>
                    <tr class="hoverUpon">
                        <th scope="col" style="font-size:15px">Role</th>
                        <th scope="col" style="font-size:15px">Total Hours Scheduled</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {?>
                        <tr class="hoverUpon">
                            <td scope = "row" style="font-size:15px"><?= $row["employeeRole"] ?></td>
                            <td scope = "row" style="font-size:15px"><?= $row["totalHoursScheduled"] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div id = "footer">
                <?php include_once '../footer.php';?>
            </div>
        </div>
    </div>
</div>
</body>
</html>


