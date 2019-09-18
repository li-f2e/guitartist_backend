<?php
require '__admin_required.php';
require 'init.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

$upload_dir = __DIR__ . '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];

if (!empty($_FILES['my_file']['name'])) { // 如果有上傳
    if (in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許
        $filename = sha1(uniqid() . $_FILES['my_file']['name']);
        $new_ext = $exts[$_FILES['my_file']['type']]; // 副檔名
        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $filename . $new_ext);

        $sql = " UPDATE `member_list` SET `pic`=?,`password`=?, `addr_district`=?, `addr`=?,  `hall_introduce`=?,`hall_web`=?,`tel`=?, `alt_tel`=?, `alt_email`=?, `bank_acc`=?, `bank_num`=? WHERE `sid`=? ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $filename . $new_ext,
            $_POST['password'],
            $_POST['addr_district'],
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
        if ($stmt->rowCount() == 1) { // 有修改內容
            $result['success'] = true;
            $result['code'] = 200;
            $result['info'] = '修改成功';
        } else {
            $result['code'] = 420;
            $result['info'] = '資料沒有修改';
        }

    } else {
        // 如不符合格式, 如何處理
    }

} else {
    $sql = "UPDATE `member_list` SET `password`=?,`addr_district`=?, `addr`=?, `hall_introduce`=?, `hall_web`=?, `tel`=?, `alt_tel`=?, `alt_email`=?, `bank_acc`=?, `bank_num`=? WHERE `sid`=? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['password'],
        $_POST['addr_district'],
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
    if ($stmt->rowCount() == 1) { // 有修改內容
        $result['success'] = true;
        $result['code'] = 210;
        $result['info'] = '修改成功';
    } else {
        $result['code'] = 430;
        $result['info'] = '資料沒有修改';
    }

}
;

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
