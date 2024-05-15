<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['user'])) {
        // If not logged in, redirect to login page
        header('location: ' . SITEURL . 'login.php');
        exit();
    }
?>
