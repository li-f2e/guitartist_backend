<?php require '__admin_required.php'; ?>
<?php

require __DIR__.'/init.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '請輸入完整資料',
    'post' => $_POST,
];
if(empty($_POST['course_name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$upload_dir = __DIR__. '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];


if(!empty($_FILES['course_pic'])){ // 有沒有上傳
    if(in_array($_FILES['course_pic']['type'], $allowed_types)) { // 檔案類型是否允許

        $new_filename = sha1(uniqid(). $_FILES['course_pic']['name']);
        $new_ext = $exts[$_FILES['course_pic']['type']];


        move_uploaded_file($_FILES['course_pic']['tmp_name'], $upload_dir. $new_filename. $new_ext);
        $filename=$new_filename.$new_ext;
    }
}







$sql="INSERT INTO `course_tb`(`email`,`course_name`, `course_sort`,`course_begindate`,`course_enddate`,`course_time`, `course_person`, `course_address`, `course_price`, `course_bonus`, `course_describe`, `course_pic`,`created_at`) 
VALUES(?,?,?,?,?,?,?,?,?,?,?,?,NOW())";

$stmt=$pdo->prepare($sql);
$stmt->execute([
    $_SESSION['loginUser']['email'],
    $_POST['course_name'],
    $_POST['course_sort'],
    $_POST['course_begindate'],
    $_POST['course_enddate'],
    $_POST['course_time'],
    $_POST['course_person'],
    $_POST['course_address'],
    $_POST['course_price'],
    $_POST['course_bonus'],
    $_POST['course_describe'],
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