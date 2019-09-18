<?php

require '__admin_required.php';
require 'init.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '請確認欄位是否輸入正確',
    'post' => $_POST,
];

# 如果沒有輸入必要欄位, 就離開
if(empty($_POST['location-name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO: 檢查必填欄位, 欄位值的格式

//圖片upload
//檔案類型
$upload_dir = __DIR__ . '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

//$filename = '';

//老師 code
$filename='';
if(!empty($_FILES['my_file'])){ // 有沒有上傳
    if(in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許
        
         move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $_FILES['my_file']['name']);
        $filename = $_FILES['my_file']['name'];
     }
 };


$open=implode(",",  $_POST['open-day']);
 
  

 $sql = "INSERT INTO `location`(
    `email`,
    `location-name`, 
    `location-address`, 
    `location-phone`, 
    `location-information`, 
    `location-people`,
    `location-price`,
    `open-day`,
    `pic`,
    `created-at`
    ) VALUES (?, ?, ?, ?, ?, ?, ?,?,?,NOW())";

$stmt = $pdo->prepare($sql);


$stmt->execute([
        $_SESSION['loginUser']['email'],
        $_POST['location-name'],
        $_POST['location-address'],
        $_POST['location-phone'],
        $_POST['location-information'],
        $_POST['location-people'],
        $_POST['location-price'],
        json_encode($_POST['open-day'], JSON_UNESCAPED_UNICODE),
        $filename,
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