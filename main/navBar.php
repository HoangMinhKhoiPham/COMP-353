<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navBar</title>
    <!-- <link rel="stylesheet" href="https://toert.github.io/Isolated-Bootstrap/versions/4.0.0-beta/iso_bootstrap4.0.0min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo HOMEPAGE_URL ?>">CovidTracker.CO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Employee
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>/Employee/displayEmployees.php">Display Employee</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>/Employee/insertIntoEmployee.php">Insert Into Employee</a></li>
                    </ul>
                </div>
            </li>


            <li class="nav-item active">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Facility
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Display Facility</a></li>
                        <li><a class="dropdown-item" href="#">Insert Into Facility</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item active">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Infections
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Infection/displayInfection.php">Display Infections</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Infection/insertIntoInfection.php">Insert Into Infections</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item active">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Queries
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/querySix.php">Query No.6</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/querySeven.php">Query No.7</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/queryEight.php">Query No.8</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/queryNine.php">Query No.9</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/queryTen.php">Query No.10</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/queryEleven.php">Query No.11</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/queryTwelve.php">Query No.12</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/queryThirdteen.php">Query No.13</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/queryFourteen.php">Query No.14</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/queryFifthteen.php">Query No.15</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/querySixteen.php">Query No.16</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/querySeventeen.php">Query No.17</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL  ?>Queries/queryEighteen.php">Query No.18</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <p class="form-inline my-2 my-lg-0">
            <img src="../img/download.png" alt="AppLogo" width="100" height="60" border-radius="20px">
        </p>
    </div>
</nav>
</body>

</html>