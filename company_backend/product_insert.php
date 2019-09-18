<? require_once __DIR__ . "/__admin_required.php"; ?> 

<?
    require_once __DIR__ . "/__connect_db.php";

    $page_name = 'product_insert';

    
?>
    
<? require_once __DIR__ . "/__header.php"; ?>    
    
<? require_once __DIR__ . "/__nav_bar.php"; ?>    



<style>
        .text-center{
            text-align: center;
        }


        /* 上傳區域 */
        .upload-console-drop {
            border: 3px dashed var(--text);
            background-color: rgb(226, 226, 226);
            width: 200px;
            height: 200px;
            margin: auto;
            margin-top: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            transition: .2s ease-in;
        }
        /* 上傳區域 ondrag */
        .upload-console-drop.drag {
            background-color: #d8953d;
            border: 3px dashed var(--gold);
        }
        /* 上傳區域 font-awsome */
        .fa-images {
            font-size: 3rem;
            color: var(--text);
            transition: .2s ease-in;
        }

        .fa-images.drag {
            color: var(--primary);
        }

        /* 上傳區域 文字 */
        .drop-zone-info{
            color: var(--text);
            transition: .2s ease-in;
        }

        .drop-zone-info.drag{
            color: var(--primary);
        }

        h2 {
            text-align: center;
        }

        .bar {
            width: 100%;
            background-color: rgb(226, 226, 226);
            padding: 1px 2px;
            /* box-shadow: inset 0 1px 3px rgba(0, 0, 0, 2); */
            border-radius: 1px;
            overflow: hidden;
        }

        .bar-fill {
            height: 3px;
            display: block;
            background: var(--secondary);
            width: 0;
            border-radius: 1px;
            transition:
                width 0.8s ease;
            text-align: right;
            padding-right: 5px;
        }

        .bar-fill-text {
            color: var(--secondary);
            margin-left: 5px;
            line-height: 18px;
            font-weight: 900;
            font-size: 16px;
        }



        /* 輪播左右按鈕 */
        .carousel-control-prev, .carousel-control-next{
            transition: .3s;
        }
        .carousel-control-prev:hover, .carousel-control-next:hover{
            background: var(--gray);
        }

                
        .fa-trash-alt{
            color:  red;
        }
</style>
</head>
<body>





<div class="wrapper d-flex">
    <? require_once __DIR__ . "/__left_menu.php"; ?>
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-6 p-0 m-5 ">

                        <!-- //結果訊息 -->
                        

                        <!-- 預覽輪播 -->
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner " style="height: 500px">
                                <!-- 隱藏圖片區 upload_imgs有圖片才會append進來 -->
                                <!-- <div class="carousel-item active">
                                  <img src="" class="d-block w-100" alt="">
                                </div> -->
                                
                            </div>
                                
                            <!-- 左右箭頭     -->
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

<!-- ----------------------------------------------------//新增商品表單 ---------------------------------------------------------------->
                        <form class="product-form" name="productForm" onsubmit="return checkForm()" enctype="multipart/form-data">

                        <!-- 拖曳上傳區   drag_drop(event) -->
                        <div id="drop_zone" class="upload-console-drop" ondrop="drag_drop(event)" ondragover="return false">
                            <h5 class="drop-zone-info">拖曳以上傳圖片</h5>
                            <i class="fas fa-images"></i>
                        </div>
                        <input type="file" class="form-control-file text-center my-form-control" style="display:none;"  id="product_image" name="product_image[]" multiple>


                        <div class="bar-fill-text" id="bar-fill-text"></div>
                        <div class="bar mb-2">
                            <div class="bar-fill" id="bar-fill"></div>
                        </div>
    

                            <!-- <div class="form-group my-form-group" >
                                <label for="email">*信箱</label>
                                <input type="text" class="form-control my-form-control" id="email" name="product_email">
                            </div> -->

                            <div class="form-group my-form-group" >
                                <label for="brand">*品牌</label>
                                <input type="text" class="form-control my-form-control" id="brand" name="product_brand">
                                <small id="brandHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="series">*系列</label>
                                <input type="text" class="form-control my-form-control" id="series" name="product_series">
                                <small id="seriesHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="productName">*商品名稱</label>
                                <input type="text" class="form-control my-form-control" id="productName" name="product_name">
                                <small id="productNameHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="model">桶身</label>
                                <input type="text" class="form-control my-form-control" id="model" name="product_model">
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="Introduction">商品簡介</label>
                                <input type="text" class="form-control my-form-control" id="introduction" name="product_introduction">
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="quantity">*商品數量</label>
                                <input type="text" class="form-control my-form-control" id="quantity" name="product_quantity">
                                <small id="quantityHelp" class="form-text text-muted"></small>
                            </div>
 
                            <div class="form-group my-form-group" >
                                <label for="price">*商品價格</label>
                                <input type="text" class="form-control my-form-control" id="price" name="product_price">
                                <small id="priceHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="productTop">主板</label>
                                <input type="text" class="form-control my-form-control" id="productTop" name="product_top">
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="productBack">側背板</label>
                                <input type="text" class="form-control my-form-control" id="productBack" name="product_back">
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="productBody">body</label>
                                <input type="text" class="form-control my-form-control" id="productBody" name="product_body">
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="productSolid">solid</label>
                                <input type="text" class="form-control my-form-control" id="productSolid" name="product_solid">
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="productNeck">neck</label>
                                <input type="text" class="form-control my-form-control" id="productNeck" name="product_neck_width">
                            </div>

                            <div class="form-group my-form-group" >
                                <label for="productBracing">bracing</label>
                                <input type="text" class="form-control my-form-control" id="productBracing" name="product_bracing">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">確定</button>
                        </form>
                        <div class="alert " id="infoBar" role="alert" style="display: none"></div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="js/uploads.js"></script>
