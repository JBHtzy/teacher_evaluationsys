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
        <div class="bg-white p-4 shadow ">
          <h3 class="my-2 text-uppercase ms-3 mb-3 fw-bold">
            <i class="fa-solid fa-chart-pie me-2 rounded-circle p-2 secondary-bg2"></i>Teacher's Information
          </h3>
          <div class="container ">
            <div class="d-flex justify-content-end my-3">
              <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createteach">
                <i class="fa-solid fa-plus"></i>
                Add Teacher
              </button>
            </div>
            <table class="table" id="tableteacherInfo">
              <thead>
                <tr>
                  <th scope="col">Teacher Info</th>
                  <th scope="col"></th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <?php
              $result = $mysqli->query("SELECT * FROM `teachers`");
              ?>
              <tbody>
                <?php
                while ($teachers = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td>
                      <img src="../assets/imgs/<?= $teachers['prof_img'] ?>" width="70">
                    </td>
                    <td><?= $teachers['name'] ?></td>
                    <td>
                      <button class="btn btn-info btnviewer" id="<?= $teachers['prof_img']; ?>" data-bs-toggle="modal" data-bs-target="#viewSubjs" onclick="retrieve(<?= $teachers['id'] ?>);">
                        <i class="fa-solid fa-eye"></i>
                        View
                      </button>
                      <button class="btn btn-primary" value="<?= $teachers['id']; ?>" data-bs-toggle="modal" data-bs-target="#addsubjects" onclick="retrieveid(<?= $teachers['id'] ?>);">
                        <i class="fa-solid fa-plus"></i>
                        Subjects
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


  <!--add teachr -->
  <div class="modal fade" id="createteach" tabindex="-1" aria-labelledby="createteachLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold text-white" id="createteachLabel">Add Teacher</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="content-bg d-flex justify-content-around w-100">
            <div class="content-img">
              <div id="imagePreview" style="width:200px; height:200px;border-radius: 10px; border: 1px solid;"></div>
            </div>
            <form action="../process.php" method="post" class="my-3" enctype="multipart/form-data">
              <div class="input-group mb-3 ">
                <input type="file" class="form-control" accept="image/*" name="user_prof" id="inputGroupFile01" onchange="previewImage(event)">
              </div>
              <div class="row">
                <div class="col-7">
                  <label for="teachname">Teacher's Name</label>
                  <input type="text" name="teachname" id="teachname" class="form-control">
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="addTeacher" class="btn btn-primary">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- add subject -->
  <div class="modal fade" id="addsubjects" tabindex="-1" aria-labelledby="addsubjectsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold text-white" id="addsubjectsLabel">Add Subjects</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../process.php" method="post">
            <input type="hidden" name="teachid" id="teachid">
            <label for="subjects">Subject</label>
            <input type="text" name="subjects" id="subjects" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="addsubjects" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- view modal -->
  <div class="modal fade" id="viewSubjs" tabindex="-1" aria-labelledby="viewSubjsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold text-white" id="viewSubjsLabel">Teacher's Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-5">
          <div class="content-bg d-flex justify-content-around w-100">
            <div class="content-img ">
              <img src="" class="getimg" style="width:200px; height:200px;border-radius: 10px;">
            </div>
            <div class="row ms-4">
              <div class="col-6">
                <label for="getteach">Teacher's Name</label>
                <input type="text" name="teachname" id="getteach" class="form-control" readonly>
              </div>
              <div class="col-5 ">
                <label for="getsubs">Subjects Handled:</label>
                <select class="form-select" name="teachsubs" id="getsubs">
                  <option value=""></option>
                </select>
              </div>
              <span class="text-dark fw-bold mt-3">Account Details:</span>
              <div class="col-6">
                <label for="teachuser">Temp Username:</label>
                <input type="text" id="teachuser" class="form-control" readonly>
              </div>
              <div class="col-5 position-relative">
                <label for="opassword">Temp Pass:</label>
                <input type="password" id="opassword" class="form-control" readonly>
                <span class="position-absolute top-50 end-0 translate-middle-y m-2"><i class="fa-sharp fa-solid fa-eye border-start px-2" id="eyetoggle"></i></span>
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
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/toggleSidebar.js"></script>
  <script src="../assets/js/dataTables.min.js"></script>
  <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
  <script src="../assets/js/teachersinfo-admin.js"></script>
  <script>
    <?php
    if (isset($_SESSION['teacherAdd'])) {
      $msg = $_SESSION['teacherAdd'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['teacherAdd']);
    }
    if (isset($_SESSION['addsubs'])) {
      $msg = $_SESSION['addsubs'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['addsubs']);
    }
    ?>
  </script>
</body>

</html>