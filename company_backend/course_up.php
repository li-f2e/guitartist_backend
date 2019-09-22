<!-- 可以改成自己的連結黨 -->
<?php require '__admin_required.php'; ?>
<?php require_once __DIR__ . "/init.php"; ?>
<?php
$page_name = 'course_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 5; // 每一頁要顯示幾筆
$email=$_SESSION['loginUser']['email'];

$t_sql = "SELECT COUNT(1) FROM `course_tb` WHERE `course_down`='0' & `email`='$email'";

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows / $per_page); // 取得總頁數

if ($page < 1) {
    header('Location: course_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: course_list.php?page=' . $totalPages);
    exit;
}

$sql = sprintf(
    "SELECT * FROM course_tb WHERE `email`=? AND `course_down`='0' ORDER BY `sid` DESC LIMIT %s, %s",
    ($page - 1) * $per_page,
    $per_page
);
// $sql = "SELECT * FROM course_tb  WHERE `email`=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_SESSION['loginUser']['email']
]);
?>

<?php require_once __DIR__ . "/__header.php"; ?>
<link rel="stylesheet" href="css/index.css">

<style>
    ul li.pageNumber{
        width:38px;
        height:50px;
        line-height:50px;
        text-align:center;
    }
    ul li a{
        display:block;
        text-decoration:none;
        color:black;
        font-weight:600;
        border-radius:40%;
    }
    ul li.pageNumber:hover a,
    {
        background:#333;
        color:#fff;
    }
    .table td {
        vertical-align: middle;
        color: #6c757d;
    }
    .downup a{
        font-size: 20px;
        text-decoration: none;
        color: grey;
    }
    .downup span{
        font-size:20px;
        color:grey;
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
</style>
</head>

<body>
    <?php require_once __DIR__ . "/teacher__nav_bar.php"; ?>

    <div class="wrapper d-flex">

        <?php require_once __DIR__ . "/teacher__left_menu.php"; ?>

        <div class="mainContent ">
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-10 p-0 mt-5 mx-auto ">
                        <!-- 商品狀態 -->

                        
                            <div style="margin-top: 2rem;">
                                <div class="downup">
                                    <a href="course_list.php">全部</a><span> |</span>
                                    <a href="course_up.php">上架中</a><span> |</span>
                                    <a href="course_down.php">下架中</a>
                                </div>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination d-flex justify-content-center">
                                        <li class="page-item pageNumber">
                                            <a class="page-link" href="?page=<?= $page-1 ?>">
                                                <i class="fas fa-caret-left"></i>
                                            </a>
                                        </li>
                                        
                                        <?php 
                                            $pageStart = $page-5;
                                            $pageEnd = $page+5;
                                        ?>
                                        <?php if( $page <= 5  ): ?>
                                        <?php    $pageStart = 0;?>
                                        <?php    $pageEnd = $page+11; ?>
                                            <?php for($i=$pageStart; $i <= $pageEnd -$page ; $i++): 
                                                if($i<1 or $i>$totalPages){
                                                    continue;
                                                }?>
                                                <li class="page-item pageNumber <?= $i==$page ? 'active' : ''  ?>">
                                                    <a class="page-link" href="?page=<?= $i ?>" > <?= $i ?> </a>
                                                </li>
                                            <?php endfor; ?>
                                        <?php elseif($page > $totalPages-5): ?>
                                        <?php $pageStart = $totalPages-10 ?>
                                            <?php for($i=$pageStart; $i <= $pageEnd; $i++): ?>
                                                <?php   if($i<1 or $i>$totalPages){ continue; } ?>
                                                    <li class="page-item pageNumber <?= $i==$page ? 'active' : ''  ?>">
                                                        <a class="page-link" href="?page=<?= $i ?>" > <?= $i ?> </a>
                                                    </li>
                                            <?php endfor; ?>
                                        <?php else: ?>
                                            <?php for($i=$pageStart; $i <= $pageEnd; $i++): ?>
                                            <?php   if($i<1 or $i>$totalPages){ continue; } ?>
                                                <li class="page-item pageNumber <?= $i==$page ? 'active' : ''  ?>">
                                                    <a class="page-link" href="?page=<?= $i ?>" > <?= $i ?> </a>
                                                </li>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                            

                                        <li class="page-item pageNumber">
                                            <a class="page-link" href="?page=<?= $page+1 ?>">
                                                <i class="fas fa-caret-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <div>總共有 <?= $totalRows; ?> 筆商品</div>

                                <table class="table table-sm product-table">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th scope="col" style="vertical-align:left;">
                                                <label class='checkbox-inline checkboxAll'>
                                                    全選
                                                    <input id='checkAll' type='checkbox' name='checkboxall' value='1' class="regular-checkbox"><label for="checkAll">
                                                </label>
                                            </th>
                                            <!--刪除全部 -->
                                            <th scope="col"><a href="javascript:delete_all()" style="outline: none;"><i class="fas fa-trash delete_all"></i></a></th>

                                            <th scope="col" >編號 <a href="course_list2.php"><i class="fas fa-sort"></i></a></th>
                                            <!-- <th scope="col">帳號（電子信箱）</th> -->
                                            <th scope="col" >名稱</th>
                                            <th scope="col" >類型</th>
                                            <th scope="col" >開始日期</th>
                                            <th scope="col" >結束時期</th>
                                            <th scope="col" >時間</th>
                                            <th scope="col" >人數</th>
                                            <th scope="col" >地點</th>
                                            <th scope="col" >價格</th>
                                            <th scope="col" >優惠價格</th>
                                            <!-- <th scope="col" >描述</th> -->
                                            <th scope="col" >圖片</th>
                                            <th scope="col" >編輯</i></th>
                                            <th scope="col" >狀態</th>

                                        </tr>
                                    </thead>
                                    <tbody class="table-striped">
                                        <?php while ($r = $stmt->fetch()) {  ?>
                                            <tr>
                                                <td>
                                                    <label class=' checkbox-inline checkboxAll'>
                                                        <!-- 單個刪除選sid -->
                                                        <input id="<?= 'delete' . $r['sid'] ?>" type='checkbox' name=<?= 'delete' . $r['sid'] . '[]' ?> value='<?= $r['sid'] ?>'>
                                                    </label>
                                                </td>
                                                <td>
                                                    <!-- 刪除單個sid -->
                                                    <!-- <a style="outline: none;" href="javascript:delete_one(<?= $r['sid'] ?>)"><i class="fas fa-trash-alt"></i></a> -->


                                                </td>
                                                <td class="box_td"><?= $r['sid'] ?></td>
                                                <!-- <td class="box_td"><?= htmlentities($r['email']) ?></td> -->
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
                                                <td><img src="uploads/<?= $r['course_pic'] ?>" alt="" width="150"></td>
                                                <td><a href="course_edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                                                <td>
                                                    <?php
                                                    $d=$r['course_down']=="0"? "block":"none";
                                                    $u=$r['course_down']=="1"? "block":"none";
                                                    ?>
                                                <a href="javascript:down_one(<?= $r['sid'] ?>)"><i class="fas fa-arrow-down " style="display:<?=$d?>"></i></a>
                                                <a href="javascript:up_one(<?= $r['sid'] ?>)"><i class="fas fa-arrow-up " style="display:<?=$u?>"></i></a>
                                                </td>
                                                <!-- <td class="align-middle ">

                                                <? if($r['course_down']): ?>
                                                    <a class="launchedBtn" id="btn<?= $r['sid'] ?>" href="javascript: down_one(<?= $r['product_id'] ?>, 0)">
                                                        下架中
                                                    </a>
                                                <? else: ?>
                                                    <a class="launchedBtn" id="btn<?= $r['sid'] ?>" href="javascript: up_one(<?= $r['product_id'] ?>, 1)">
                                                        上架中
                                                    </a> 
                                                <? endif; ?>

                                                </td> -->
                                                
                                                
                    
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        //上架課程
        function up_one(sid) {
            if (confirm(`確定要上架編號為 ${sid} 的課程嗎?`)) {
                location.href = 'course_up_api.php?sid=' + sid;
            }
        }
        //下架課程
        function down_one(sid) {
            if (confirm(`確定要下架編號為 ${sid} 的課程嗎?`)) {
                location.href = 'course_down_api.php?sid=' + sid;
            }
        }
        // 單筆刪除
        function delete_one(sid) {
            if (confirm(`確定要刪除編號為 ${sid} 的課程嗎?`)) {
                location.href = 'course_delete.php?sid=' + sid;
            }
        }
        //checkbox全選
        
        let checkAll = $('#checkAll'); //全選
        let checkBoxes = $('tbody .checkboxAll input'); //其他勾選欄位
        // 以長度來判斷
        checkAll.click(function() {
            for (let i = 0; i < checkBoxes.length; i++) {
                checkBoxes[i].checked = this.checked;
            }
        })
    
        // 批次刪除 
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
                    location.href = 'course_delete_all.php?sid=' + sid.toString();
                }
            }
        }
    </script>

    <?php require_once __DIR__ . "/__footer.php"; ?>