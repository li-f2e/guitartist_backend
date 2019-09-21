
<?php require_once __DIR__ . "/init.php"; ?>    

<?php
    $pageName = 'product_edit';

    $productId = isset($_GET['product_id'])? intval( $_GET['product_id']) : 0;
    
    if(empty($productId)){
        header("Location: admin_product_list.php");
        exit;
    }

    $sql_edit = "SELECT * FROM `product` WHERE `product_id` = $productId";

    $row = $pdo->query($sql_edit)->fetch();
    if(empty($row)){
        header("Location: admin_product_list.php");
        exit;
    };
?>

<?php require_once __DIR__ . "/admin__header.php"; ?>
<?php require_once __DIR__ . "/admin__nav_bar.php"; ?>
</head>
<body>

<div class="wrapper d-flex">
    <?php require_once __DIR__ . "/admin__left_menu.php"; ?>
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-6 p-0 m-5 ">

                        <!-- //結果訊息 -->
                        <div class="alert " id="infoBar" role="alert" style="display: none"></div>
                        <h5 class=""> 編輯資料 </h5>
                        <!-- //新增商品表單 -->
                        <form class="product-form" name="productForm" onsubmit="return checkForm()" enctype="multipart/form-data">
                            <!-- 影藏欄位一定要放在form裡面  這步驟一定要做不然會不知道要改哪比-->
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($row['product_id']) ?>">
                            
                            <img src="uploads/<?=  $row['product_image'] ?>" alt="" height="200">
                             <!-- //影藏的選擇按鈕 -->
                             <div class="form-group my-form-group">
                                <label for="product_image">請選擇檔案</label>
                                <input type="file" class="form-control-file text-center my-form-control" onchange="" style="display: none" id="product_image" name="product_image">
                            </div>

                            <div class="form-group my-form-group ">
                                <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
                                <img src="" alt="" >
                            </div>
                            
                            
                            <div class="form-group" >
                                <label for="email">信箱</label>
                                <input type="text" class="form-control" id="email" name="product_email" value="<?= htmlspecialchars($row['product_email'])  ?>">
                            </div>

                            <div class="form-group" >
                                <label for="brand">品牌</label>
                                <input type="text" class="form-control" id="brand" name="product_brand" value="<?= htmlspecialchars($row['product_brand']) ?>">
                            </div>

                            <div class="form-group" >
                                <label for="series">系列</label>
                                <input type="text" class="form-control" id="series" name="product_series" value="<?= htmlspecialchars($row['product_series']) ?>">
                            </div>

                            <div class="form-group" >
                                <label for="productName">商品名稱</label>
                                <input type="text" class="form-control" id="productName" name="product_name" value="<?= htmlspecialchars($row['product_name'])  ?>">
                            </div>

                            <div class="form-group" >
                                <label for="model">桶身</label>
                                <input type="text" class="form-control" id="model" name="product_model" value="<?= htmlspecialchars($row['product_model']) ?>">
                            </div>

                            <div class="form-group" >
                                <label for="Introduction">商品簡介</label>
                                <input type="text" class="form-control" id="introduction" name="product_introduction" value="<?= htmlspecialchars($row['product_introduction'])  ?>">
                            </div>

                            <div class="form-group" >
                                <label for="quantity">商品數量</label>
                                <input type="text" class="form-control" id="quantity" name="product_quantity" value="<?= htmlspecialchars($row['product_quantity'])  ?>">
                            </div>
 
                            <div class="form-group" >
                                <label for="price">商品價格</label>
                                <input type="text" class="form-control" id="price" name="product_price" value="<?= htmlspecialchars($row['product_price'])  ?>">
                            </div>

                            <div class="form-group" >
                                <label for="productTop">主板</label>
                                <input type="text" class="form-control" id="productTop" name="product_top" value="<?= htmlspecialchars($row['product_top'])  ?>">
                            </div>

                            <div class="form-group" >
                                <label for="productBack">側背板</label>
                                <input type="text" class="form-control" id="productBack" name="product_back" value="<?= htmlspecialchars($row['product_back'])  ?>">
                            </div>

                            <div class="form-group" >
                                <label for="productBody">body</label>
                                <input type="text" class="form-control" id="productBody" name="product_body" value="<?= htmlspecialchars($row['product_body'])  ?>">
                            </div>

                            <div class="form-group" >
                                <label for="productSolid">solid</label>
                                <input type="text" class="form-control" id="productSolid" name="product_solid" value="<?= htmlspecialchars($row['product_solid']) ?>">
                            </div>

                            <div class="form-group" >
                                <label for="productNeck">neck</label>
                                <input type="text" class="form-control" id="productNeck" name="product_neck_width" value="<?= htmlspecialchars( $row['product_neck_width'])  ?>">
                            </div>

                            <div class="form-group" >
                                <label for="productBracing">bracing</label>
                                <input type="text" class="form-control" id="productBracing" name="product_bracing" value="<?= htmlspecialchars( $row['product_bracing'], ENT_QUOTES)  ?>">
                            </div>
                            <!-- <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div> -->
                            <button type="submit" class="btn btn-primary">確定</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    
    function selUpload(){
        document.querySelector('#product_image').click();
    }


    console.log(infoBar);
    function checkForm(){
        let infoBar = document.querySelector('#infoBar');

        // 檢查必填欄位
        let fd = new FormData(document.productForm);

        fetch('admin_product_edit.api.php', {
            method: 'post',
            body: fd
        })
        .then(response =>{
            return response.json();
        })
        .then(jsonObj =>{
            console.log(jsonObj);
            // infoBar.style.display = 'block';
            // infoBar.innerHTML = jsonObj.info;
            
            if (jsonObj.success){
                // infoBar.className = 'alert alert-success';
                Swal.fire({
                type: 'success',
                title: jsonObj.info,
                showConfirmButton: false,
                timer: 1500
                })
                setTimeout(function() {
                location.href = 'admin_product_list.php';
                }, 1000);
                } 
            else{
                // infoBar.className = 'alert alert-danger';
                Swal.fire({
                type: 'error',
                title: jsonObj.info,
                showConfirmButton: false,
                timer: 1500
                })
            }
            
        });

        return false; //表單不用傳統的方式送出
    }
</script>

<?php require_once __DIR__ . "/admin__footer.php"; ?>