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
  <title>Fillup Forms</title>
  <link rel="stylesheet" href="./assets/css/register.css" />
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/css/googleFonts.css" />
</head>

<body>
  <div class="container">
    <div class="card box shadow my-1">
      <h5 class="fw-bold caption-top">Forms<span class="text-danger">*</span></h5>

      <form action="./process.php" method="POST" enctype="multipart/form-data" class="row g-3 ">
        <div class="col-md-6">
          <label for="firstname" class="form-label">First name</label>
          <input type="text" name="firstname" class="form-control" id="firstname" required />
        </div>
        <div class="col-md-6">
          <label for="lastname" class="form-label">Last name</label>
          <input type="text" name="lastname" class="form-control" id="lastname" required />
        </div>
        <div class="col-md-4">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" required />
        </div>
        <div class="col-md">
          <label for="age" class="form-label">Age</label>
          <input type="text" name="age" class="form-control" id="age" required />
        </div>
        <div class="col-md-3">
          <label for="gender" class="form-label">Gender</label>
          <select class="form-select" name="gender" aria-label="Default select example" id="gender" required>
            <option value="">Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="yearlevel" class="form-label">Year Level</label>
          <input type="text" name="yearlevel" class="form-control" id="yearlevel" required />
        </div>
        <div class="col-md-5 ">
          <label for="proofenroll" class="form-label">Proof of Enrollment/COR:</label>
          <input type="file" class="form-control" accept="image/*" name="proofenroll" id="proofenroll" onchange="previewImage(event)">
        </div>
        <div class="col-md-4 ms-3">
          <label for="course" class="form-label">Course</label>
          <input type="text" name="course" class="form-control" id="course" required />
        </div>

        <div class="d-flex align-items-end ">
          <div class="col-md-6  content-img">
            <div id="imagePreview" style="width:400px; height:200px; border-radius: 5px; border: 1px solid;"></div>
          </div>
          <div class="col-md-5 text-center mx-auto">
            <button type="submit" class="btn btn-success my-2 w-25" name="studentform">
              Submit
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/fontAwesome.js"></script>
  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/sweetalert2.js"></script>
  <script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById("imagePreview");
        output.style.display = "block";
        output.innerHTML =
          '<img src="' +
          reader.result +
          '" style="width:400px; height:200px;border-radius: 5px; aspect-ratio: 3/2; object-fit: cover;">';
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    <?php
    if (isset($_SESSION['studforms'])) {
      $msg = $_SESSION['studforms'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 2000});";
      unset($_SESSION['studforms']);
    }
    ?>
  </script>
</body>

</html>