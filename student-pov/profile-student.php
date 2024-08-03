<?php

include('../assets/include/sessionstart.php');
include('../dbcon/dbconnect.php');

if (!isset($_SESSION['id'])) {
  header('location: ../index.php');
}

$id = $_SESSION['id'];
$result = $mysqli->query("SELECT users.username as user, users.password as pass, students.* FROM `students` JOIN users ON students.stud_id = users.id WHERE users.id = '$id'");
$studs = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Profile</title>
  <link rel="stylesheet" href="../assets/css/student-dash.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/googleFonts.css" />
  <link rel="shortcut icon" href="../assets/imgs/books.png" type="image/x-icon">
</head>

<body>

  <?php include('stud-navbar.php') ?>

  <div class="container-fluid p-4">
    <div class=" bg-content shadow-lg">
      <div class="subtitle text-start p-3">
        <h3 class="fw-bold text-white  mb-3">Profile Information</h3>
      </div>
      <form action="../process.php" method="post">
        <input type="hidden" name="updateID" id="updateID">
        <div class="row text-white px-3">
          <div class="col-4">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control w-75" value="<?= $studs[0]['user'] ?>" required>
            <span class="text-warning fw-bold" id="username-message"></span>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control w-75" required>
            <br>
            <label for="cpassword">Confirm Password:</label>
            <input type="password" name="password" class="form-control w-75" id="cpassword" required>
            <span class="fw-bold" id='confmessage'></span>
            <span class="fw-bold" id='valpass'></span>
          </div>
          <div class="col-7">
            <div class="row">
              <div class="col-md-6">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" name="firstname" class="form-control" id="firstname" value="<?= $studs[0]['firstname'] ?>" required />
              </div>
              <div class="col-md-6">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" name="lastname" class="form-control" id="lastname" value="<?= $studs[0]['lastname'] ?>" required />
              </div>
              <div class="col-md-6 my-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?= $studs[0]['email'] ?>" required />
              </div>
              <div class="col-md my-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" name="age" class="form-control" value="<?= $studs[0]['age'] ?>" id="age" />
              </div>
              <div class="col-md-3 my-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" aria-label="Default select example" id="gender" value="<?= $studs[0]['gender'] ?>">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="col-md-5">
                <label for="yearlevel" class="form-label">Year Level</label>
                <input type="text" name="yearlevel" class="form-control" id="yearlevel" value="<?= $studs[0]['yearlvl'] ?>" required />
              </div>
              <div class="col-md-6">
                <label for="course" class="form-label">Course</label>
                <input type="text" name="course" class="form-control" id="course" value="<?= $studs[0]['course'] ?>" required />
              </div>
            </div>
          </div>
        </div>
        <button type="submit" name="updatestudinfo" id="validatebtn" class="btn btn-success ms-3 mt-5 fw-bold savebtn">SAVE</button>
      </form>
    </div>
  </div>


  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/fontAwesome.js"></script>
  <script src="../assets/js/sweetalert2.js"></script>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script>
    <?php
    if (isset($_SESSION['updatestudforms'])) {
      $msg = $_SESSION['updatestudforms'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['updatestudforms']);
    }

    if (isset($_SESSION['valuser'])) {
      $msg = $_SESSION['valuser'];
      echo "Swal.fire({icon:'warning', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['valuser']);
    }

    if (isset($_SESSION['valpassw'])) {
      $msg = $_SESSION['valpassw'];
      echo "Swal.fire({icon:'warning', title:'$msg', showConfirmButton: false,
            timer: 3000});";
      unset($_SESSION['valpassw']);
    }
    ?>
  </script>
</body>

</html>