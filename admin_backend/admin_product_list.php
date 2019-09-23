
<?php require_once __DIR__ . "/init.php"; ?>    

<?php
    
    //debug用
    // echo '<pre>',print_r($row),'</pre>';
    
    $pageName = 'product_info';

    
    $page = isset($_GET['page'])? intval($_GET['page']) : 1;
    
    // 原始的SQL語句
    $sql =  "SELECT * FROM `product` ";
    $sql_count = "SELECT COUNT(1) FROM `product`"; 

    $quantity = isset($_GET['quantity'])? $_GET['quantity'] : 0;
    // echo $modalType;
    
    $cutaway = isset($_GET['cutaway'])? $_GET['cutaway'] : 0;

    if (isset($_GET['quantity'])) {
        $quantity = $_GET['quantity'];
        
        $low_quantity = " WHERE `product_quantity` < 20 " ;
        
        $sql = $sql . $low_quantity;
        
        $sql_count = $sql_count . $low_quantity;
    } 
    
    function querySql(PDO $pdo, $str){
        $stmt = $pdo->query($str);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // $sql_total = "SELECT COUNT(1) FROM `product` ";
    $totalRows = $pdo->query($sql_count)->fetch(PDO::FETCH_NUM)[0];
    $rows = querySql($pdo, $sql);
        
    
    // echo '<pre>',print_r($rows),'</pre>'
?>   
<?php require_once __DIR__ . "/admin__header.php"; ?>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<style>
    .fa-times{
        font-size: 1.5rem;
        color: var(--secondary);
    }

    .fa-check{
        font-size: 1.2rem;
        color: var(--success);
    }

    .fa-ban{
        font-size: 1.2rem;
        color: var(--red);
    }

    .fa-caret-right, .fa-caret-left{
        color: var(--dark);
    }

    /* 全部|上架中|下架中 */
    .condition{
        color: var(--dark);
        transition: .3s;
        font-weight: 700;
    }

    .condition:hover{
        text-decoration: none;
        color: var(--red);
    }

    
    


    

    /* 表單 */
    .product-table th{
        font-size: 16px;
        font-weight: 700;
        width:100%;
        vertical-align: middle;
    }

    .dt-table{
        margin: 0;
    }

    .dataTables_info{
        display: none;
    }

    .dataTables_length, .dataTables_filter{
        margin: 10px;
    }

    input[type="search"]:focus{
        box-shadow: none;
        border-color:var(--dark);
    }

    .custom-select:focus{
        border-color:var(--dark);
        box-shadow: none;
    }

    table.dataTable thead th, 
    table.dataTable thead td{
        padding: 10px 0px ;
    }
    
    
    /* table.dataTable thead>tr>th.sorting_asc, 
    table.dataTable thead>tr>th.sorting_desc, 
    table.dataTable thead>tr>th.sorting, 
    table.dataTable thead>tr>td.sorting_asc, 
    table.dataTable thead>tr>td.sorting_desc, 
    table.dataTable thead>tr>td.sorting{
        padding-right: 10px;
    } */

    
    /* table.dataTable thead .sorting:before, 
    table.dataTable thead .sorting:after, 
    table.dataTable thead .sorting_asc:before, 
    table.dataTable thead .sorting_asc:after, 
    table.dataTable thead .sorting_desc:before, 
    table.dataTable thead .sorting_desc:after, 
    table.dataTable thead .sorting_asc_disabled:before, 
    table.dataTable thead .sorting_asc_disabled:after, 
    table.dataTable thead .sorting_desc_disabled:before, 
    table.dataTable thead .sorting_desc_disabled:after{
        content: '';
    } */

    /* table.dataTable thead .sorting:after, 
    table.dataTable thead .sorting_asc:after, 
    table.dataTable thead .sorting_desc:after, 
    table.dataTable thead .sorting_asc_disabled:after, 
    table.dataTable thead .sorting_desc_disabled:after{
        content: '';
    } */

    /* 全選按鈕 */
    .checkAll{
        padding: 0 13px;
        letter-spacing: 2px;
        background-color: var(--dark);
        border-color: var(--dark);
    }

    .checkAll:hover{
        background-color: rgb(226, 24, 24);
        border-color: rgb(226, 24, 24);
    }

    /* 上下架按鈕 */
    .launchedBtn{
        font-size: 1rem;
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
        border: 2px solid var(--red);
        background-color: var(--red);
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

    .my-card{
        border: none;
        border-radius: 0;
        padding:0;
    }

    .my-card-header{
        background-color: transparent;
        border: none;
        margin-bottom: 5px !important;
    }

    .my-card-title{
        display: flex;
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
                    <div class="col-12 mt-5 mx-auto ">
                        <!-- 頁簽 -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item ">
                                <a class="nav-link list-link active" href="admin_product_list.php" style="color: var(--dark);">商品列表</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link list-link" href="admin_course_list.php" style="color: var(--dark);" >課程列表</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link list-link" href="admin_location_list.php" style="color: var(--dark);" >場地列表</a>
                            </li>
                        </ul>

                        <h2 class="" style="text-align:center; margin-top: 1.25rem;">商品列表 </h2>
                        <!-- //全部|上架中|下架中 -->
                        <div class="mt-4 mb-3 ml-2 d-flex justify-content-between align-items-center">
                            <div>
                                <a class="condition" href="admin_product_list.php">全部</a>
                                <span>|</span>
                                <a class="condition" href="admin_product_up.php">上架中</a>
                                <span>|</span>
                                <a class="condition" href="admin_product_down.php">下架中</a>
                            </div>
                        </div>
                        
                        <!-- 分類選擇 -->
                        <div class="d-flex align-items-center py-2  pl-2">
                            <button id='checkAll' class="checkAll btn btn-info mr-2" name='checkboxall'>全選</button>
                            <button id='antiCheckAll' class="checkAll btn btn-info mr-2" name='checkboxall'>反選</button>
                            <button class="btn btn-secondary checkAll mr-3" onclick="showCutaway()"> 缺角 </button>
                            <button class="btn btn-secondary checkAll mr-3" onclick="lowQuantity('quantity', '20')"> 庫存緊張 </button>
                        </div>
                        


                        <!-- //顯示商品的表格 -->
                        <table id="product-table" class="table table-hover product-table">
                            <thead class="">
                                <tr class="text-center">
                                    <th scope="col" style="width: 60px;">編號</th>
                                    <th scope="col" style="width: 60px;">選取</th>
                                    <th scope="col" style="width: 60px;">刪除</th>
                                    <th scope="col" style="width: 100px;">狀態</th>
                                    <th scope="col" style="width: 60px;">圖片</th>
                                    <th scope="col" style="width: 60px;">廠牌</th>
                                    <th scope="col" style="width: 60px;">系列</th>
                                    <th scope="col" style="width: 60px;">品名</th>
                                    <th scope="col" style="width: 60px;">桶身</th>
                                    <th scope="col" style="width: 60px;">數量</th>
                                    <th scope="col" style="width: 60px;">價格</th>
                                    <th scope="col" style="width: 60px;">優惠</th>
                                    <th scope="col" style="width: 60px;">編輯</th>
                                    <th scope="col" style="width: 60px;">販售</th>
                                </tr>
                            </thead>

                            <tbody class="table-striped">
                                <?php foreach($rows as $r): ?>
                                    <tr class="tr<?=$r['product_id']?> text-center">
                                        <td class="align-middle" > <?= htmlspecialchars( $r['product_id']);  ?> </td>
                                        <td class="align-middle" >
                                            <label class=' checkbox-inline checkboxeach'>
                                                <!-- 選取 -->
                                                <input id="<?= 'readtrue' . $r['product_id'] ?>" type='checkbox' name=<?= 'readtrue' . $r['product_id'] . '[]' ?> value='<?= $r['product_id'] ?>'>
                                            </label>
                                        </td>
                                        <td class="align-middle"> 
                                        <!-- javascript:delete_all() -->
                                            <a href="javascript: delete_all()">
                                                <i class="fas fa-trash-alt"></i>
                                            </a> 
                                        </td>
                                        
                                        <td class="align-middle " style="width: 100px;">

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
                                        
                                        <td class="align-middle">
                                            <figure class="mainPhoto">
                                                <img src="uploads/<?= htmlspecialchars( $r['product_image1'] ) ?>" alt="" height="200">
                                            </figure>
                                        </td>
                                        <td class="align-middle"  style="width: 60px;"><?= htmlspecialchars( $r['product_brand']); ?></td>
                                        <td class="align-middle"  style="width: 60px;"><?= htmlspecialchars( $r['product_series']); ?></td>
                                        <td class="align-middle"  style="width: 60px;"><?= htmlspecialchars( $r['product_name']); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_model']); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_quantity']); ?></td>
                                        <td class="align-middle"  style="width: 60px;"><?= htmlspecialchars( $r['product_price']."    NTD");  ?></td>
                                        <td class="align-middle"><?= htmlspecialchars( $r['product_discount']); ?></td>

                                        <td class="align-middle"> 
                                            <a href=" admin_product_edit.php?product_id=<?= $r['product_id'] ?> ">
                                                <i class="fas fa-edit"></i>
                                            </a> 
                                        </td>

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

                                       
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="cube">
                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>

    $('#product-table').dataTable({
        // scrollY: '60vh',
        // scrollCollapse: true,
        // paging: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columnDefs": [
            { "orderable": false, "targets": 1},
            { "orderable": false, "targets": 2},
            { "orderable": false, "targets": 3},
            { "orderable": false, "targets": 4},
            { "orderable": false, "targets": 5},
            { "orderable": false, "targets": 6},
            { "orderable": false, "targets": 7},
            { "orderable": false, "targets": 8},
            // { "orderable": false, "targets": 9},
            // { "orderable": false, "targets": 10},
            { "orderable": false, "targets": 11},
            { "orderable": false, "targets": 12},
            { "orderable": false, "targets": 13},
        ]
    });

    

    let checkAll = $('#checkAll'); //控制所有勾選的欄位
    let antiCheckAll = $('#antiCheckAll'); //反選所有勾選的欄位
    let allChecked = false;

    //被選取的頁簽文字顏色變紅
    $('.list-link.active').css('color','var(--red)');
        
    // 全選
    checkAll.click(function() {
        let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位
        allChecked = !allChecked;
        console.log(allChecked);
        for (let i = 0; i < checkBoxes.length; i++) {
            checkBoxes[i].checked = allChecked;
        };
    })

    // 反選
    antiCheckAll.click(function() {
        let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位
        for (let i = 0; i < checkBoxes.length; i++) {
            if( checkBoxes[i].checked){
                console.log('A');
                checkBoxes[i].checked = false;
            }
            else{
                console.log('B');
                checkBoxes[i].checked = true;
            }
        };
    })

    // 多重刪除 
    function delete_all() {
        let sid = [];
        let checkBoxes = $('tbody .checkboxeach input'); 
        checkBoxes.each(function() {
            if ($(this).prop('checked')) {
                sid.push($(this).val())
            }
        });
        if (!sid.length) {
            alert('沒有選擇任何商品');
        } else {
            if (confirm('確定要刪除這些商品嗎？')) {
                location.href = 'admin_product_delete_all.php?sid=' + sid.toString();
            }
        }
    }

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

    let modalSelect = document.querySelector('#modalSelect');
    let brandSelect = document.querySelector('#brandSelect');

    
    //分類顯示要哪種分類(下拉選單)的function
    function selectCategory(){
        if(!!modalSelect.value && !!brandSelect.value ){
            window.location.href= `admin_product_list.php?modal=${modalSelect.value}&brand=${brandSelect.value}`;
        }
        else if(!!modalSelect.value ){
            window.location.href= `admin_product_list.php?modal=${modalSelect.value}`;
        }
        else{
            window.location.href= `admin_product_list.php?brand=${brandSelect.value}`;
        } 

    }


        
    // 庫存警張
    function lowQuantity(column, quantity){
        window.location.href= `admin_product_list.php?${column}=${quantity}`;
    }

    // 缺角
    function showCutaway(){
        window.location.href= `admin_product_list.php?cutaway=1`;
    }

    //刪除資料警告
    function deleteWarring(id){
        if( confirm(`確定要刪除編號為 ${id} 的商品嗎?`) ){
            let currentRow = document.querySelector('.tr<?= $r['product_id'] ?>');
            // currentRow.style.backgroundColor = 'red';
            location.href = "admin_product_delete.api.php?product_id=" + id;
        }
    };


    
    // 實驗性的function
    function ajaxTest(){
        fetch('admin_product_select_modal.api.php?value=' + selectValue)
        .then(response => {
            console.log(response);
            return response.json();
        })
        .then(json=>{
            console.log(json);
            // createTableIn('cube');
        })
    }

    // 插入表格到想要的元素裡 的function
    function createTableIn(elementClass){
        let cube = document.querySelector('.'+ elementClass);
        // console.log(cube);
        let table = document.createElement('table');
        table.style.className = 'table table-sm product-table';
        cube.appendChild(table);
        // console.log(table);
    }
</script>
<?php require_once __DIR__ . "/admin__footer.php"; ?>


