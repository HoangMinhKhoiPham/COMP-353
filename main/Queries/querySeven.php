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
            <?php include_once '../navBar.php'; ?>
            <form class="form-inline" action="getEmployee.php" method="GET">
                <label  class="my-1 mr-2" for="facility">Which facility would you like to see a list of all the employees currently working there?</label>
                <input  style="width: 50%" type="text" class="form-control" name="facility" placeholder="Hospital Maisonneuve Rosemont">
                <button style="margin: 10px" type="submit" class="btn btn-primary my-1">Submit</button>
            </form>
            <div id="footer">
                <?php include_once '../footer.php'; ?>
            <div>
        <div>
    <div>
</body>

</html>