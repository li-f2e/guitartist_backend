
<?php
    require_once __DIR__ . "/init.php";

    //放圖檔的資料夾的位置
    $upload_dir = __DIR__. '/uploads/';

    $result =[
        'success' => false,
        'code' => 400,
        'info' => '資料欄位不足',
        'post' => $_POST,
    ];


    $allowed_types = [
        'image/png',
        'image/jpeg',
    ];
    //如果圖片的附檔名符合這些key就把附檔名改成這些value
    $exts = [
        'image/png' => '.png',
        'image/jpeg' => '.jpg',
    ];


    if(!empty($_FILES['product_image']['name'])){

        if(in_array($_FILES['product_image']['type'], $allowed_types)) { // 檔案類型是否允許
    
            //把上傳的圖片名稱編碼
            $new_filename = sha1(uniqid().$_FILES['product_image']['name']);
            //賦予圖檔新的副檔名
            $new_ext = $exts[$_FILES['product_image']['type']];
            // 把圖片放到指定的資料夾
            move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_dir. $new_filename. $new_ext);
            //要放在uploads資料夾的圖片檔名
            $pic = $new_filename.$new_ext;


                $sqlInsert = "UPDATE `product` SET 
                `product_email`=?,
                `product_image1`=?,
                `product_brand`=?,
                `product_series`=?,
                `product_name`=?,
                `product_model`=?,
                `product_introduction`=?,
                `product_quantity`=?,
                `product_price`=?,
                `product_top`=?,
                `product_back`=?,
                `product_body`=?,
                `product_solid`=?,
                `product_neck_width`=?,
                `product_bracing`=? 
                WHERE `product_id`=?";
                        // product_id也要加到execute裡面

                $stmtInsert = $pdo->prepare($sqlInsert);

                $stmtInsert->execute([
                    $_POST['product_email'],
                    $pic,
                    $_POST['product_brand'],
                    $_POST['product_series'],
                    $_POST['product_name'],
                    $_POST['product_model'],
                    $_POST['product_introduction'],
                    $_POST['product_quantity'],
                    $_POST['product_price'],
                    $_POST['product_top'],
                    $_POST['product_back'],
                    $_POST['product_body'],
                    $_POST['product_solid'],
                    $_POST['product_neck_width'],
                    $_POST['product_bracing'],
                    $_POST['product_id'],
                ]);

                if($stmtInsert->rowCount()==1){
                    $result['success'] = true;
                    $result['code'] = 200;
                    $result['info'] = '修改成功';
                }
                else {
                    $result['code'] = 420;
                    $result['info'] = '修改失敗';
                }

            echo json_encode($result, JSON_UNESCAPED_UNICODE);

        }
    }
    else{
        $sqlInsert = "UPDATE `product` SET 
                            `product_email`=?,
                            `product_brand`=?,
                            `product_series`=?,
                            `product_name`=?,
                            `product_model`=?,
                            `product_introduction`=?,
                            `product_quantity`=?,
                            `product_price`=?,
                            `product_top`=?,
                            `product_back`=?,
                            `product_body`=?,
                            `product_solid`=?,
                            `product_neck_width`=?,
                            `product_bracing`=? 
                            WHERE `product_id`=?";
                                    // product_id也要加到execute裡面

    $stmtInsert = $pdo->prepare($sqlInsert);

    $stmtInsert->execute([
        $_POST['product_email'],
        $_POST['product_brand'],
        $_POST['product_series'],
        $_POST['product_name'],
        $_POST['product_model'],
        $_POST['product_introduction'],
        $_POST['product_quantity'],
        $_POST['product_price'],
        $_POST['product_top'],
        $_POST['product_back'],
        $_POST['product_body'],
        $_POST['product_solid'],
        $_POST['product_neck_width'],
        $_POST['product_bracing'],
        $_POST['product_id'],
    ]);


    if($stmtInsert->rowCount()==1){
        
        $result['success'] = true;
        $result['code'] = 200;
        $result['info'] = '修改成功';
    }
    else {
        $result['code'] = 420;
        $result['info'] = '修改失敗';
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }



    
?>