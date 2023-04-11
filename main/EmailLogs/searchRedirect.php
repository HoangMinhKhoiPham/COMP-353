<?php
require_once '../../database.php';
$searchBar = true;
if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM ' . DBNAME . '.logTable
    WHERE
    sender LIKE :tempo OR
    receiver LIKE :tempo OR
    subject LIKE :tempo OR
    email LIKE :tempo
    ORDER BY date ASC'
    );
    $search_input = '%' . $_GET["searchQuery"] . '%';
    $statement->bindParam(":tempo", $search_input);
    $statement->execute(); //executes the query above
} else {
    echo "DBO CONN ERROR";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display All Emails</title>
    <link rel ="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<div id = "page-container">
    <div id = "page-wrap">
        <?php include '../navBar.php';?>
        <h1 style='text-align:center; font-family:Museosans,serif; margin-top:10px'>Log Of All Emails Sent</h1>
        <h2 style='text-align:center; font-family:Museosans,serif; margin-top:10px'>Search Results for : <?php echo $_GET["searchQuery"]; ?></h2>
        <div class="table-condensed">
            <table class="table" style= "padding:20px;">
                <thead>
                <tr class="hoverUpon">
                    <th scope="col" style="font-size:15px">emailID</th>
                    <th scope="col" style="font-size:15px">Sender</th>
                    <th scope="col" style="font-size:15px">Receiver</th>
                    <th scope="col" style="font-size:15px">Subject</th>
                    <th scope="col" style="font-size:15px">Date</th>
                    <th scope="col" style="font-size:15px">Options</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr class="hoverUpon">
                        <td scope = "row" style="font-size:15px"><?= $row["emailID"] ?></td>
                        <td scope = "row" style="font-size:15px"><?= $row["sender"] ?></td>
                        <td scope = "row" style="font-size:15px"><?= $row["receiver"] ?></td>
                        <td scope = "row" style="font-size:15px"><?= $row["subject"] ?></td>
                        <td scope = "row" style="font-size:15px"><?= $row["date"] ?></td>
                        <td>
                            <a class="btn btn-secondary" style="font-size:15px" href="seeFullMessage.php?ID=<?= $row["emailID"] ?>"> Show Full Message </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="text-center">
                <button class="btn btn-outline-success my-2 my-sm-0" onclick="location.href='displayLogs.php'" type = "button">Back</button>
            </div>
        </div>
    </div>
    <div id = "footer">
        <?php include_once '../footer.php';?>
    </div>
</div>
</body>
</html>
