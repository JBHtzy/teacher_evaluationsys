<?php

include('../assets/include/sessionstart.php');
include('../dbcon/dbconnect.php');

if (!isset($_SESSION['id'])) {
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
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
        <div class="bg-white p-4 shadow ">
          <h3 class="my-2 text-uppercase ms-3 mb-3 fw-bold">
            <i class="fa-solid fa-chart-pie me-2 rounded-circle p-2 secondary-bg2"></i>Home
          </h3>
          <div class="container">
            <div class="row g-5 mt-1">
              <div class="col-md-4 oms">
                <div class="p-4 d-flex justify-content-around rounded">
                  <i class="fa-solid fa-users fs-2 border rounded secondary-bg p-2 mb-5"></i>
                  <div>
                    <h6 class="text-center">Teachers</h6>
                    <p class="fs-4 fw-bold text-center">
                      <?php
                      $result = $mysqli->query("SELECT * FROM `teachers`");
                      echo $result->num_rows; ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 oms">
                <div class="p-4 d-flex justify-content-around rounded">
                  <i class="fa-solid fa-users fs-2 border rounded secondary-bg p-2 mb-5"></i>
                  <div>
                    <h6 class="text-center">Students</h6>
                    <p class="fs-4 fw-bold text-center">
                      <?php
                      $result = $mysqli->query("SELECT * FROM `students`");
                      echo $result->num_rows; ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 oms">
                <div class="p-4 d-flex justify-content-around rounded">
                  <i class="fa-solid fa-book fs-2 border rounded secondary-bg p-2 mb-5"></i>
                  <div>
                    <h6 class="text-center">Subjects</h6>
                    <p class="fs-4 fw-bold text-center">
                      <?php
                      $result = $mysqli->query("SELECT * FROM `subjects`");
                      echo $result->num_rows; ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Teacher</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <label for="teachname">Teacher's Name</label>
            <input type="text" name="teachname" id="teachname" class="form-control">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/fontAwesome.js"></script>
  <script src="../assets/js/sweetalert2.js"></script>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/toggleSidebar.js"></script>
  <script>
    <?php
    if (isset($_SESSION['user-admin'])) {
      $msg = $_SESSION['user-admin'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['user-admin']);
    }
    ?>
  </script>
</body>

</html>