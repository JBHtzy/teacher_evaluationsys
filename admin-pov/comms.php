<?php

include('../assets/include/sessionstart.php');
include('../dbcon/dbconnect.php');

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}

$feels = $_GET['getreact'];
$result = $mysqli->query("SELECT DISTINCT CONCAT(students.firstname, ' ', students.lastname) as studname, teachers.name as teachname, teachers.prof_img as teachimg, reactions.feels as feels, reactions.comments as comms, subjects.subject_desc as subject, reactions.date as date FROM `reactions` JOIN students ON reactions.stud_id = students.stud_id JOIN teachers ON reactions.teacherid = teachers.id JOIN subjects ON reactions.subject = subjects.subject_desc WHERE feels = '$feels'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
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
                <div class="bg-white p-4 shadow">
                    <h3 class="my-2 text-uppercase ms-3 mb-3 fw-bold">
                        <i class="fa-solid fa-chart-pie me-2 rounded-circle p-2 secondary-bg2"></i>Remarks
                    </h3>
                    <div class="container mt-4">
                        <table class="table mt-3" id="tableteacherInfo">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Teacher</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">React</th>
                                    <!-- <th scope="col">Comments</th> -->
                                    <th scope="col">Student</th>
                                    <th scope="col">Date Evaluated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($react = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td>
                                            <img src=" ../assets/imgs/<?= $react['teachimg'] ?>" width="70" alt="teacher">
                                        </td>
                                        <td><?= $react['teachname'] ?></td>
                                        <td><?= $react['subject'] ?></td>
                                        <td><?= $react['feels'] ?></td>
                                        <!-- <td><#?= $react['comms'] ?></td> -->
                                        <td><?= $react['studname'] ?></td>
                                        <td>On <?= $react['date'] ?></td>
                                    </tr>
                            </tbody>
                        <?php } ?>
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
        new DataTable('#tableteacherInfo');
    </script>
</body>

</html>