<div class="side" id="sidebar-wrapper">
    <div class="pichead text-center py-3">
        <?php
        if (isset($_SESSION['teachrname']) && isset($_SESSION['teachrpicture'])) {
            $userName = $_SESSION['teachrname'];
            $userPicture = $_SESSION['teachrpicture'];
        ?>
            <img src="../assets/imgs/<?= $userPicture ?>" width="100" alt="Profile Picture">
            <p class="w-50 text-center mx-auto mt-2">Welcome, <?= $userName ?></p>
        <?php
        } else {
            echo "User information not found";
        }
        ?>
    </div>
    <div class="divider"></div>
    <div class="list-group">
        <a href="../teachers-pov/teach-homepage.php" class="fw-bold text-white"><i class="mx-1 fa-solid fa-chart-pie"></i>Dashboard</a>
        <a href="teach-settings.php" class="fw-bold text-white"><i class="mx-1 fa-solid fa-gear"></i>Settings</a>
        <a href="../index.php" class="fw-bold text-white"><i class="mx-1 fa-solid fa-chart-pie"></i>Logout</a>
    </div>
</div>