<?php

session_start();

unset($_SESSION['loginUser']);
if (!empty($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    // echo '<pre>', print_r($_SERVER), '</pre>';
} else {
    header('Location: login.php');
}
