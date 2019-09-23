<?php 
require '__admin_required.php';
require_once __DIR__ . "/init.php";
 ?>    
<?php
    // $page_name = 'data_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 5; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(1) FROM `job_list` ";

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows/$per_page); // 取得總頁數

if($page < 1){
    header('Location: admin_job_list.php');
    exit;
}
if($page > $totalPages){
    header('Location: admin_job_list.php?page='. $totalPages);
    exit;
}

$sql = "SELECT * FROM `job_list`  ";

// $sql = sprintf("SELECT * FROM job_list  ORDER BY `sid` DESC LIMIT %s, %s",
//         ($page-1)*$per_page,
//             $per_page
// );

$stmt = $pdo->query($sql);

$check=[];
?>   
<?php require_once __DIR__ . "/admin__header.php"; ?>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <style>
     .table td{
        vertical-align: middle;
        color : #6c757d;
    }
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


    .product-table th{
        letter-spacing: 3px;
        font-size: 1rem;
        font-weight: 100;
    }

    .checkAll{
        /* padding: 0 13px;
        letter-spacing: 2px; */
        padding: 0 13px;
        letter-spacing: 2px;
        background-color: var(--dark);
        border-color: var(--dark);
    }
    .checkAll:hover{
        background-color: rgb(226, 24, 24);
        border-color: rgb(226, 24, 24);
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
                    <div class="col-10 p-0 mt-5 ml-3 ">
                        <!-- html馬打這裡 -->
                        <div class="container ">
                        <ul class="nav nav-tabs">
                                <li class="nav-item ">
                                    <a class="nav-link " href="admin_product_list.php" style="color: var(--dark)">商品列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_course_list.php" style="color: var(--dark)">課程列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_location_list.php" style="color: var(--dark)">場地列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="admin_job_list.php" style="color: var(--red)">徵才列表</a>
                                </li>
                            </ul>
<div style="margin-top: 2rem;">
<!-- //全部|上架中|下架中 -->
<div class="my-2 ml-2">
                            <a href="admin_job_list.php">全部</a>
                            <span>|</span>
                            <a href="admin_job_up.php">上架中</a>
                            <span>|</span>
                            <a href="admin_job_down.php">下架中</a>
                        </div>


         <!-- 總比數計數器 -->
         <div class="my-2  pl-2">
              <button id='checkAll' class="checkAll btn btn-info mr-2" name='checkboxall'>全選</button>
              <button id='antiCheckAll' class="checkAll btn btn-info mr-2" name='checkboxall'>反選</button>
                 總共有 <?= $totalRows; ?> 筆商品
              </div>
    <table id="example" class="table table-striped table-bordered">
        <thead>
        <tr>
        <th scope="col"class="box_td">編號</th>
            <th scope="col" style="vertical-align:left;">
                <label class='checkbox-inline checkboxeach'>
            <!-- 選取全部 -->
                </label>選取
            </th>
            <!--刪除全部 -->
            <th scope="col"><a href="javascript:delete_all()" style="outline: none;"><i class="fas fa-trash delete_all"></i></a></th>
                
            <th scope="col"class="box_td" style="width:10%">狀態</th>
            <!-- <th scope="col"class="box_td">帳號（電子信箱）</th> -->
            <th scope="col"class="box_td">職缺名稱</th>
            <th scope="col"class="box_td">職缺類型</th>
            <th scope="col"class="box_td">職缺內容</th>
            <th scope="col"class="box_td">報酬</th>
            <th scope="col"class="box_td">工作經驗</th>
            <th scope="col"class="box_td">需求人數</th>
            <th scope="col"class="box_td">急徵</th>
            <th scope="col"class="box_td">全職/兼職</th>
            <th scope="col"class="box_td"><i class="fas fa-edit"></i></th>
            <!-- <th scope="col"class="box_td"><i class="fas fa-trash-alt"></i></th> -->
        </tr>
        </thead>
        <tbody>
        <?php while($r=$stmt->fetch()){  ?>
            <tr>
            <td class="box_td"><?= $r['sid'] ?></td>
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
                
                <td class="align-middle ">

                    <?php if($r['job_out']): ?>
                        <a class="launchedBtn" id="btn<?= $r['sid'] ?>" href="javascript: changeProduct(<?= $r['sid'] ?>, 0)">
                            下架中
                        </a>
                    <?php else: ?>
                        <a class="launchedBtn" id="btn<?= $r['sid'] ?>" href="javascript: changeProduct(<?= $r['sid'] ?>, 1)">
                            上架中
                        </a> 
                    <?php endif; ?>

                    </td>
                <!-- <td class="box_td"><?= htmlentities($r['email'])?></td> -->
                <td class="box_td"><?= htmlentities($r['job_name']) ?></td>
                <td class="box_td"><?= htmlentities($r['job_class']) ?></td>
                <td class="box_td"><?= htmlentities($r['job_introduce']) ?></td>
                <td class="box_td"><?php  
                if($r['job_full-part']=="兼職"){
                    echo "時薪";
                }
                echo htmlentities($r['job_pay']) ?>~<?= htmlentities($r['job_pay_up'])?></td>
                <td class="box_td"><?= htmlentities($r['job_experience']) ?></td>
                <td class="box_td"><?= htmlentities($r['job_num']) ?></td>
                <td class="box_td"><?= htmlentities($r['job_urgent']) ?></td>
                <td class="box_td"><?= htmlentities($r['job_full-part']) ?></td>
                <td><a href="admin_job_edit.php?sid=<?= $r['sid'] ?>">
                <i class="fas fa-edit"></i></a>
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    

    <script>
//datatable

$('#example').dataTable({
        // scrollY: '60vh',
        // scrollCollapse: true,
        // paging: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columnDefs": [
            // { "orderable": false, "targets": 1},
            // { "orderable": false, "targets": 2},
            // { "orderable": false, "targets": 3},
            // { "orderable": false, "targets": 4},
            // { "orderable": false, "targets": 5},
            // { "orderable": false, "targets": 6},
            // { "orderable": false, "targets": 7},
            // { "orderable": false, "targets": 8},
            // // { "orderable": false, "targets": 9},
            // // { "orderable": false, "targets": 10},
            // { "orderable": false, "targets": 11},
            // { "orderable": false, "targets": 12},
            // { "orderable": false, "targets": 13},
        ]
    });

    $('.page-item').css({
        'width': '30px',
        'height': '30px',
        'padding': '0',
    })

    $('.page-link').css({
        'display':'flex',
        'justify-content':'center',
        'align-items':'center',
        'width': '30px',
        'height': '30px',
        'padding': '0',
        'border': 'none',
        'border-radius': '50%',
        'vertical-align': 'middle',
        'color':'var(--dark)',
    })
    
    // $('.page-link').mouseover().css({
    //     'background-color':'red',
    // })

    $('.page-item.active .page-link').css({
        'background-color':'var(--dark)',
        'color':'var(--white)',
    })

    
    $('.paginate_button').mouseover().css({
        'background':'transparent',
        'border':'none',
    })


    $('.previous').css({
        'margin-right': '30px',
    })

    $('.next').css({
        'margin-left': '30px',
    })

        // $('#example').DataTable();

        // var table = $('#example').DataTable();

        // $('#all').on( 'click', function () {
        //     table.page.len( -1 ).draw();
        // } );
        
        // $('#_10').on( 'click', function () {
        //     table.page.len( 5).draw();
        // } );
 
        // $('#next').on( 'click', function () {
        //     table.page( 'next' ).draw( 'page' );
        // } );
        
        // $('#previous').on( 'click', function () {
        //     table.page( 'previous' ).draw( 'page' );
        // } );



   let checkAll = $('#checkAll'); //控制所有勾選的欄位
    let antiCheckAll = $('#antiCheckAll'); //反選所有勾選的欄位
    let allChecked = false;

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

   // let checkAll = $('#checkAll'); //控制所有勾選的欄位
    //let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位
    // 以長度來判斷
    checkAll.click(function() {
        for (let i = 0; i < checkBoxes.length; i++) {
            checkBoxes[i].checked = this.checked;
        }
    })
// 控制物品上下架的function
function changeProduct(id, int){
        
        fetch("admin_job_out.api.php?sid="+id+'&value='+int)
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

// 單筆刪除
function delete_one(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = 'admin_job_delete.php?sid=' + sid;
        }
    }

 

    // 多重刪除 
    function delete_all() {
        let sid = [];
        var checkBoxes = $('tbody .checkboxeach input'); 
        checkBoxes.each(function() {
            if ($(this).prop('checked')) {
                sid.push($(this).val())
            }
        });
        if (!sid.length) {
            alert('沒有選擇任何資料');
        } else {
            if (confirm('確定要刪除這些資料嗎？')) {
                location.href = 'admin_job_delete_all.php?sid=' + sid.toString();
            }
        }
    }
    </script>

<?php require_once __DIR__ . "/__footer.php"; ?>