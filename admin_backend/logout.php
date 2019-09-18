<?php
session_start();
unset($_SESSION['loginUser']);
if (!empty($_SERVER['HTTP_REFERER'])) {
    header('Location: login.php');
} 