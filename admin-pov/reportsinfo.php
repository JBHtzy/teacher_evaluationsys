<?php

include('../assets/include/sessionstart.php');
include('../dbcon/dbconnect.php');

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}

$x = $mysqli->query("SELECT reactions.feels as outstanding, COUNT(*) as counts FROM `reactions` WHERE feels = 'outstanding'")->fetch_assoc();

$p = $mysqli->query("SELECT reactions.feels as verysatisfactory, COUNT(*) as counts FROM `reactions` WHERE feels = 'very satisfactory'")->fetch_assoc();

$y = $mysqli->query("SELECT reactions.feels as satisfactory, COUNT(*) as counts FROM `reactions` WHERE feels = 'satisfactory'")->fetch_assoc();

$n = $mysqli->query("SELECT reactions.feels as needsimprovements, COUNT(*) as counts FROM `reactions` WHERE feels = 'needs improvements'")->fetch_assoc();

$z = $mysqli->query("SELECT reactions.feels as poor, COUNT(*) as counts FROM `reactions` WHERE feels = 'poor'")->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Reports</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/googleFonts.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>
    <?php include('./pages/navbar.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('./pages/sidebar.php') ?>
        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow">
                    <h3 class="my-2 text-uppercase ms-3 mb-3 fw-bold">
                        <i class="fa-solid fa-chart-pie me-2 rounded-circle p-2 secondary-bg2"></i>Reports
                    </h3>
                    <div class="container">
                        <div class="row g-5 mt-1">
                            <div class="col-md-4 oms">
                                <div class="p-4 d-flex justify-content-around rounded">
                                    <img src="../assets/imgs/3_01.png" width="80" alt="heart">
                                    <div>
                                        <h6 class="text-center">Outstanding</h6>

                                        <p class="fs-4 fw-bold text-center">
                                            <?= $x['counts'] ?>

                                        </p>
                                        <a href="./comms.php?getreact=<?= $x['outstanding'] ?>">View Here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 oms">
                                <div class="p-4 d-flex justify-content-around rounded">
                                    <img src="../assets/imgs/3_02.png" width="80" alt="haha">
                                    <div>
                                        <h6 class="text-center">Very Satisfactory</h6>
                                        <p class="fs-4 fw-bold text-center">
                                            <?= $p['counts'] ?>

                                        </p>
                                        <a href="./comms.php?getreact=<?= $p['verysatisfactory'] ?>">View Here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 oms">
                                <div class="p-4 d-flex justify-content-around rounded">
                                    <img src="../assets/imgs/3_03.png" width="80" alt="sad">
                                    <div>
                                        <h6 class="text-center">Satisfactory</h6>
                                        <p class="fs-4 fw-bold text-center">
                                            <?= $y['counts'] ?>

                                        </p>
                                        <a href="./comms.php?getreact=<?= $y['satisfactory'] ?>">View Here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 oms">
                                <div class="p-4 d-flex justify-content-around rounded">
                                    <img src="../assets/imgs/3_04.png" width="100" alt="angry">
                                    <div>
                                        <h6 class="text-center">Needs Improvements</h6>
                                        <p class="fs-4 fw-bold text-center">
                                            <?= $n['counts'] ?>

                                        </p>
                                        <a href="./comms.php?getreact=<?= $n['needsimprovements'] ?>">View Here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 oms">
                                <div class="p-4 d-flex justify-content-around rounded">
                                    <img src="../assets/imgs/3_05.png" width="80" alt="angry">
                                    <div>
                                        <h6 class="text-center">Poor</h6>
                                        <p class="fs-4 fw-bold text-center">
                                            <?= $z['counts'] ?>

                                        </p>
                                        <a href="./comms.php?getreact=<?= $z['poor'] ?>">View Here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/fontAwesome.js"></script>
    <script src="../assets/js/sweetalert2.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/toggleSidebar.js"></script>
</body>

</html>