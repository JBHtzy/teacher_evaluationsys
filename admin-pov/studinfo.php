<?php

include('../assets/include/sessionstart.php');
include('../dbcon/dbconnect.php');
include('../assets/include/generateuser.php');

if (!isset($_SESSION['id'])) {
  header('location: ../index.php');
}

$result = $mysqli->query("SELECT students.stud_id as getid, users.*, students.* FROM `users` JOIN students ON users.id = students.stud_id WHERE role = 'student'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Information</title>
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
            <i class="fa-solid fa-chart-pie me-2 rounded-circle p-2 secondary-bg2"></i>Student Information
          </h3>
          <div class="container">
            <div class="d-flex justify-content-end my-3">
              <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createStud">
                <i class="fa-solid fa-plus"></i>
                Create Student
              </button>
            </div>
            <table class="table" id="tableteacherInfo">
              <thead>
                <tr>
                  <th scope="col" class="fw-bold">Student Accounts:</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($students = $result->fetch_assoc()) {
                  $student_id = $students['getid'];
                  $getimg = $students['proof_img'];
                  $enroll = $students['is_enrolled'];
                ?>
                  <tr>
                    <td><?= $students['username'] ?></td>
                    <td>
                      <button class="btn btn-info btnviewer" id="<?= $getimg ?>" value="<?= $student_id ?>" data-bs-toggle="modal" data-bs-target="#viewstudInfo" onclick="retrieve(<?= $student_id ?>);">
                        <i class="fa-solid fa-eye"></i>
                        View
                      </button>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="createStud" tabindex="-1" aria-labelledby="createStudLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold text-white" id="createStudLabel">Create Student</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-5">
          <form action="../process.php" method="post">
            <div class="w-100">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>">
            </div>
            <br>
            <div class="w-100">
              <label for="password">Temp Password</label>
              <input type="text" class="form-control" name="password" id="password" value="<?php echo $password; ?>">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="registerStud">Submit</button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <!-- view modal -->
  <div class="modal fade" id="viewstudInfo" tabindex="-1" aria-labelledby="viewstudInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold text-white " id="viewstudInfoLabel"><span id="showstud"></span>'s Information
            <p class="mb-0 fs-6 text-capitalize "><i class="fa-solid fa-circle" id="icon"></i> <span id="status"></span></p>
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-5">
          <form action="../process.php" method="post">
            <input type="hidden" name="fetchid" id="fetchid">
            <div class="row ">
              <div class="col-md-6">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" name="firstname" class="form-control" id="firstname" readonly />
              </div>
              <div class="col-md-6">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" name="lastname" class="form-control" id="lastname" readonly />
              </div>
              <div class="col-md-6 my-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" readonly />
                </p>
              </div>
              <div class="col-md my-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" name="age" class="form-control" id="age" readonly />
              </div>
              <div class="col-md-3 my-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" name="gender" class="form-control" id="gender" readonly />
              </div>
              <div class="col-md-4">
                <label for="yearlevel" class="form-label">Year Level</label>
                <input type="text" name="yearlevel" class="form-control" id="yearlevel" readonly />
              </div>
              <div class="col-md-4">
                <label for="course" class="form-label">Course</label>
                <input type="text" name="course" class="form-control" id="course" readonly />
              </div>
              <div class="col-md-4" id="enrollpass">
                <label for="opassword" class="form-label">Temp Pass:</label>
                <input type="password" class="form-control" id="opassword" readonly />
                <span class="position-absolute mt-3 top-50 end-0 translate-middle-y m-2"><i class="fa-sharp fa-solid fa-eye border-start px-2" id="eyetoggle"></i></span>
              </div>
              <div class="col-md-7 mt-3">
                <label for="course" class="form-label">Proof of Enrollment/COR:</label>
                <div class="col-md-6  content-img">
                  <img src="" class="enrolleimagePreview" style="width:500px; height:250px; border-radius: 5px;aspect-ratio: 3/3;">
                </div>
              </div>
            </div>
            <div class="modal-footer mb-0">
              <button type="submit" name="approvestudnt" class="btn btn-primary " id="isApprove">Approve</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/fontAwesome.js"></script>
  <script src="../assets/js/sweetalert2.js"></script>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/toggleSidebar.js"></script>
  <script src="../assets/js/dataTables.min.js"></script>
  <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
  <script src="../assets/js/studinfo-admin.js"></script>
  <script>
    $(".btnviewer").click(function() {
      let img = $(this).attr("id");
      if (img) {
        $(".enrolleimagePreview").attr("src", "../assets/imgs/" + img);
      } else {
        $(".enrolleimagePreview").attr(
          "src",
          "../assets/imgs/Andres_Soriano_Colleges_of_Bislig_(crest).jpg"
        );
      }
    });

    <?php
    if (isset($_SESSION['registered'])) {
      $msg = $_SESSION['registered'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['registered']);
    }

    if (isset($_SESSION['approved'])) {
      $msg = $_SESSION['approved'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['approved']);
    }
    ?>
  </script>
</body>

</html>