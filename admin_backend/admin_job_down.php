<?php require_once __DIR__ . "/init.php"; ?>    
<?php
    // $page_name = 'data_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 5; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(1) FROM `job_list` WHERE `job_out` ='1' ";

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

$sql = sprintf("SELECT * FROM job_list WHERE `job_out` = '1' ORDER BY `sid` DESC LIMIT %s, %s",
        ($page-1)*$per_page,
            $per_page
);

$stmt = $pdo->query($sql);

$check=[];
?>   
<?php require_once __DIR__ . "/admin__header.php"; ?>
<link rel="stylesheet" href="css/index.css">

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
        padding: 0 13px;
        letter-spacing: 2px;
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
    
        <div class="mainContent ">
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-10 p-0 mt-5 ml-3 ">
                        <!-- html馬打這裡 -->
                        <div class="container ">
                        <ul class="nav nav-tabs">
                                <li class="nav-item ">
                                    <a class="nav-link " href="admin_product_list.php">商品列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_course_list.php">課程列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_location_list.php">場地列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="admin_job_list.php">徵才列表</a>
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
<!-- 換頁按鈕 -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page-1 ?>">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
            <?php
            $p_start = $page-5;
            $p_end = $page+5;
            for($i=$p_start; $i<=$p_end; $i++):
                if($i<1 or $i>$totalPages) continue;
                ?>
            <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page+1 ?>">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>

         <!-- 總比數計數器 -->
         <div class="my-2  pl-2">
              <button id='checkAll' class="checkAll btn btn-info mr-2" name='checkboxall'>全選</button>
              <button id='antiCheckAll' class="checkAll btn btn-info mr-2" name='checkboxall'>反選</button>
                 總共有 <?= $totalRows; ?> 筆商品
              </div>
    <table class="table table-striped table-bordered">
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
                
            <th scope="col"class="box_td">狀態</th>
            <!-- <th scope="col"class="box_td">帳號（電子信箱）</th> -->
            <th scope="col"class="box_td">職缺名稱</th>
            <th scope="col"class="box_td">職缺類型</th>
            <th scope="col"class="box_td">職缺內容</th>
            <th scope="col"class="box_td">報酬</th>
            <th scope="col"class="box_td">工作經驗</th>
            <th scope="col"class="box_td">需求人數</th>
            <th scope="col"class="box_td">急徵</th>
            <th scope="col"class="box_td">全職/半職</th>
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
                <td class="box_td"><?= htmlentities($r['job_pay']) ?></td>
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

    <script>
    let checkAll = $('#checkAll'); //控制所有勾選的欄位
    let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位
    // 以長度來判斷
    checkAll.click(function() {
        for (let i = 0; i < checkBoxes.length; i++) {
            checkBoxes[i].checked = this.checked;
        }
    })
</script>
<script> 
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