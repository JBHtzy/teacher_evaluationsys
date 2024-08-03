<nav class="navbar navbar-expand-lg navbg">
    <div class="container-fluid p-1">
        <a class="navbar-brand ms-3" href="student.php">
            <img src="../assets/imgs/home.png" width="30" alt="">
        </a>

        <div class="collapse navbar-collapse pe-5 justify-content-end" id="navbarNav">
            <li class="nav-item dropdown position-relative">
                <a class="nav-link dropdown-toggle text-white ms-4 fs-4" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i></a>
                <ul class="dropdown-menu dropdown-menu-end position-absolute ">
                    <li>
                        <a class="dropdown-item" href="profile-student.php"><i class="fa-solid fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../index.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="dropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end position-absolute ">
            <li>
                <a class="dropdown-item" href="profile_admin.php"><i class="fa-solid fa-user"></i> Profile</a>
            </li>
            <li>
                <a class="dropdown-item" href="../index.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>