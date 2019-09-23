<?php require "__admin_required.php";
require_once __DIR__ . "/init.php"; 
?>    
<?php
    $page_name = 'data_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 5; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(1) FROM `course_tb` ";

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows/$per_page); // 取得總頁數

if($page < 1){
    header('Location: admin_course_list.php');
    exit;
}
if($page > $totalPages){
    header('Location: admin_course_list.php?page='. $totalPages);
    exit;
}

$sql = "SELECT * FROM course_tb";

$stmt = $pdo->query($sql);

$check=[];
?>   
<?php require_once __DIR__ . "/admin__header.php"; ?>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/lightbox.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<style>

    .table th{
        text-align:center;
        vertical-align: middle;
        /* letter-spacing: 3px; */
    }
     .table td{
        text-align:center;
        vertical-align: middle;
        color : #6c757d;
    }

    .fa-trash{
        color : var(--dark);
    }
   
    input[type="search"]:focus{
        box-shadow: none;
        border-color:var(--dark);
    }

    .custom-select:focus{
        border-color:var(--dark);
        box-shadow: none;
    }

    .my-card{
        border: none;
        padding: 5px 0;
        /* margin: 5px 0; */
    }

    .my-card-header{
        background-color: transparent;
        border: none;
    }

    .my-card-title{
        display: flex;
    }
    .fa-arrow-down{
        color:black;
    }
    .fa-arrow-up{
        color:black;
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
    
        <div class="mainContent ">
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-11 p-0 mt-5 ml-3 ">
                    
                        <!-- html馬打這裡 -->
                        <div class="container-fluid">
                        <!-- 頁籤 -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item ">
                                <a class="nav-link list-link " href="admin_product_list.php" style="color: var(--dark);">商品列表</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link list-link active" href="admin_course_list.php" style="color: var(--dark);" >課程列表</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link list-link" href="admin_location_list.php" style="color: var(--dark);" >場地列表</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link list-link" href="admin_job_list.php" style="color: var(--dark);" >徵才列表</a>
                            </li>
                        </ul>

<div style="margin-top: 1.25rem;">
    <h2 class="card-title" style="text-align:center;">課程列表 </h2>
    <div class="mt-4 mb-3 ml-2 d-flex justify-content-between align-items-center">
         <div>
                <a class="condition" href="admin_course_list.php">全部</a>
                <span>|</span>
                <a class="condition" href="admin_course_up.php">上架中</a>
                <span>|</span>
                <a class="condition" href="admin_course_down.php">下架中</a>
        </div>
    </div>
    <div class="d-flex align-items-center py-2  pl-2">
                            <button id='checkAll' class="checkAll btn btn-info mr-2" name='checkboxall'>全選</button>
                            <button id='antiCheckAll' class="checkAll btn btn-info mr-2" name='checkboxall'>反選</button>
                
                        </div>

    <table class="table table-hover course_table">
        <thead>
        <tr class="text-center">
            <th scope="col" style="width: 60px">編號</th>
            <th scope="col" style="width: 60px">
                <label class='checkbox-inline checkboxeach'>
                    <!-- 選取全部 -->
                    選取
                </label>
                <!-- <input id='checkAll' type='checkbox' name='checkboxall' value='1'> -->
            </th>
            <!--刪除全部 -->
            <th scope="col" style="width: 60px">
                <a href="javascript:delete_all()" style="outline: none;">
                    <i class="fas fa-trash delete_all"></i>
                </a>
            </th>
            <!-- <th scope="col"class="box_td">帳號（電子信箱）</th> -->
            <th scope="col"class="box_td" style="width: 60px">課程名稱</th>
            <th scope="col"class="box_td" style="width: 60px">類型</th>
            <th scope="col"class="box_td" style="width: 60px">開始</th>
            <th scope="col"class="box_td" style="width: 60px">結束</th>
            <th scope="col"class="box_td" style="width: 60px">課程時間</th>
            <th scope="col"class="box_td" style="width: 60px">人數</th>
            <th scope="col"class="box_td" style="width: 60px">地點</th>
            <th scope="col"class="box_td" style="width: 60px">價格</th>
            <th scope="col"class="box_td" style="width: 60px">優惠</th>
            <!-- <th scope="col"class="box_td" style="width: 60px">描述</th> -->
            <th scope="col"class="box_td" style="width: 150px">圖片</th>
            <th scope="col"class="box_td" style="width: 60px">編輯</th>
            <th scope="col"class="box_td" style="width: 60px">狀態</th>
            <!-- <th scope="col"class="box_td"><i class="fas fa-trash-alt"></i></th> -->
        </tr>
        </thead>
        <tbody>
        <?php while($r=$stmt->fetch()){  ?>
            <tr>
                <td class="box_td"><?= htmlentities($r['sid']) ?></td>
                <td class="box_td">
                    <label class=' checkbox-inline checkboxeach'>
                        <!-- 單個刪除選sid -->
                        <input id="<?= 'readtrue' . $r['sid'] ?>" type='checkbox' name=<?= 'readtrue' . $r['sid'] . '[]' ?> value='<?= $r['sid'] ?>'>
                    </label>
                </td>
                <td>
                    <!-- 刪除單個sid -->
                    <a style="outline: none;" href="javascript:delete_one(<?= $r['sid'] ?>)"><i class="fas fa-trash-alt"></i></a>                   
                </td>
                
                <!-- <td class="box_td"><?= htmlentities($r['email'])?></td> -->
                <td class="box_td"><?= htmlentities($r['course_name']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_sort']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_begindate']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_enddate']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_time']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_person']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_address']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_price']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_bonus']) ?></td>
                <!-- <td class="box_td"><?= htmlentities($r['course_describe']) ?></td> -->
                <td>
                <a href="uploads/<?=$r['course_pic']?>" data-lightbox="image" data-title="預覽圖片">
                <img src="uploads/<?=$r['course_pic']?>" alt="" width="150" >
                </a>
               
                </td>
                <td><a href="admin_course_edit.php?sid=<?= $r['sid'] ?>">
                <i class="fas fa-edit"></i></a>
                </td>
                <td>
                <?php
                    $d=$r['course_down']=="0"? "block":"none";
                    $u=$r['course_down']=="1"? "block":"none";
                ?>
                    <a href="javascript:down_one(<?= $r['sid'] ?>)"><i class="fas fa-arrow-down " style="display:<?=$d?>"></i></a>
                    <a href="javascript:up_one(<?= $r['sid'] ?>)"><i class="fas fa-arrow-up " style="display:<?=$u?>"></i></a>
                </td>
                <!-- <td>
                    <a href="javascript:delete_one(<?= $r['sid'] ?>)"><i class="fas fa-trash-alt"></i></a>
                </td> -->
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="js/lightbox.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
     //上架課程
     function up_one(sid) {
            if (confirm(`確定要上架編號為 ${sid} 的課程嗎?`)) {
                location.href = 'admin_course_up_api.php?sid=' + sid;
            }
        }
        //下架課程
        function down_one(sid) {
            if (confirm(`確定要下架編號為 ${sid} 的課程嗎?`)) {
                location.href = 'admin_course_down_api.php?sid=' + sid;
            }
        }

$('.course_table').dataTable({
        // scrollY: '60vh',
        // scrollCollapse: true,
        // paging: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columnDefs": [
            { "orderable": false, "targets": 1},
            { "orderable": false, "targets": 2},
            { "orderable": false, "targets": 3},
            { "orderable": false, "targets": 4},
            { "orderable": false, "targets": 9},
            { "orderable": false, "targets": 12},
            { "orderable": false, "targets": 13},
            { "orderable": false, "targets": 14},
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
    // 單筆刪除
    function delete_one(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = 'admin_course_delete.php?sid=' + sid;
        }
    }

    // 多重刪除 
    function delete_all() {
        let sid = [];
        checkBoxes.each(function() {
            if ($(this).prop('checked')) {
                sid.push($(this).val())
            }
        });
        if (!sid.length) {
            alert('沒有選擇任何資料');
        } else {
            if (confirm('確定要刪除這些資料嗎？')) {
                location.href = 'admin_course_delete_all.php?sid=' + sid.toString();
            }
        }
    }
</script>


<?php require_once __DIR__ . "/admin__footer.php"; ?>
