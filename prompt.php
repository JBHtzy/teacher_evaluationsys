<?php
include('./dbcon/dbconnect.php');
include('./assets/include/sessionstart.php');

if (!isset($_SESSION['id'])) {
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Teachers Evaluation</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/googleFonts.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>
    <div class="container">
        <div class="box shadow align-items-center text-white d-flex flex-column align-items-center justify-content-center">
            <h5 class="fw-bold">Are you an enrolled student?</h5>
            <div class="row w-50 mt-3 text-center">
                <div class="col-6">
                    <a href="register.php" class="btn btn-info">Yes</a>
                </div>
                <div class="col-6">
                    <a href="index.php" class="btn btn-info">No</a>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/fontAwesome.js"></script>
    <script src="./assets/js/sweetalert2.js"></script>
</body>


</html>