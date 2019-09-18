<?php
require '__admin_required.php';
require '/init.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '沒有輸入姓名',
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

$filename = '';
//老師 code
if (!empty($_FILES['my_file'])) { // 有沒有上傳
    if (in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許
        $new_filename = sha1(uniqid() . $_FILES['my_file']['name']);
        $new_ext = $exts[$_FILES['my_file']['type']];

        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $new_filename . $new_ext);
        $filename = $new_filename . $new_ext;

    }
}
# 如果沒有輸入必要欄位, 就離開
// if(empty($_POST['name'])){
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }

// TODO: 檢查必填欄位, 欄位值的格式

$sql = "INSERT INTO `member_list`(
            `teacher_pic`,
            `teacher_name`,
            `teacher_birthday`,
            `teacher_specialty`,
            `teacher_introduction`,
            `email`,
            `teacher_tel`,
            `teacher_experience`,
            `teacher_perform`,
            `teacher_award`,
            `teacher_music`,
            `is_teacher`

            ) VALUES (?, ?, ?, ?, ?,?, ?, ?, ?, ?,?,? )";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $filename,
    $_POST['teacher_name'],
    $_POST['teacher_birthday'],
    $_POST['teacher_specialty'],
    $_POST['teacher_introduction'],
    $_POST['email'],
    $_POST['teacher_tel'],
    $_POST['teacher_experience'],
    $_POST['teacher_perform'],
    $_POST['teacher_award'],
    $_POST['teacher_music'],
    1,

]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
