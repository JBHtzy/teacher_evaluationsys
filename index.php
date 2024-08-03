<?php

include('./dbcon/dbconnect.php');
include('./assets/include/sessionstart.php');

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
  <link rel="shortcut icon" href="./assets/imgs/books.png" type="image/x-icon">
</head>

<body>
  <div class="container">
    <div class="box shadow align-items-center">
      <div class="leftside text-center text-white p-3 mt-5">
        <h5 class="fw-bold title">Online Teachers Evaluation System</h5>
        <img src="./assets/imgs/pngimg.com - teacher_PNG32.png" alt="Something image" />
      </div>

      <div class="header">
        <h2 class="text-center text-uppercase">Login</h2>

        <form action="process.php" method="post" class="loginform">
          <label for="username" class="text-white">Username:</label>
          <input type="text" name="username" class="form-control" id="username" required />
          <span class="usericon"><i class="fa-solid fa-user border-start px-2"></i></span>
          <br />

          <label for="opassword" class="text-white">Password:</label>
          <input type="password" name="password" class="form-control" id="opassword" required />
          <span><i class="fa-sharp fa-solid fa-eye border-start px-2" id="eyetoggle" aria-hidden="true"></i></span>
          <br />

          <div class="text-center">
            <button type="submit" name="login" class="btn mb-3">Login</button>
            <br />
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/fontAwesome.js"></script>
  <script src="./assets/js/sweetalert2.js"></script>
  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/main.js"></script>
  <script>
    <?php
    if (isset($_SESSION['registered'])) {
      $msg = $_SESSION['registered'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['registered']);
    }

    if (isset($_SESSION['validate_user'])) {
      $msg = $_SESSION['validate_user'];
      echo "Swal.fire({
                icon:'warning', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 1500});";
      unset($_SESSION['validate_user']);
    };

    if (isset($_SESSION['studforms'])) {
      $msg = $_SESSION['studforms'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['studforms']);
    }

    if (isset($_SESSION['checkfill'])) {
      $msg = $_SESSION['checkfill'];
      echo "Swal.fire({
        icon: 'warning',
        title: 'Pending Account',
        text: '$msg',
      });";
      unset($_SESSION['checkfill']);
    }
    ?>
  </script>
</body>

</html>