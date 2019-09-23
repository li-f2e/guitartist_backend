<?php
require '__admin_required.php';
require 'init.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

$sql = "UPDATE `member_list` SET
`teacher_experience`=?,
`teacher_perform`=?,
`teacher_award`=?,
`teacher_music`=?
 WHERE `email`=? ";


//圖片upload
//檔案類型
$upload_dir = __DIR__ . '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];




//老師 code


//  if(empty($_FILES['my_file']['name'])){
//     $filename = $_SESSION['loginUser']['pic'];
//  };



// 如果沒有輸入必要欄位 -> 將上方的$result轉為json -> 結束這支程式
// if (empty($_POST['name']) || empty($_POST['id'])) {
//     echo json_encode($result, JSON_UNESCAPED_UNICODE); // json_encode 將 array 轉換成 json,  JSON_UNESCAPED_UNICODE 跳脫中文字
//     exit;
// }

$stmt = $pdo->prepare($sql);

// $stmt->execute([
//     $_POST['teacher_experience'],
//     $_POST['teacher_perform'],
//     $_POST['teacher_award'],
//     $_POST['teacher_music'],
//     $_POST['email']
// ]);

$filename = $_POST['teacher_music'];

if ( $_POST['teacher_music'] =='請在欄位輸入YOUTUBE連結') {
    $stmt->execute([
        $_POST['teacher_experience'],
        $_POST['teacher_perform'],
        $_POST['teacher_award'],
        $_SESSION['loginUser']['teacher_music'],
        $_POST['email']
    ]);
    
} else {
    $stmt->execute([
        $_POST['teacher_experience'],
        $_POST['teacher_perform'],
        $_POST['teacher_award'],
        $filename,
        $_POST['email']
    ]);

    $_SESSION['loginUser']['teacher_music'] = $filename;

// $filename = $_POST['teacher_music'];
// $_SESSION['loginUser']['teacher_music']=$filename;
}
;


// if($filename == '')
// {
//     $stmt->execute([
//     $_POST['teacher_birthday'],
//     $_POST['teacher_introduction'],
//     $_POST['teacher_specialty'],
//     $_SESSION['loginUser']['pic'],
//     $_POST['email']
//     ]);
// }
//     else{
//     $stmt->execute([
//     $_POST['teacher_birthday'],
//     $_POST['teacher_introduction'],
//     $_POST['teacher_specialty'],
//     $filename,
//     $_POST['email']
// ]);
// $_SESSION['loginUser']['pic'] = $filename;
// }


// 沒有修改內容 = 沒有更新內容 => rowCount = 0; 
if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