<script>


    function checkForm(){
        let fd = new FormData(document.productForm);
        
        let infoBar = document.querySelector('#infoBar');
      
            fetch('product_insert.api.php', {
                method: 'post',
                body: fd
            })
            .then(response =>{
                return response.json();
            })
            .then(json =>{
                console.log(json);
                infoBar.style.display = 'block';
                infoBar.innerHTML = json.info;

                if (json.success){
                    infoBar.className = 'alert alert-success';

                    setTimeout(() => {
                        document.location.href = "product_info.php";
                    }, 1000);
                } 
                else{

                    infoBar.className = 'alert alert-danger';
                    
                }
            });
            return false; //表單不用傳統的方式送出
    }

    
    //拖曳上傳圖檔
    (function () {
            "use strict";

            let dropZone = document.querySelector('#drop_zone');
            // console.log(dropZone);
            let barFill = document.querySelector('#bar-fill');
            let barFillText = document.querySelector('#bar-fill-text');
            let uploadsInner = document.querySelector('.carousel-inner');
            let product_image = document.querySelector('#product_image');

            let startUpLoad = function (files) {
                console.log(files);
                product_image.files = files;
                console.log(product_image.files);
                app.upLoader({
                    files: files,
                    progressBar: barFill,
                    progressText: barFillText,
                    //執行上傳的php
                    processor: 'uploads.php',

                    finished: function (data) {
                        // console.log('yah it works');
                        // console.log(data);

                        let x;
                        let uploadedItem;
                        let uploadedImage;
                        let uploadedStatus;
                        let currentFile;

                        for(x=0; x<data.length; x++){
                            currentFile =data[x];

                            uploadedItem = document.createElement('div');
                            if(x == 0){
                                uploadedItem.className = 'carousel-item  active';
                            }
                            else{
                                uploadedItem.className = 'carousel-item  ';
                            }
                            

                            uploadedImage = document.createElement('img');
                            if(x == 0){
                                uploadedImage.className = 'd-block w-25 mx-auto';
                            }
                            else{
                                uploadedImage.className = 'd-block w-100 mx-auto';
                            }
                            // uploadedImage.className = 'd-block w-25 mx-auto';
                            
                            if(currentFile.uploaded){
                                uploadedImage.src = 'upLoad_imgs/' + currentFile.file;
                            }

                            uploadedItem.appendChild(uploadedImage);

                            uploadsInner.appendChild(uploadedItem);
                        }


                    },

                    error: function () {
                        // console.log('There was an error');
                    }
                });
            };


            //Drop functionality
            dropZone.ondrop = function (e) {
                this.classList.remove('drag');
                this.firstElementChild.classList.remove('drag');
                this.lastElementChild.classList.remove('drag');
                // 覆寫原本的ondrop功能
                e.preventDefault();

                // document.querySelector('#product_image').change();
                // console.log(e.dataTransfer.files);
                startUpLoad(e.dataTransfer.files);
                this.style.width = '0';
                this.style.height = '0';
                this.innerHTML = '';
                this.style.opacity = '0';
            }

            dropZone.ondragover = function () {
                this.classList.add('drag');
                this.firstElementChild.classList.add('drag');
                this.lastElementChild.classList.add('drag');
                return false;
            };

            dropZone.ondragleave = function () {
                this.classList.remove('drag');
                this.firstElementChild.classList.remove('drag');
                this.lastElementChild.classList.remove('drag');
                return false;
            }
    })();

    
</script>

<? require_once __DIR__ . "/__footer.php"; ?>