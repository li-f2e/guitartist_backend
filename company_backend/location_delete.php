<?php

require '__admin_required.php';
require 'init.php';

$sid = isset($_GET['location_sid']) ? intval($_GET['location_sid']) : 0;

if(! empty($sid)) {
    $sql = "DELETE FROM `location` WHERE `location_sid`=$sid";
    $pdo->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);