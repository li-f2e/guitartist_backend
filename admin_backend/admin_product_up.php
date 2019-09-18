<!--  -->
<?php require_once __DIR__ . "/init.php"; ?>    

<?php
    
    $pageName = 'product_up';

    //用戶選的頁面是第幾頁? 沒有選的話就是1
    $page = isset($_GET['page'])? intval($_GET['page']) : 1;
    
    //每一頁顯示幾筆
    $perPage = 3;

    $modalType = isset($_GET['modal'])? $_GET['modal'] : null;

    $brand = isset($_GET['brand'])? $_GET['brand'] : null;

    $quantity = isset($_GET['quantity'])? $_GET['quantity'] : 0;
    // echo $modalType;
    
    $cutaway = isset($_GET['cutaway'])? $_GET['cutaway'] : 0;

    if(!empty($modalType) ){

        //實驗性寫成function
        // showTable( 'product_model',  $modalType);
        $sql_total = "SELECT COUNT(1) FROM `product` WHERE `product_model` = '$modalType' AND `product_out` = '0'";
        $totalRows = $pdo->query($sql_total)->fetch(PDO::FETCH_NUM)[0];
        $totalPages = ceil( $totalRows/$perPage);
    
        if($page<1){
        header("Location: admin_product_list.php");
        exit();
        };

        if($page > $totalPages){
        header("Location: admin_product_list.php?page={$totalPages}");
        exit();
        };

        $sql = sprintf( "SELECT * FROM `product` WHERE `product_model` = '$modalType' AND `product_out` = '0' ORDER BY `product_id` DESC LIMIT %s, %s " , 
                    ($page-1)*$perPage, $perPage );
        $stmt = $pdo->query($sql);
    
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    elseif(!empty($brand) ){
        $sql_total = "SELECT COUNT(1) FROM `product` WHERE `product_brand` = '$brand' AND `product_out` = '0' ";
        // $sql_total = sprintf("SELECT COUNT(1) FROM `product` WHERE `product_email`= %s", $_SESSION['loginUser']['email']);
        //執行SQL語法並 拿到總比數
        $totalRows = $pdo->query($sql_total)->fetch(PDO::FETCH_NUM)[0];
        // 有幾頁 = 總比數/每一頁顯示幾筆
        $totalPages = ceil( $totalRows/$perPage);
    
        if($page<1){
            header("Location: admin_product_list.php");
            exit();
        };

        if($page > $totalPages){
            header("Location: admin_product_list.php?page={$totalPages}");
            exit();
        };


        $sql = sprintf( "SELECT * FROM `product` WHERE `product_brand` = '$brand' AND `product_out` = '0' ORDER BY `product_id` DESC LIMIT %s, %s " , 
            ($page-1)*$perPage, $perPage );
        $stmt = $pdo->query($sql);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif(!empty($quantity) ){

        $sql_total = "SELECT COUNT(1) FROM `product` WHERE `product_quantity` < '$quantity' AND `product_out` = '0'";
        $totalRows = $pdo->query($sql_total)->fetch(PDO::FETCH_NUM)[0];
        $totalPages = ceil( $totalRows/$perPage);
    
        if($page<1){
        header("Location: admin_product_list.php");
        exit();
        };

        if($page > $totalPages){
        header("Location: admin_product_list.php?page={$totalPages}");
        exit();
        };

        $sql = sprintf( "SELECT * FROM `product` WHERE `product_quantity` < '$quantity' AND `product_out` = '0' ORDER BY `product_id` DESC LIMIT %s, %s " , 
            ($page-1)*$perPage, $perPage );
        $stmt = $pdo->query($sql);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif(!empty($cutaway) ){

        $sql_total = "SELECT COUNT(1) FROM `product` WHERE `product_cutaway` = '$cutaway' AND `product_out` = '0'";
        $totalRows = $pdo->query($sql_total)->fetch(PDO::FETCH_NUM)[0];
        $totalPages = ceil( $totalRows/$perPage);
    
        if($page<1){
        header("Location: admin_product_list.php");
        exit();
        };

        if($page > $totalPages){
        header("Location: admin_product_list.php?page={$totalPages}");
        exit();
        };

        $sql = sprintf( "SELECT * FROM `product` WHERE `product_cutaway` = '$cutaway' AND `product_out` = '0' ORDER BY `product_id` DESC LIMIT %s, %s " , 
            ($page-1)*$perPage, $perPage );
        $stmt = $pdo->query($sql);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{

        $sql_total = "SELECT COUNT(1) FROM `product` WHERE `product_out` = '0' ";
        // $sql_total = sprintf("SELECT COUNT(1) FROM `product` WHERE `product_email`= %s", $_SESSION['loginUser']['email']);
        //執行SQL語法並 拿到總比數
        $totalRows = $pdo->query($sql_total)->fetch(PDO::FETCH_NUM)[0];
        // 有幾頁 = 總比數/每一頁顯示幾筆
        $totalPages = ceil( $totalRows/$perPage);
    
        if($page<1){
            header("Location: admin_product_list.php");
            exit();
        };

        if($page > $totalPages){
            header("Location: admin_product_list.php?page={$totalPages}");
            exit();
        };



        $sql = sprintf( "SELECT * FROM `product` WHERE `product_out` = '0' ORDER BY `product_id` DESC LIMIT %s, %s " , 
                    ($page-1)*$perPage, $perPage );
        $stmt = $pdo->query($sql);
    
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>   
<?php require_once __DIR__ . "/admin__header.php"; ?>
<link rel="stylesheet" href="css/index.css">
<style>
    .fa-times, .fa-edit, .fa-trash-alt{
        font-size: 1.5rem;
        color: var(--secondary);
    }
    .fa-check{
        font-size: 1.5rem;
        color: var(--success);
    }
    .fa-ban{
        font-size: 1.5rem;
        color: var(--red);
    }
    .fa-caret-right, .fa-caret-left{
        color: var(--dark);
    }
    .page-item.active .page-link {
        background-color: var(--dark);
        border-color: var(--dark);
    }
    .product-table{
        /* font-weight: 500; */
    }
    .product-table th{
        letter-spacing: 3px;
        font-size: 1rem;
        font-weight: 100;
    }
    .launchedBtn{
        font-size: 1.2rem;
        font-weight: 500;
        text-decoration: none;
        color: var(--secondary);
        border: 2px solid var(--secondary);
        padding: 4px;
        transition: .3s;
    }
    .launchedBtn:hover{
        text-decoration: none;
        color: var(--white);
        border: 2px solid var(--gold);
        background-color: var(--gold);
    }
    .mainPhoto img{
        height:150px;
    }
    .photoFrame{
        border-radius: 5px;
        box-shadow: 2px 2px 5px rgba(0,0,0,.3);
        transition: .3s;
        position: relative;
        background-color: #fff;
    }
    .photoFrame:hover{
        transform: scale(1.1);
        z-index:20;
        box-shadow: 0px 0px 8px rgba(0,0,0,.3);
    }
        
    .photoFrame:hover .mask{
        opacity: 1;
    }
    .edit-btn{
        border: 2px solid var(--secondary);
    }
    .photo{
        height: 250px;
    }
    .mask{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        /* background-color: rgba(0,0,0,.2); */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: .5s;
        pointer-events: none;
        border-radius: 5px;
    }
    .guitar-detail{
        
        text-align: center;
        color: var(--secondary);
        text-decoration: none;
        pointer-events:none;
    }
    .delete-btn{
        border: none;
        position: absolute;
        top: 5%;
        right:5%;
    }
    .modalSelect{
        height: 100px;
    }
</style>   
</head>
<body>
<?php require_once __DIR__ . "/admin__nav_bar.php"; ?>

    <div class="wrapper d-flex">
        
    <?php require_once __DIR__ . "/admin__left_menu.php"; ?>
    
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-11 mt-5 mx-auto">

                        <!-- //全部|上架中|下架中 -->
                        <div>
                            <a href="admin_product_list.php">全部</a>
                            <span>|</span>
                            <a href="admin_product_up.php">上架中</a>
                            <span>|</span>
                            <a href="admin_product_down.php">下架中</a>
                        </div>
                        <!-- //換頁按鈕 -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination d-flex justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page-1 ?>">
                                        <i class="fas fa-caret-left"></i>
                                    </a>
                                </li>
                                
                                <?php 
                                    $pageStart = $page-5;
                                    $pageEnd = $page+5;
                                    for($i=$pageStart; $i <= $pageEnd; $i++): 
                                        if($i<1 or $i>$totalPages){
                                            continue;
                                        }
                                ?>
                                <li class="page-item  <?= $i==$page ? 'active' : ''  ?>">
                                    <a class="page-link" href="?page=<?= $i ?>" > <?= $i ?> </a>
                                </li>
                                
                                <?php endfor; ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page+1 ?>">
                                        <i class="fas fa-caret-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        <!-- 分類選擇 -->
                        <div class="d-flex align-items-center py-2">
                            <label class="mb-0 mr-2" for="modalSelect">桶身</label>
                            <select class="modalSelect mr-5 h-100" name="modalSelect" id="modalSelect" onchange="selectCategory('modalSelect', 'modal')">
                                <option value="" selected>--請選擇--</option>
                                <option value="D">D</option>
                                <option value="OM">OM</option>
                                <!-- <option value="Jumbo">Jumbo</option>
                                <option value="Jumbo">Parlor</option> -->
                            </select>
                            
                            <label class="mb-0 mr-2" for="brandSelect"> 廠牌 </label>
                            <select class="brandSelect mr-5 h-100" name="brandSelect" id="brandSelect" onchange="selectCategory('brandSelect', 'brand')">
                                <option value="" selected>--請選擇--</option>
                                <option value="LakeWood">LakeWood</option>
                                <option value="Alvarez">Alvarez</option>
                                <option value="Martin">Martin</option>
                                <option value="Cort">Cort</option>
                                <option value="Seagull">Seagull</option>
                            </select>

                            <button class="btn btn-secondary mr-3" onclick="showCutaway()"> 缺角 </button>
                            
                            <button class="btn btn-secondary mr-3" onclick="lowQuantity('quantity', '20')"> 庫存緊張 </button>
                        </div>


                        <div class="my-2">
                            總共有 <?= $totalRows; ?> 筆商品
                        </div>

                        <!-- //顯示商品的表格 -->
                        <table class="table product-table">
                            <thead class="">
                            <tr class="text-center">
                                    <th scope="col">編輯</th>
                                    <th scope="col">狀態</th>
                                    <th scope="col">編號</th>
                                    <th scope="col">圖片</th>
                                    <th scope="col">廠牌</th>
                                    <th scope="col">系列</th>
                                    <th scope="col">品名</th>
                                    <th scope="col">桶身</th>
                                    <th scope="col">數量</th>
                                    <th scope="col">價格</th>
                                    <th scope="col">優惠</th>
                                    <th scope="col">販售</th>
                                    <th scope="col">刪除</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($rows as $r): ?>
                                <tr class="tr<?=$r['product_id']?> text-center">                                    
                                        <td class="align-middle"> 
                                            <a href=" product_edit.php?product_id=<?= $r['product_id'] ?> ">
                                                <i class="fas fa-edit"></i>
                                            </a> 
                                        </td>
                                        <td class="align-middle ">

                                        <?php if($r['product_out']): ?>
                                            <a class="launchedBtn" id="btn<?= $r['product_id'] ?>" href="javascript: changeProduct(<?= $r['product_id'] ?>, 0)">
                                                下架中
                                            </a>
                                        <?php else: ?>
                                            <a class="launchedBtn" id="btn<?= $r['product_id'] ?>" href="javascript: changeProduct(<?= $r['product_id'] ?>, 1)">
                                                上架中
                                            </a> 
                                        <?php endif; ?>

                                        </td>
                                        <td class="align-middle"> <?= htmlspecialchars( $r['product_id']);  ?> </td>
                                        <td class="align-middle">
                                            <figure class="mainPhoto">
                                                <img src="uploads/<?= htmlspecialchars( $r['product_image1'] ) ?>" alt="" height="200">
                                            </figure>
                                        </td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_brand']); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_series']); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_name']); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_model']); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_quantity']); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_price']."    NTD");  ?></td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_discount']); ?></td>

                                        <td class="align-middle"> 
                                            <?php if($r['product_banned']): ?>
                                                <a class="bannedBtn" id="banned<?= $r['product_id'] ?>" href="javascript: changeBanded(<?= $r['product_id'] ?>, 0)">
                                                    <i class="fas fa-ban"></i>
                                                </a> 
                                            <?php else: ?>
                                                <a class="bannedBtn" id="banned<?= $r['product_id'] ?>" href="javascript: changeBanded(<?= $r['product_id'] ?>, 1)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>

                                        <td class="align-middle"> 
                                            <a href="javascript: deleteWarring(<?= $r['product_id'] ?>)">
                                                <i class="fas fa-trash-alt"></i>
                                            </a> 
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
       

         // 控制物品上下架的function
         function changeProduct(id, int){
            
            fetch("admin_product_out.api.php?product_id="+id+'&value='+int)
            .then( response =>{
                console.log(response);
                return response.json();
            })
            .then(json=>{
                // json.get.product_id
                if(json.success){
                   let btn =  document.querySelector(`#btn${id}`);
                   if(json.get.value==1){
                    // console.log('下架中'+json.get.value)
                    btn.innerHTML = "下架中";
                    btn.href = `javascript: changeProduct(${id}, 0 )`;
                   }
                   else{
                    // console.log('上架中'+json.get.value)
                    btn.innerHTML = "上架中";
                    btn.href = `javascript: changeProduct(${id}, 1 )`;
                   }
                }
            })
        };

        // 禁售物品的function
        function changeBanded(id, int){
            
            fetch("admin_product_banned.api.php?product_id="+id+'&value='+int)
            .then( response =>{
                console.log(response);
                return response.json();
            })
            .then(json=>{
                console.log(json.get.value);
                if(json.success){
                   let btn =  document.querySelector(`#banned${json.get.product_id}`);
                   if(json.get.value==0){
                        console.log(''+json.get.value);
                        btn.innerHTML = `<i class="fas fa-check"></i>`;
                        btn.href = `javascript: changeProduct(${json.get.product_id}, 1 )`;
                   }
                   else{
                    console.log(''+json.get.value);
                    btn.innerHTML = `<i class="fas fa-ban"></i>`;
                    btn.href = `javascript: changeProduct(${json.get.product_id}, 0 )`;
                   }
                }
            })
        };

        //分類顯示要哪種分類(下拉選單)的function
        function selectCategory(element_id, selection){
            let selectModal = document.querySelector('#'+ element_id);
            let selectValue = selectModal.value;
            window.location.href= `admin_product_up.php?${selection}=${selectValue}`;
        }


        function lowQuantity(column, quantity){
            window.location.href= `admin_product_up.php?${column}=${quantity}`;
        }

        function showCutaway(){
            window.location.href= `admin_product_up.php?cutaway=1`;
        }

         //刪除資料警告
         function deleteWarring(id){
            
            if( confirm(`確定要刪除編號為 ${id} 的商品嗎?`) ){
                let currentRow = document.querySelector('.tr<?= $r['product_id'] ?>');
                // currentRow.style.backgroundColor = 'red';
                location.href = "admin_product_delete.api.php?product_id=" + id;
            }
        };
        
</script>

<?php require_once __DIR__ . "/admin__footer.php"; ?>


