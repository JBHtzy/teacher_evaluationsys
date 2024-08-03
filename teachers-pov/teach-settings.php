<?php

include('../assets/include/sessionstart.php');
include('../dbcon/dbconnect.php');

if (!isset($_SESSION['id'])) {
    header('location: ../index.php');
}

$id = $_SESSION['id'];
$result = $mysqli->query("SELECT * FROM `users` WHERE id = '$id'");
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Profile</title>
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
                <div class="bg-white p-4 shadow background">
                    <h4 class="my-2 text-uppercase ms-3 mb-3 fw-bold">Change Username and Password
                    </h4>
                    <div class="container">
                        <form method="post" action="../process.php">
                            <label for="username" class="mt-3">Username:</label>
                            <input type="text" class="form-control mt-3 w-25" name="username" id="username" value="<?= $user['username'] ?>">
                            <span class="text-danger fw-bold" id="username-message"></span>
                            <br>
                            <label for="password">Password:</label>
                            <input type="password" class="form-control my-3 w-25" name="password" id="password" value="<?= $user['password'] ?>">
                            <label for="cpassword">Confirm Password:</label>
                            <input type="password" class="form-control my-3 w-25" name="cpassword" id="cpassword">
                            <span id='confmessage'></span>
                            <br>
                            <button class="savebtn btn btn-success mb-3" type="submit" name="editteachinfo">Save</button>
                        </form>
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
    <script src="../assets/js/main.js"></script>
    <script>
        <?php
        if (isset($_SESSION['editadmin'])) {
            $msg =  $_SESSION['editadmin'];
            echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
            unset($_SESSION['editadmin']);
        }
        ?>
    </script>
</body>

</html>