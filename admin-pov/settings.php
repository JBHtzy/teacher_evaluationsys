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
  <title>Admin Settings</title>
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
            <i class="fa-solid fa-chart-pie me-2 rounded-circle p-2 secondary-bg2"></i>Settings
          </h3>
          <div class="container">
            <form method="post" action="../process.php" class="d-flex justify-content-end align-items-center">
              <label for="opening_day" class="fw-bold">Set Opening Date:</label>
              <input type="date" class="form-control mx-3 w-25" name="opening_day" id="opening_day" required>
              <button class="btn btn-success " type="submit" name="setdate">Save</button>
            </form>
            <br>
            <table class="table mt-4" id="tableteacherInfo">
              <thead>
                <tr>
                  <th scope="col">Opening Date:</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <?php
              $result = $mysqli->query("SELECT * FROM `activate_day`");
              ?>
              <tbody>
                <?php
                while ($actday = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?= $actday['opening_day'] ?></td>
                    <td>
                      <a href="../process.php?delete=<?= $actday['id'] ?>" class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                        Delete
                      </a>
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


  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/fontAwesome.js"></script>
  <script src="../assets/js/sweetalert2.js"></script>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/toggleSidebar.js"></script>
  <script src="../assets/js/dataTables.min.js"></script>
  <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#tableteacherInfo').DataTable({
        ordering: false
      });
    });

    <?php
    if (isset($_SESSION['setdate'])) {
      $msg = $_SESSION['setdate'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['setdate']);
    }
    if (isset($_SESSION['delete'])) {
      $msg = $_SESSION['delete'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['delete']);
    }
    ?>
  </script>
</body>

</html>