<?php

include('../assets/include/sessionstart.php');
include('../dbcon/dbconnect.php');

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}

$id = $_SESSION['teaId'];
$feel = $_GET['getall'];
// echo $id;
$result = $mysqli->query("SELECT * FROM `reactions` JOIN teachers ON reactions.teacherid = teachers.id WHERE feels = '$feel' AND teachers.id = '$id'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/googleFonts.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/dataTables.min.css" />
</head>

<body>
    <?php include('./pages/navbar.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('./pages/sidebar.php') ?>
        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow background">
                    <h3 class="my-2 text-uppercase ms-3 mb-3 fw-bold">
                        <i class="fa-solid fa-chart-pie me-2 rounded-circle p-2 secondary-bg2"></i>Remarks
                    </h3>
                    <div class="container">
                        <table class="table mt-3" id="tableteacherInfo">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Subject</th>
                                    <th scope="col">React</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Date Evaluated</th>
                                    <th scope="col">Evaluated By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($react = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $react['subject'] ?></td>
                                        <td><?= $react['feels'] ?></td>
                                        <td><?= $react['comments'] ?></td>
                                        <td>On <?= $react['date'] ?></td>
                                        <td>Student</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
    <script src="../assets/js/dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#tableteacherInfo', {});
    </script>
</body>

</html>