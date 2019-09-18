<?php
require 'init.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
    'href' => 'selection-copy.php',
];
// 必填欄位, 沒填寫則不往下執行
// if(empty($_POST['email']) || empty($_POST['password'])){
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }

$sql = "SELECT `sid`, `is_company`, `is_teacher`, `is_suspended`, `is_hall_owner`, `email`, `password`, `pic`, `teacher_music` FROM `member_list` WHERE `email`=? AND `password`=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['email'],
    $_POST['password'],
]);
$row = $stmt->fetch();
// if (!empty($row)) { // 如果回傳的row不是空值 => 代表有撈到東西 => 有找到相對應的帳號密碼
//     $_SESSION['loginUser'] = $row; // 將找到的row設定到SESSION自訂的變數中
//     $result['success'] = true;
//     $result['code'] = 200;
//     $result['info'] = '登入成功';
// } else {
//     $result['code'] = 420;
//     $result['info'] = '登入失敗';
// }

if($row['is_suspended'] == 1){
    $result['info'] = '帳號已被封鎖, 請洽客服中心';
} else if (!empty($row)) {
    $_SESSION['loginUser'] = $row;
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '登入成功';

    // $num = $_SESSION['loginUser']['is_company'] * 4 +
    //         $_SESSION['loginUser']['is_teacher'] * 2 +
    //         $_SESSION['loginUser']['is_hall_owner'];

    // switch($num){
    //     case 1:

    //         break;

    // }

    if ($_SESSION['loginUser']['is_company'] == 1 && $_SESSION['loginUser']['is_teacher'] == 0 && $_SESSION['loginUser']['is_hall_owner'] == 0) {
        $result['href'] = 'company_index.php';
    } else if ($_SESSION['loginUser']['is_company'] == 0 && $_SESSION['loginUser']['is_teacher'] == 1 && $_SESSION['loginUser']['is_hall_owner'] == 0) {
        $result['href'] = 'teacher_index.php';
    } else if ($_SESSION['loginUser']['is_company'] == 0 && $_SESSION['loginUser']['is_teacher'] == 0 && $_SESSION['loginUser']['is_hall_owner'] == 1) {
        $result['href'] = 'hall_owner_index.php';
    }
} else {
    $result['code'] = 420;
    $result['info'] = '登入失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
