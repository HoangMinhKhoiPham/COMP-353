<?php
require_once '../../database.php';
if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM '.DBNAME.'.EmailDetail WHERE emailID = :emailID;');
    $statement->bindParam(':emailID', $_GET['ID']);
    $statement->execute();

    $headerInfo = $conn->prepare('SELECT * FROM '.DBNAME.'.logTable WHERE emailID = :emailID;');
    $headerInfo->bindParam(':emailID', $_GET['ID']);
    $headerInfo->execute();


    $data = $statement->fetchAll()[0];
    $headerData = $headerInfo->fetchAll()[0];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Email</title>
    <link rel ="stylesheet" href="../../css/displayTable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<div id = "page-container">
    <div id = "page-wrap">
        <?php include_once '../navBar.php';?>

        <div class="container">
            <Table>
                <thead>
                <tr>
                    <th>Date Sent: <?php echo $data['dateSent']; ?></th>
                </tr>
                <tr>
                    <td><strong>From: </strong><?php echo $headerData['sender']; ?></td>
                </tr>
                <tr>
                    <td><strong>To: </strong><?php echo $headerData['receiver']; ?></td>
                </tr>
                <tr>
                    <td style="padding-top: 10px"><strong>Subject: </strong><?php echo $headerData['subject']; ?></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="padding-top: 20px">
                        <?php echo nl2br($data['emailBody']);?>
                    </td>
                </tr>
                </tbody>
            </Table>
            <button class="btn btn-outline-success my-2 my-sm-0" onclick="location.href='displayLogs.php'" type = "button">Back</button>

        </div>
        <div id = "footer">
            <?php include_once '../footer.php';?>
        </div>

    </div>

</body>
</html>
