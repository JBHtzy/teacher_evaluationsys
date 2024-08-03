<?php

include('./assets/include/sessionstart.php');
include('./dbcon/dbconnect.php');

if (isset($_POST['registerStud'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $uniqid = $username . '@DIST.ascb';
    $mysqli->query("INSERT INTO `users`(`username`, `password`, `role`) VALUES ('$uniqid','$password','student')");

    $mysqli->query("INSERT INTO `students`(`stud_id`,`firstname`, `lastname`, `age`, `gender`, `course`, `yearlvl`, `is_enrolled`) VALUES (LAST_INSERT_ID(),'','','','','','','pending')");

    $_SESSION['registered'] = "Succesfully Registered";
    header('location: admin-pov/studinfo.php');
}

if (isset($_POST['studentform'])) {
    $id = $_SESSION['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $yearlevel = $_POST['yearlevel'];

    $cor = $_FILES['proofenroll']['name'];
    move_uploaded_file($_FILES['proofenroll']['tmp_name'], 'assets/imgs/' . $cor);

    $mysqli->query("UPDATE `students` SET `firstname`='$firstname',`lastname`='$lastname', `proof_img`='$cor',`email`='$email',`age`='$age',`gender`='$gender',`course`='$course',`yearlvl`='$yearlevel',`form_filled`= 1 WHERE stud_id = $id");

    $_SESSION['studforms'] = "Submitted Succesfully. Please wait for approval";
    header('location: index.php');
}

if (isset($_POST['updatestudinfo'])) {
    $id = $_SESSION['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $yearlevel = $_POST['yearlevel'];

    $val = $mysqli->query("SELECT COUNT(*) as count FROM `users` WHERE username = '$username'");
    $row = $val->fetch_assoc();

    $valpass = $password;
    function validatePassword($valpass)
    {
        if (strlen($valpass) < 5) {
            return false;
        }
        if (!preg_match('/[A-Z]/', $valpass)) {
            return false;
        }
        if (!preg_match('/[0-9]/', $valpass)) {
            return false;
        }
        return true;
    }

    if ($row['count'] > 0) {
        $_SESSION['valuser'] = 'Username already taken!';
        echo 'taken';
    } else {
        if (validatePassword($valpass)) {
            $mysqli->query("UPDATE `users` SET `username`='$username',`password`='$password' WHERE id = '$id'");

            $mysqli->query("UPDATE `students` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`age`='$age',`gender`='$gender',`course`='$course',`yearlvl`='$yearlevel' WHERE stud_id = '$id'");
            echo 'available';
            $_SESSION['updatestudforms'] = "Updated Succesfully";
        } else {
            echo "Password is invalid.";
            $_SESSION['valpassw'] = "Password must have at least 5 characters, 1 uppercase letter & number";
        }
    }
    header('location: student-pov/profile-student.php');
}

if (isset($_POST['editadmininfo'])) {
    $id = $_SESSION['id'];
    $uname = $_POST['username'];
    $password = $_POST['cpassword'];

    $mysqli->query("UPDATE `users` SET `username`='$uname',`password`='$password' WHERE id = '$id'");

    $_SESSION['editadmin'] = "Succesfully Updated";
    header('location: admin-pov/profile-admin.php');
}

if (isset($_POST['editteachinfo'])) {
    $id = $_SESSION['id'];
    $uname = $_POST['username'];
    $password = $_POST['cpassword'];

    $mysqli->query("UPDATE `users` SET `username`='$uname',`password`='$password' WHERE id = '$id'");

    $_SESSION['editadmin'] = "Succesfully Updated";
    header('location: teachers-pov/teach-settings.php');
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $res = $mysqli->query("SELECT COUNT(*) as count FROM `users` WHERE username = '$username'");
    $row = $res->fetch_assoc();

    if ($row['count'] > 0) {
        echo 'taken';
    } else {
        echo 'available';
    }
}

if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];

    $data = $mysqli->query("SELECT students.id as id, users.username as user, users.password as pass, users.role as role, students.is_enrolled, students.form_filled as form FROM `students` JOIN users ON students.stud_id = users.id WHERE username = '$uname' AND password = '$password'");
    $getuser = $data->fetch_assoc();

    $data2 = $mysqli->query("SELECT teachers.id as teachid, teachers.name as name, teachers.prof_img as imgs FROM `users` JOIN teachers ON users.id = teachers.user_id WHERE username = '$uname' AND password = '$password'");
    $loggedteach = $data2->fetch_assoc();

    $login_credentials = $mysqli->query("SELECT * FROM `users` WHERE username = '$uname' AND password = '$password'");

    if (mysqli_num_rows($login_credentials) === 1) {
        $row = $login_credentials->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['uname'] = $getuser['user'];

        if ($row['role'] === 'admin') {
            $_SESSION['user-admin'] = 'Welcome ADMIN';
            header('location: admin-pov/admin-homepage.php');
        } else if ($row['role'] === 'student') {
            if ($getuser['is_enrolled'] == 'enrolled') {
                $_SESSION['user-student'] = 'Welcome' . ' ' . $_SESSION['uname'];
                header('location: restrict.php');
            } else {
                if ($getuser['form'] == 1) {
                    $_SESSION['checkfill'] = 'Proceed to Office for approval. Thank you';
                    header('location: index.php');
                } else if ($getuser['form'] == 0) {
                    header('location: prompt.php');
                }
            }
        } else if ($row['role'] === 'teacher') {
            $_SESSION['teaId'] = $loggedteach['teachid'];
            $_SESSION['teachrname'] = $loggedteach['name'];
            $_SESSION['teachrpicture'] = $loggedteach['imgs'];

            $_SESSION['user-teacher'] = 'Welcome Teacher';
            header('location: teachers-pov/teach-homepage.php');
        }
    } else {
        $_SESSION['validate_user'] = 'Username/Password does not exist.';
        header('location: index.php');
    }
}

if (isset($_POST['addTeacher'])) {
    $teachname = $_POST['teachname'];
    $profileimg = $_FILES['user_prof']['name'];
    $_SESSION['imgname'] = $profileimg;
    move_uploaded_file($_FILES['user_prof']['tmp_name'], 'assets/imgs/' . $profileimg);

    $teachr = $teachname . '@asc.bislig';
    $test2 = $mysqli->query("INSERT INTO `users`(`username`, `password`, `role`) VALUES ('$teachr ','ascb@1995','teacher')");

    $test = $mysqli->query("INSERT INTO `teachers`(`user_id`,`name`, `prof_img`) VALUES (LAST_INSERT_ID(),'$teachname','$profileimg')");

    $_SESSION['teacherAdd'] = 'Teacher Added Successfully';
    header('location: admin-pov/teachers-page.php');
}

if (isset($_POST['addsubjects'])) {
    $teacherId = $_POST['teachid'];
    $subjects = $_POST['subjects'];
    $mysqli->query("INSERT INTO `subjects`(`subject_desc`, `teacher_id`) VALUES ('$subjects','$teacherId')");

    $_SESSION['addsubs'] = 'Subjects Added Successfully';
    header('location: admin-pov/teachers-page.php');
}

if (isset($_GET['getteachid'])) {
    $id = $_GET['getteachid'];
    echo json_encode($id);
}

if (isset($_GET['getteach'])) {
    $id = $_GET['getteach'];

    $res = $mysqli->query("SELECT teachers.id as teachid, GROUP_CONCAT(subjects.subject_desc) as subjects, teachers.name as teachname, users.* FROM `teachers` JOIN subjects ON teachers.id = subjects.teacher_id JOIN users ON teachers.user_id = users.id WHERE teachers.id = '$id ' GROUP BY teachid;");
    $getsub = $res->fetch_assoc();

    $teachr = $getsub['teachname'];
    $subs = $getsub['subjects'];
    $teachuser = $getsub['username'];
    $teachpass = $getsub['password'];

    echo json_encode($teachr . '_' . $subs . '_' . $teachuser . '_' . $teachpass);
}

if (isset($_GET['getstudinfo'])) {
    $id = $_GET['getstudinfo'];

    $studinfos = $mysqli->query("SELECT * FROM `students` JOIN users ON students.stud_id = users.id WHERE users.id = '$id'");
    $studinfo = $studinfos->fetch_assoc();
    $fname = $studinfo['firstname'];
    $lname = $studinfo['lastname'];
    $email = $studinfo['email'];
    $age = $studinfo['age'];
    $gender = $studinfo['gender'];
    $yearlevel = $studinfo['yearlvl'];
    $course = $studinfo['course'];
    $fetchid = $studinfo['stud_id'];
    $enrolled = $studinfo['is_enrolled'];
    $temp = $studinfo['password'];

    echo json_encode($fname . '_' . $lname . '_' . $email  . '_' . $age . '_' . $gender . '_' . $yearlevel . '_' . $course . '_' . $fetchid . '_' . $enrolled . '_' . $temp);
}

if (isset($_GET['teachcomms'])) {
    $cardid = $_GET['teachcomms'];

    $result = $mysqli->query("SELECT teachers.name as teach, subjects.subject_desc as subs FROM `teachers` JOIN subjects ON teachers.id = subjects.teacher_id WHERE teachers.id = '$cardid'");
    $all = $result->fetch_assoc();

    $teach = $all['teach'];

    echo json_encode($cardid . '_' . $teach);
}

if (isset($_POST['submitcomms'])) {
    $cardid = $_POST['cardid'];
    $reaction = $_POST['reaction'];
    $comment = $_POST['comment'];
    $subs = $_POST['selectedSubject'];

    $studid = $_SESSION['id'];

    $mysqli->query("INSERT INTO `reactions`(`feels`, `comments`, `stud_id`, `subject`, `teacherid`, `date`) VALUES ('$reaction','$comment','$studid','$subs','$cardid',now())");

    $_SESSION['comms'] = 'Submitted';
    header('location: student-pov/student.php');
}

if (isset($_POST['setdate'])) {
    $openingDay = $_POST["opening_day"];

    $mysqli->query("INSERT INTO activate_day (opening_day) VALUES ('$openingDay') ON DUPLICATE KEY UPDATE opening_day='$openingDay'");

    $_SESSION['setdate'] = 'Submitted';
    header('location: admin-pov/settings.php');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM `activate_day` WHERE id = '$id'");

    $_SESSION['delete'] = "Successfully Deleted.";
    header('location: admin-pov/settings.php');
}

if (isset($_POST['approvestudnt'])) {
    $id = $_POST['fetchid'];
    $mysqli->query("UPDATE `students` SET `is_enrolled`='enrolled' WHERE stud_id = '$id'");

    $_SESSION['approved'] = 'Student Approved';
    header('location: admin-pov/studinfo.php');
}
