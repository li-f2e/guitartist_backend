<?php
require '__admin_required.php';
require_once __DIR__ . "/init.php"; ?> 

<?php


$result = [
    'success' => false,
    'code' => 400,
    'info' => '請輸入完整資料',
    'post' => $_POST,
];

    $sql="UPDATE `job_list` SET
    `email`=?,
    `job_name`=?, 
    `job_class`=?,
    `job_introduce`=?,
    `job_experience`=?, 
    `job_pay`=?, 
    `job_pay_up`=?, 
    `job_num`=?, 
    `job_full-part`=?, 
    `job_urgent`=?
    WHERE `sid`=?"; 
    
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        $_POST['email'],
        $_POST['job_name'],
        $_POST['job_class'],
        $_POST['job_introduce'],
        $_POST['job_experience'],
        $_POST['job_pay'],
        $_POST['job_pay_up'],
        $_POST['job_num'],
        $_POST['job_full-part'],
        $_POST['job_urgent'],
        $_POST['sid'],
    ]);
    if($stmt->rowCount()==1){
        $result['success'] = true;
        $result['code'] = 200;
        $result['info'] = '新增成功';
    } else {
        $result['code'] = 420;
        $result['info'] = '新增失敗';
    }

    echo json_encode($result, JSON_UNESCAPED_UNICODE);