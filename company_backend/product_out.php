<!--  -->
<?php require_once __DIR__ . "/init.php"; ?>    

<?php
    
    //debug用
    // echo '<pre>',print_r($row),'</pre>';
    
    $pageName = 'product_out';

    //用戶選的頁面是第幾頁? 沒有選的話就是1
    $page = isset($_GET['page'])? intval($_GET['page']) : 1;

    //每一頁顯示幾筆
    $perPage = 10;

    $sql_total = "SELECT COUNT(1) FROM `product` WHERE `product_out`= '1'";
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

    // 從第一筆拿到 一頁有幾筆 , 每一頁顯示幾筆
    
    $sql = sprintf( "SELECT * FROM `product` WHERE `product_out`= '1' ORDER BY `product_id` DESC LIMIT %s, %s " , 
                    ($page-1)*$perPage, $perPage );
    $stmt = $pdo->query($sql);
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>',print_r($rows),'</pre>'
?>   
<?php require_once __DIR__ . "/__header.php"; ?>
<link rel="stylesheet" href="css/index.css">
<style>


    .fa-edit{
        font-size: 3rem;
        color: var(--secondary);
    }

    .fa-times{
        font-size: 1.5rem;
        color: var(--secondary);
    }

    .fa-caret-right, .fa-caret-left{
        color: var(--dark);
    }
    .page-item.active .page-link {
        background-color: var(--dark);
        border-color: var(--dark);
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

    
    
</style>    
</head>
<body>
<?php require_once __DIR__ . "/__nav_bar.php"; ?>

    <div class="wrapper d-flex">
        
    <?php require_once __DIR__ . "/__left_menu.php"; ?>
    
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-11 p-0 mt-5 ml-3 ">

                        <!-- //全部|上架中|下架中 -->
                        <div>
                            <a href="admin_product_list.php">全部</a><span>|</span>
                            <a href="admin_product_up.php">上架中</a><span>|</span>
                            <a href="admin_product_out.php">下架中</a>
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

                        <div>
                            總共有 <?= $totalRows; ?> 筆商品
                        </div>

                        <div class="container-fluid">
                            <div class="row d-flex">
                                <?php foreach($rows as $r): ?>
                                <div class="col-4 px-3 py-4" style="">
                                    <div class="photoFrame p-2">
                                        <a class="edit-btn d-flex" href=" admin_product_edit.php?product_id=<?= $r['product_id'] ?>" >
                                            <div >
                                                <img class="photo" src="uploads/<?= htmlspecialchars( $r['product_image1'] )?>" alt="">
                                            </div>
                                            <div class="guitar-detail w-100">
                                                <div> Id: <?= htmlspecialchars( $r['product_id']);  ?></div>
                                                <div> Email: <?= htmlspecialchars( $r['product_email']); ?></div>
                                                <div> Brand:<?= htmlspecialchars( $r['product_brand']); ?> </div>
                                            </div>
                                            
                                            <div class="mask">
                                                <i class="fas fa-edit"></i>
                                            </div> 
                                        </a> 
                                        <a class="delete-btn" href="javascript: deleteWarring(<?= $r['product_id'] ?>)">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <a class="delete-btn mt-5" href="javascript: upWarring(<?= $r['product_id'] ?>)">
                                            <i class="fas fa-arrow-up"></i>
                                        </a> 
                                    </div>    
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>


                        <!-- //顯示商品的表格 -->
                        <!-- <table class="table  product-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">#</th>
                                    <th scope="col">image</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Series</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Introduction</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Top</th>
                                    <th scope="col">Back</th>
                                    <th scope="col">Body</th>
                                    <th scope="col">Solid</th>
                                    <th scope="col">Neck_width</th>
                                    <th scope="col">Bracing</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($rows as $r): ?>
                                    <tr class="tr<?= $r['product_id'] ?>">
                                        <td > 
                                            <a href="javascript: deleteWarring(<?= $r['product_id'] ?>)">
                                                <i class="fas fa-trash-alt"></i>
                                            </a> 
                                        </td>
                                        <td > 
                                            <a href=" product_edit.php?product_id=<?= $r['product_id'] ?> ">
                                                <i class="fas fa-edit"></i>
                                            </a> 
                                        </td>
                                        <td > <?= htmlspecialchars( $r['product_id']);  ?> </td>
                                        <td > <img src="uploads/<?= htmlspecialchars( $r['product_image1'] ) ?>" alt="" height="200"></td>
                                        <td ><?= htmlspecialchars( $r['product_brand']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_series']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_name']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_model']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_introduction']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_quantity']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_price']);  ?></td>
                                        <td ><?= htmlspecialchars( $r['product_discount']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_top']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_back']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_body']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_solid']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_neck_width']); ?></td>
                                        <td ><?= htmlspecialchars( $r['product_bracing']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
        //刪除資料警告
        function deleteWarring(id){
            
            if( confirm(`確定要刪除編號為 ${id} 的商品嗎?`) ){
                let currentRow = document.querySelector('.tr<?= $r['product_id'] ?>');
                // currentRow.style.backgroundColor = 'red';
                location.href = "product_delete.api.php?product_id=" + id;
            }
        };



        function upWarring(id){
            
            if( confirm(`確定要上架編號為 ${id} 的商品嗎?`) ){
                let currentRow = document.querySelector('.tr<?= $r['product_id'] ?>');
                // currentRow.style.backgroundColor = 'red';
                location.href = "product_up.api.php?product_id=" + id;
            }
        };
</script>

<?php require_once __DIR__ . "/__footer.php"; ?>


