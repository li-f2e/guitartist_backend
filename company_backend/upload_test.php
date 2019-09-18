<?
    require_once __DIR__ . "/__connect_db.php";

    // 要上傳到哪個資料夾的路徑
    $upload_dir = __DIR__."/uploads/";

    //檔案類型標準
    $allow_types = [
        "image/jpeg",
        "image/jng",
    ];

    

    //新副檔名
    $exts = [
        "image/jpeg" => '.jpeg',
        "image/jng" => '.png',
    ];

    // 如果有上傳
    if( !empty($_FILES['my_file']) ){
        // 如果副檔名有和標準對到
        if(in_array($_FILES['my_file']['type'], $allow_types)){

            // !!把$new_filename和$new_ext接起來存到資料庫裏面!!

            // 讓檔案有一個新的名字 防止每個人上傳的檔名有重覆到
            $new_filename = sha1(  uniqid().$_FILES['my_file']['name'] );
            //新的副檔名 把上傳來的檔案類型當成key
            $new_ext = $exts[ $_FILES['my_file']['type'] ];

            // 把檔案搬移到網站內的資料夾
            move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir.$new_filename.$new_ext);
        };
    };


    require_once __DIR__ . "/__header.php";
    require_once __DIR__ . "/__nav_bar.php";
?>
<div class="container mt-5"></div>
    <div class="row mt-5">
        <div class="col-4 mx-auto">
            <div>
                <pre>
                    <?
                        if(! empty($_FILES))
                        var_dump($_FILES);
                    ?>
                </pre>
            </div>

            <form  name="form1" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="my_file">請選擇上傳的檔案</label>
                    <input type="file" class="form-control-file" id="my_file" name="my_file">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
    


<? require_once __DIR__ . "/__footer.php"; ?>