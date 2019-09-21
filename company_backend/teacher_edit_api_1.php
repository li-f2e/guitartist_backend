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
`teacher_birthday`=?,
`teacher_introduction`=?,
`teacher_specialty`=?,
`pic`=?
 WHERE `email`=? ";


//圖片upload
//檔案類型
$upload_dir = __DIR__ . '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$filename = '';


//老師 code
if(!empty($_FILES['my_file'])){ // 有沒有上傳
    if(in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許
        
         move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $_FILES['my_file']['name']);
        $filename = $_FILES['my_file']['name'];
     }

 };

//  if(empty($_FILES['my_file']['name'])){
//     $filename = $_SESSION['loginUser']['pic'];
//  };



// 如果沒有輸入必要欄位 -> 將上方的$result轉為json -> 結束這支程式
// if (empty($_POST['name']) || empty($_POST['id'])) {
//     echo json_encode($result, JSON_UNESCAPED_UNICODE); // json_encode 將 array 轉換成 json,  JSON_UNESCAPED_UNICODE 跳脫中文字
//     exit;
// }

$stmt = $pdo->prepare($sql);

// if ($filename == '') {
//     $stmt->execute([
//         $_POST['teacher_birthday'],
//         $_POST['teacher_introduction'],
//         $_POST['teacher_specialty'],
//         $_SESSION['loginUser']['pic'],
//         $_POST['email']
//     ]);
// } else {
//     $stmt->execute([
//         $_POST['teacher_birthday'],
//         $_POST['teacher_introduction'],
//         $_POST['teacher_specialty'],
//         $filename,
//         $_POST['email']
//     ]);
// }
// ;


if($filename == '')
{
    $stmt->execute([
    $_POST['teacher_birthday'],
    $_POST['teacher_introduction'],
    $_POST['teacher_specialty'],
    $_SESSION['loginUser']['pic'],
    $_POST['email']
    ]);
}
    else{
    $stmt->execute([
    $_POST['teacher_birthday'],
    $_POST['teacher_introduction'],
    $_POST['teacher_specialty'],
    $filename,
    $_POST['email']
]);
$_SESSION['loginUser']['pic'] = $filename;
}


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
