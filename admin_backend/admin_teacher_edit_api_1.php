<?php
require '__admin_required.php';

require 'init.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

//圖片upload
//檔案類型
$upload_dir = __DIR__ . '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];

$filename = '';
//老師 code
if (!empty($_FILES['my_file']['name'])) { // 有沒有上傳
    if (in_array($_FILES['my_file']['type'], $allowed_types)) {
        // 檔案類型是否允許
        $new_filename = sha1(uniqid() . $_FILES['my_file']['name']);
        $new_ext = $exts[$_FILES['my_file']['type']];

        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $new_filename . $new_ext);
        $filename = $new_filename . $new_ext;

        $sql = "UPDATE `member_list` SET
        `teacher_name`=?,
        `password`=?,
        `teacher_birthday`=?,
        `teacher_introduction`=?,
        `teacher_specialty`=?,
        `teacher_pic`=?
        WHERE `sid`=? ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['teacher_name'],
            $_POST['password'],
            $_POST['teacher_birthday'],
            $_POST['teacher_introduction'],
            $_POST['teacher_specialty'],
            $filename,
            $_POST['sid'],
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
} else {

    $sql = "UPDATE `member_list` SET
    `teacher_name`=?,
    `password`=?,
    `teacher_birthday`=?,
    `teacher_introduction`=?,
    `teacher_specialty`=?
    WHERE `sid`=? ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $_POST['teacher_name'],
        $_POST['password'],
        $_POST['teacher_birthday'],
        $_POST['teacher_introduction'],
        $_POST['teacher_specialty'],
        $_POST['sid'],
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
;

// 沒有修改內容 = 沒有更新內容 => rowCount = 0;

echo json_encode($result, JSON_UNESCAPED_UNICODE);
