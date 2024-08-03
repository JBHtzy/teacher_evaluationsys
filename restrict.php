<?php
include('./dbcon/dbconnect.php');

$result = $mysqli->query("SELECT opening_day FROM activate_day");
$day = $result->fetch_assoc();

$datenow = $mysqli->query("SELECT DATE_FORMAT(now(), '%Y-%m-%d') as datenow")->fetch_assoc();
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
        <div class="box shadow align-items-center text-white d-flex flex-column align-items-center justify-content-center gap-3">
            <?php
            if ($day !== null && isset($day["opening_day"])) {
                $openingDay = $day["opening_day"];
                if ($datenow['datenow'] == $openingDay) {
                    $disabled = "";
                    echo "Welcome! Today is the opening day.";
                    echo "<div>
                <a href='student-pov/student.php' class='btn btn-success w-100' id='adminPanelLink' $disabled;>Proceed</a>
            </div>";
                } else {
                    echo "Sorry, the system is not open today.<br> Please wait for further announcements. Thank you";
                    $disabled = "disabled";
                }
            } else {
                echo "Good Day Everyone!";
                echo "<div class='text-center'>
                Please wait for further announcements. Thank you
            </div>";
                $disabled = "disabled";
            }
            ?>

        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/fontAwesome.js"></script>
    <script src="./assets/js/sweetalert2.js"></script>
    <script src="./assets/js/main.js"></script>
</body>


</html>