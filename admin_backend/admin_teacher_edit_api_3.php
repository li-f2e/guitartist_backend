<?php
require '__admin_required.php';
require 'init.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];





if(!empty($_POST['teacher_music'])){
$sql = "UPDATE `member_list` 
SET 
`teacher_experience`=?,
`teacher_perform`=?,
`teacher_award`=?,
`teacher_music`=?
 WHERE `email`=? ";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['teacher_experience'],
    $_POST['teacher_perform'], 
    $_POST['teacher_award'], 
    $_POST['teacher_music'], 
    $_POST['email']
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

}else{

    $sql = "UPDATE `member_list` 
    SET 
    `teacher_experience`=?,
    `teacher_perform`=?,
    `teacher_award`=?
     WHERE `email`=? ";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        $_POST['teacher_experience'],
        $_POST['teacher_perform'], 
        $_POST['teacher_award'], 
        $_POST['email']
    ]); 

    if ($stmt->rowCount() == 1) {
        $result['success'] = true;
        $result['code'] = 200;
        $result['info'] = '修改成功';
    } else {
        $result['code'] = 420;
        $result['info'] = '資料沒有修改';
    }

}



echo json_encode($result, JSON_UNESCAPED_UNICODE);
