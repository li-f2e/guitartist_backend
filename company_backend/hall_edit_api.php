<?php
require '__admin_required.php';
require 'init.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

$sql = "UPDATE `member_list` SET `pic`=?, `addr`=?, `hall_introduce`=?, `hall_web`=?, `tel`=?, `alt_tel`=?, `alt_email`=?, `bank_acc`=?, `bank_num`=? WHERE `sid`=? ";


$upload_dir = __DIR__.'/uploads/';


    $allowed_types = [
        'image/png',
        'image/jpeg',
    ];

    $exts = [
        'image/png' => '.png',
        'image/jpeg' => '.jpg',
    ];

    $filename ='';

    if(!empty($_FILES['my_file'])){ // 有沒有上傳
        if(in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許
            
             move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $_FILES['my_file']['name']);
             $filename = $_FILES['my_file']['name'];
         }
    
     };

    
$stmt = $pdo->prepare($sql);

if ($filename == '') {
    $stmt->execute([
        $_SESSION['loginUser']['pic'],
        $_POST['addr'],
        $_POST['hall_introduce'],
        $_POST['hall_web'],
        $_POST['tel'],
        $_POST['alt_tel'],
        $_POST['alt_email'],
        $_POST['bank_acc'],
        $_POST['bank_num'],
        $_POST['sid'],
    ]);
} else {
    $stmt->execute([
    $filename,
    $_POST['addr'],
    $_POST['hall_introduce'],
    $_POST['hall_web'],
    $_POST['tel'],
    $_POST['alt_tel'],
    $_POST['alt_email'],
    $_POST['bank_acc'],
    $_POST['bank_num'],
    $_POST['sid'],
    ]);
    $_SESSION['loginUser']['pic'] = $filename;
}


// $stmt->execute([
//     $filename,
//     $_POST['addr'],
//     $_POST['hall_introduce'],
//     $_POST['hall_web'],
//     $_POST['tel'],
//     $_POST['alt_tel'],
//     $_POST['alt_email'],
//     $_POST['bank_acc'],
//     $_POST['bank_num'],
//     $_POST['sid'],
// ]);



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
