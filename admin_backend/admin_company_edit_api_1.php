<?php
require '__admin_required.php';

require 'init.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

// 如果沒有輸入必要欄位 -> 將上方的$result轉為json -> 結束這支程式
// if (empty($_POST['name']) || empty($_POST['id'])) {
//     echo json_encode($result, JSON_UNESCAPED_UNICODE); // json_encode 將 array 轉換成 json,  JSON_UNESCAPED_UNICODE 跳脫中文字
//     exit;
// }

// $sql = "UPDATE `member_list` SET `pic`=?, `brand_1`=?, `brand_2`=?, `brand_3`=? WHERE `sid`=? ";
// $stmt = $pdo->prepare($sql);

//圖片upload
//檔案類型
// $upload_dir = __DIR__ . '/uploads/';
$upload_dir = 'uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];

//老師 code
if (!empty($_FILES['my_file']['name'])) { // 有沒有上傳
    if (in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許
        $filename = sha1(uniqid() . $_FILES['my_file']['name']);
        $new_ext = $exts[$_FILES['my_file']['type']]; // 副檔名
        // move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $_FILES['my_file']['name']);
        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $filename . $new_ext);
        // $filename = $_FILES['my_file']['name'];

        $sql = "UPDATE `member_list` SET `pic`=?,`password`=?, `brand_1`=?, `brand_2`=?, `brand_3`=? WHERE `sid`=? ";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $filename . $new_ext,
            $_POST['password'],
            $_POST['brand_1'],
            $_POST['brand_2'],
            $_POST['brand_3'],
            $_POST['sid'],
        ]);

        if ($stmt->rowCount() == 1) { // 有修改內容
            $result['success'] = true;
            $result['code'] = 200;
            $result['info'] = '修改成功';
        } else {
            $result['code'] = 420;
            $result['info'] = '資料沒有修改';
        }

    } else {
        // 抓到的資料不符合格式的話, 如何處理
    }
} else {
    $sql = "UPDATE `member_list` SET `password`=?, `brand_1`=?, `brand_2`=?, `brand_3`=? WHERE `sid`=? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['password'],
        $_POST['brand_1'],
        $_POST['brand_2'],
        $_POST['brand_3'],
        $_POST['sid'],
    ]);
    if ($stmt->rowCount() == 1) { // 有修改內容
        $result['success'] = true;
        $result['code'] = 210;
        $result['info'] = '修改成功';
    } else {
        $result['code'] = 430;
        $result['info'] = '資料沒有修改';
    }

}


echo json_encode($result, JSON_UNESCAPED_UNICODE);
