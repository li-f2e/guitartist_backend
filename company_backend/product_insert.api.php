<? require_once __DIR__ . "/__admin_required.php"; ?> 
<?
    require_once __DIR__ . "/__connect_db.php";
    $result =[
        'success' => false,
        'code' => 400,
        'info' => '沒有輸入信箱',
        'post' => $_POST,
    ];

    

    //檢查欄位格式
    // if( empty($_POST['product_email']) ){
    //     echo json_encode($result, JSON_UNESCAPED_UNICODE);
    // };

    //上傳圖片的程式

    //放圖檔的資料夾的位置
    $upload_dir = __DIR__. '/uploads/';
    //篩選圖片檔的格式的陣列
    $allowed_types = [
        'image/png',
        'image/jpeg',
        'image/jpg',
    ];
    //如果圖片的附檔名符合這些key就把附檔名改成這些value
    $exts = [
        'image/png' => '.png',
        'image/jpeg' => '.jpg',
        'image/jpg' => '.jpg',
    ];


    $pics = [];
    //做迴圈
    // $pictureCount
    // echo json_encode( $_FILES['product_image']['name'] , JSON_UNESCAPED_UNICODE);
    // exit;
    for($i = 0; $i < count($_FILES['product_image']['name'],1); $i++){

        if(!empty($_FILES['product_image'])){ // 有沒有上傳
            if(in_array($_FILES['product_image']['type'][$i], $allowed_types)) { // 檔案類型是否允許
                   
                //把上傳的圖片名稱編碼
                $new_filename = sha1(uniqid().$_FILES['product_image']['name'][$i]);

                //賦予圖檔新的副檔名
                $new_ext = $exts[ $_FILES['product_image']['type'][$i] ];

                
                move_uploaded_file($_FILES['product_image']['tmp_name'][$i], $upload_dir. $new_filename. $new_ext);

                //要放在uploads資料夾的圖片檔名
                $pics[] = $new_filename.$new_ext;

                // json_encode($pics[], JSON_UNESCAPED_UNICODE);
            }
        }
    }

 
    

    $sqlInsert = "INSERT INTO `product`(
                                    `product_email`, 
                                    `product_image1`,
                                    `product_image2`,
                                    `product_image3`,
                                    `product_image4`,
                                    `product_image5`,
                                    `product_image6`,
                                    `product_brand`, 
                                    `product_series`, 
                                    `product_name`, 
                                    `product_model`, 
                                    `product_introduction`, 
                                    `product_quantity`, 
                                    `product_price`,  
                                    `product_top`, 
                                    `product_back`, 
                                    `product_body`, 
                                    `product_solid`, 
                                    `product_neck_width`, 
                                    `product_bracing`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            


    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([
        htmlspecialchars($_SESSION['loginUser']['email']),
        htmlspecialchars( isset($pics[0])? $pics[0] : null ),
        htmlspecialchars( isset($pics[1])? $pics[1] : null ),
        htmlspecialchars( isset($pics[2])? $pics[2] : null ),
        htmlspecialchars(isset($pics[3])? $pics[3] : null),
        htmlspecialchars(isset($pics[4])? $pics[4] : null),
        htmlspecialchars(isset($pics[5])? $pics[5] : null),
        htmlspecialchars($_POST['product_brand']),
        htmlspecialchars($_POST['product_series']),
        htmlspecialchars($_POST['product_name']),
        htmlspecialchars($_POST['product_model']),
        htmlspecialchars($_POST['product_introduction']),
        //這裡只要有值就一定會送 Null也會送 因為int是吃數字的 Null不符合字串的格式 所以會報錯
        htmlspecialchars((int)$_POST['product_quantity']) ,
        //(int)是硬轉
        htmlspecialchars((int)$_POST['product_price']),
        htmlspecialchars($_POST['product_top']),
        htmlspecialchars($_POST['product_back']),
        htmlspecialchars($_POST['product_body']),
        htmlspecialchars($_POST['product_solid']),
        htmlspecialchars($_POST['product_neck_width']),
        htmlspecialchars($_POST['product_bracing']),
    ]);


    //rowCount()如果新增成功返回1 沒有的話返回0
    // echo $stmtInsert->rowCount();

    if($stmtInsert->rowCount()==1){
        
        $result['success'] = true;
        $result['code'] = 200;
        $result['info'] = '新增成功';
    }
    else {
        $result['code'] = 420;
        $result['info'] = '新增失敗';
    }
    // echo "Insert done";
    
    
    echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>