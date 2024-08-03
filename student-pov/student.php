<?php

include('../assets/include/sessionstart.php');
include('../dbcon/dbconnect.php');

if (!isset($_SESSION['id'])) {
  header('location: ../index.php');
}

$datenow = $mysqli->query("SELECT DATE_FORMAT(now(), '%b %d, %Y') as datenow")->fetch_assoc();

$teachers = $mysqli->query("SELECT teachers.id as teachid, GROUP_CONCAT(subjects.subject_desc) as subjects, teachers.name as teachname, teachers.prof_img as teachimg FROM `teachers` JOIN subjects ON teachers.id = subjects.teacher_id GROUP BY teachid");
$teacherSubjects = [];

while ($teach = $teachers->fetch_assoc()) {
  $teacherId = $teach['teachid'];
  $teacherName = $teach['teachname'];

  $teacherSubjects[$teacherId]['name'] = $teacherName;
  $teacherSubjects[$teacherId]['subjects'] = explode(',', $teach['subjects']);
  if (isset($teach['teachimg'])) {
    $teacherSubjects[$teacherId]['teachimg'] = $teach['teachimg'];
  } else {
    $teacherSubjects[$teacherId]['teachimg'] = "../assets/imgs/user.png";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Homepage</title>
  <link rel="stylesheet" href="../assets/css/student-dash.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/googleFonts.css" />
</head>

<body>

  <?php include('stud-navbar.php') ?>
  <div class="container p-4">
    <div class="subtitle">
      <h3 class="fw-bold text-white text-center  mb-3">List of Teachers</h3>
    </div>
    <div class="row">
      <?php foreach ($teacherSubjects as $teacherId => $teacherData) { ?>
        <div class="col-xxl-3 col-xl-4 col-md-6 text-center mt-2">
          <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
              <div class="text-center mb-4">
                <img src="../assets/imgs/<?= $teacherData['teachimg']; ?>" class="card-img-top mx-auto teachrImg rounded">
              </div>
              <h5 class=" card-title text-capitalize"><?= $teacherData['name']; ?></h5>
              <div class="d-flex flex-column justify-content-end  gap-3">
                <label for="subjectDropdown" class="text-start fw-bold">Subjects:</label>
                <select name="subjects" class="form-select subjectDropdown" id="subjectDropdown<?= $teacherId; ?>">
                  <option value="" selected hidden>Choose a Subject</option>
                  <?php foreach ($teacherData['subjects'] as $subject) { ?>
                    <option value="<?= $subject; ?>"><?= $subject; ?></option>
                  <?php } ?>
                </select>
                <button class="btn btn-primary" id="<?= $teacherId; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="retrieve(<?= $teacherId ?>);">
                  <i class="fa-solid fa-pen"></i>
                  Evaluate
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-white d-flex align-items-start">
          <div class="modal-title fs-5" id="exampleModalLabel">
            <p id="teachname" class="text-uppercase"></p>
            <p id="selectedSubjectDisplay" class=" mb-0"></p>
          </div>
          <h1 class=" fs-5">Date: <?= $datenow['datenow'] ?></h1>
        </div>
        <div class="modal-body">
          <span class="fw-bold">Choose one of the reacts and comment down why you choose it.</span> <br>
          <span class="fst-italic mt-0">(Note: Please comment down as honestly and truthfully as possible so we can provide a better service for you.)</span>
          <form action="../process.php" method="post">
            <input type="hidden" name="cardid" id="cardid">
            <div class="row p-4 d-flex justify-content-around text-center mx-auto g-3">
              <div class="col-4">
                <img src="../assets/imgs/3_01.png" width="50" alt="heart">
                <div class="form-check fgroups">
                  <input class="form-check-input " type="radio" name="reaction" id="love" value="outstanding">
                  <label class="form-check-label" for="love">
                    Outstanding
                  </label>
                </div>
              </div>
              <div class="col-4">
                <img src="../assets/imgs/3_02.png" width="50" alt="haha">
                <div class="form-check fgroups">
                  <input class="form-check-input " type="radio" name="reaction" id="funny" value="very satisfactory">
                  <label class="form-check-label" for="funny">
                    Very Satisfactory
                  </label>
                </div>
              </div>
              <div class="col-4">
                <img src="../assets/imgs/3_03.png" width="50" alt="sad">
                <div class="form-check fgroups">
                  <input class="form-check-input " type="radio" name="reaction" id="sad" value="satisfactory">
                  <label class="form-check-label" for="sad">
                    Satisfactory
                  </label>
                </div>
              </div>
              <div class="col-4">
                <img src="../assets/imgs/3_04.png" width="50" alt="angry">
                <div class="form-check fgroups">
                  <input class="form-check-input " type="radio" name="reaction" id="angry" value="needs improvements">
                  <label class="form-check-label" for="angry">
                    Needs Improvement
                  </label>
                </div>
              </div>
              <div class="col-4">
                <img src="../assets/imgs/3_05.png" width="50" alt="poor">
                <div class="form-check fgroups">
                  <input class="form-check-input " type="radio" name="reaction" id="poor" value="poor">
                  <label class="form-check-label" for="poor">
                    Poor
                  </label>
                </div>
              </div>
            </div>
            <input type="hidden" name="selectedSubject" id="selectedSubjectInput" value="">
            <div class="form-floating">
              <textarea class="form-control" name="comment" id="floatingTextarea2" style="height: 150px"></textarea>
              <label for="floatingTextarea2" class="fst-italic">Say something...</label>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submitcomms" class="btn btn-success" id="submitBtn">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/fontAwesome.js"></script>
  <script src="../assets/js/sweetalert2.js"></script>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/student.js"></script>
  <script>
    <?php

    if (isset($_SESSION['user-student'])) {
      $msg = $_SESSION['user-student'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['user-student']);
    }

    if (isset($_SESSION['comms'])) {
      $msg = $_SESSION['comms'];
      echo "Swal.fire({icon:'success', title:'$msg', showConfirmButton: false,
            timer: 1500});";
      unset($_SESSION['comms']);
    }
    ?>
  </script>
</body>

</html>