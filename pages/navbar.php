<?php

$login = true;

if (!isset($_SESSION['user_id'])) {
    $login = false;
}

?>

<nav>
    <div class="nav-logo" onclick="window.location.href = '/'">
        <i data-feather="layers"></i>
        <p>BallotBox</p>
    </div>
    <div class="nav-icons">
        <div class="nav-link" onclick="window.location.href = '/'">
            <i height=20 data-feather="home"></i>
        <p>Home</p>
        </div>
        <?php
        if ($login) {
            echo '<div class="nav-link" onclick="window.location.href = \'/home\'">
            <i height=20 data-feather="monitor"></i>
            <p>Dashboard</p>
            </div>';
        }
        ?>
        <div class="nav-link" onclick="window.location.href = '/about'">
            <i height=20 data-feather="info"></i>
        <p>About</p>
        </div>
        <?php
        if ($login) {
            echo '<div class="nav-link" onclick="window.location.href = \'/logout\'">
            <i height=20 data-feather="log-out"></i>
            <p>Logout</p>
            </div>';
        } else {
            echo '<div class="nav-link" onclick="window.location.href = \'/login\'">
            <i height=20 data-feather="log-in"></i>
            <p>Login</p>
            </div>';
        }
        ?>
        </div>
        
    </div>
</nav>