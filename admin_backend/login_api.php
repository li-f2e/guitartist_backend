<?php
require 'init.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
    'href' => 'selection.php',
];
// 必填欄位, 沒填寫則不往下執行
// if(empty($_POST['email']) || empty($_POST['password'])){
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }

$sql = "SELECT `sid`, `is_admin`,`is_company`, `is_teacher`, `is_hall_owner`, `is_hire`, `is_suspended`, `email`, `password`, `pic`, `teacher_music` FROM `member_list` WHERE `email`=? AND `password`=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['email'],
    $_POST['password'],
]);
$row = $stmt->fetch();
// 
// echo '<pre>',print_r($stmt->rowCount()),'<pre>';

// if (!empty($row)) { // 如果回傳的row不是空值 => 代表有撈到東西 => 有找到相對應的帳號密碼
//     $_SESSION['loginUser'] = $row; // 將找到的row設定到SESSION自訂的變數中
//     $result['success'] = true;
//     $result['code'] = 200;
//     $result['info'] = '登入成功';
// } else {
//     $result['code'] = 420;
//     $result['info'] = '登入失敗';
// }

if ($row['is_suspended'] == 1) {
    $result['info'] = '帳號已被封鎖, 請洽客服中心';
} else if (!empty($row)) {
    $_SESSION['loginUser'] = $row;
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '登入成功';

    $num = $_SESSION['loginUser']['is_admin'] * 8 +
            $_SESSION['loginUser']['is_company'] * 6 +
            $_SESSION['loginUser']['is_teacher'] * 4 +
            $_SESSION['loginUser']['is_hall_owner'] * 2 +
            $_SESSION['loginUser']['is_hire'];

    switch($num){
        case 1:
            $result['href'] = '#';
            break;
        case 2:
            $result['href'] = 'hall_owner_index.php';
            break;
        case 4:
            $result['href'] = 'teacher_index.php';
            break;
        case 6:
            $result['href'] = 'company_index.php';
            break;
        case 8:
            $result['href'] = 'admin_company_list.php';
            break;
        default:
            $result['href'] = 'selection.php';
            break;
    }

    // if ($_SESSION['loginUser']['is_company'] == 1 && $_SESSION['loginUser']['is_teacher'] == 0 && $_SESSION['loginUser']['is_hall_owner'] == 0 && $_SESSION['loginUser']['is_hire'] == 0 && $_SESSION['loginUser']['is_admin'] == 0) {
    //     $result['href'] = 'company_index.php';
    // } else if ($_SESSION['loginUser']['is_company'] == 0 && $_SESSION['loginUser']['is_teacher'] == 1 && $_SESSION['loginUser']['is_hall_owner'] == 0 && $_SESSION['loginUser']['is_hire'] == 0 && $_SESSION['loginUser']['is_admin'] == 0) {
    //     $result['href'] = 'teacher_index.php';
    // } else if ($_SESSION['loginUser']['is_company'] == 0 && $_SESSION['loginUser']['is_teacher'] == 0 && $_SESSION['loginUser']['is_hall_owner'] == 1 && $_SESSION['loginUser']['is_hire'] == 0 && $_SESSION['loginUser']['is_admin'] == 0) {
    //     $result['href'] = 'hall_owner_index.php';
    // } else if ($_SESSION['loginUser']['is_company'] == 0 && $_SESSION['loginUser']['is_teacher'] == 0 && $_SESSION['loginUser']['is_hall_owner'] == 0 && $_SESSION['loginUser']['is_hire'] == 1 && $_SESSION['loginUser']['is_admin'] == 0) {
    //     $result['href'] = 'hire_index.php';
    // } else if($_SESSION['loginUser']['is_company'] == 0 && $_SESSION['loginUser']['is_teacher'] == 0 && $_SESSION['loginUser']['is_hall_owner'] == 0 && $_SESSION['loginUser']['is_hire'] == 0 && $_SESSION['loginUser']['is_admin'] == 1){
    //     $result['href'] = 'admin_company_list.php';
    // }
} else {
    $result['code'] = 420;
    $result['info'] = '登入失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
