<?
    // echo "<h1>Hello I'm upload.php<h1>";

    // 頁面顯示成json
    header('Content-Type: application/json');

    $allowed = ['png', 'jpg', 'zip', 'jpeg'];
    $processed =[];

    // 測試
    // print_r($_FILES['files']);
    // die();

    foreach($_FILES['files']['name'] as $key=>$name){
        if($_FILES['files']['error'][$key] === 0){

            // 測試
            // echo $tmp = $_FILES['files']['tmp_name'][$key]."\n";
            // 圖檔站存名稱
            $tmp = $_FILES['files']['tmp_name'][$key];

            //取出副檔名
            $ext = explode('.', $name);
            //印出副檔名
            // print_r($ext);
            //副檔名變小寫
            $ext = strtolower( end($ext) ) ;
            
            //測試
            // echo $file = uniqid('', true) . time() . '.' . $ext, "\n";
            // $file = uniqid('', true) . time() . '.' . $ext;

            $file = $name. '.' . $ext;

            if( in_array($ext, $allowed) && move_uploaded_file($tmp, "upLoad_imgs/".$file) ){
                $processed[] = array(
                    'name' => $name,
                    'file' => $file,
                    'uploaded' => true
                );
            }
            else{
                $processed[] = array(
                    'name' => $name,
                    'uploaded' => false
                );
            };
        };
    };
    echo json_encode($processed);
?>