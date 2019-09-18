<?php
// 這支程式是來判斷有沒有登入

if (!isset($_SESSION)) {
    session_start();  // 如果SESSION還沒設定, 啟動SESSION
}
if (!isset($_SESSION['loginUser'])) { // 如果還沒有登入, 回index
    header('Location: login.php');
    exit;
}

