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

$sql = sprintf("SELECT * FROM course_tb  ORDER BY `sid` DESC LIMIT %s, %s",
        ($page-1)*$per_page,
            $per_page
);

$stmt = $pdo->query($sql);

$check=[];
?>   
<?php require_once __DIR__ . "/admin__header.php"; ?>
<link rel="stylesheet" href="css/index.css">

    <style>

    /* 頁數 */
    .pageNavigation{
        background-color: #fff;
        padding: 10px 20px;
        border-radius: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,.2);
    }

    .pageNavigation li{
        list-style: none;
        line-height: 30px;
        margin: 0 5px;
    }

    .pageNavigation li.page-number{
        width: 30px;
        height: 30px;
        border-radius: 50%;
        text-align: center;
    }

    .pageNavigation li a{
        display: block;
        text-decoration: none;
        color: #777;
        font-weight: 900;
        border-radius: 50%;
        transition: .3s;
        
    }

    .pageNavigation li.page-number:hover a,
    .pageNavigation li.page-number.active a{
        background-color: var(--dark);
        color: #fff;
    }

    .pageNavigation li:first-child{
        margin-right: 30px;
        font-weight: 700;
        font-size: 16px;
    }

    .pageNavigation li:last-child{
        margin-left: 30px;
        font-weight: 700;
        font-size: 16px;
    }


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
   
    
    </style>
</head>
<body>
<?php require_once __DIR__ . "/admin__nav_bar.php"; ?>

    <div class="wrapper d-flex">
        
    <?php require_once __DIR__ . "/admin__left_menu.php"; ?>
    
        <div class="mainContent ">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-11 p-0 mt-5 ml-3 ">
                    
                        <!-- html馬打這裡 -->
                        <div class="container ">
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
                        </ul>

<div style="margin-top: 1.25rem;">
    <h2 class="card-title" style="text-align:center;">課程列表 </h2>

    <div class="d-flex justify-content-end mb-4">
        <ul class="pageNavigation d-flex justify-content-end m-0">
                <li class="pageDir">
                    <a class="" href="?page=<?= $page-1 ?>">
                        <i class="fas fa-caret-left"></i>
                        Prev
                    </a>
                </li>

                <?php 
                    $pageStart = $page-2;
                    $pageEnd = $page+2;
                ?>
                <?php if( $page <= 3  ): ?>
                <?php    $pageStart = 1;?>
                <?php    $pageEnd = $page+5; ?>
                    <?php for($i=$pageStart; $i <= $pageEnd -$page ; $i++): 
                            if ($i < 1 or $i > $totalPages) {
                                continue;
                            }?>
                        <li class="page-number <?= $i==$page ? 'active' : ''  ?>">
                            <a class="" href="?page=<?= $i ?>" > <?= $i ?> </a>
                        </li>
                    <?php endfor; ?>
                <?php elseif($page > $totalPages-2): ?>
                <?php $pageStart = $totalPages-4 ?>
                    <?php for($i=$pageStart; $i <= $totalPages; $i++): 
                        if ($i < 1 or $i > $totalPages) {
                                continue;
                        }?>
                        <li class="page-number <?= $i==$page ? 'active' : ''  ?>">
                            <a class="" href="?page=<?= $i ?>" > <?= $i ?> </a>
                        </li>
                    <?php endfor; ?>
                <?php else: ?>
                    <?php for($i=$pageStart; $i <= $pageEnd; $i++): 
                        if ($i < 1 or $i > $totalPages) {
                                continue;
                        }?>
                        <li class="page-number <?= $i==$page ? 'active' : ''  ?>">
                            <a class="" href="?page=<?= $i ?>" > <?= $i ?> </a>
                        </li>
                    <?php endfor; ?>
                <?php endif; ?>
                                            

                <li class="">
                    <a class="pageDir" href="?page=<?= $page+1 ?>">
                        Next
                        <i class="fas fa-caret-right"></i>
                    </a>
                </li>
        </ul>
    </div>

                                    


    <table class="table table-hover ">
        <thead>
        <tr>
            <th scope="col">
                <label class='checkbox-inline checkboxeach'>
                        <!-- 選取全部 -->
                    <input id='checkAll' type='checkbox' name='checkboxall' value='1'>
                </label>選取
            </th>
            <!--刪除全部 -->
            <th scope="col"><a href="javascript:delete_all()" style="outline: none;"><i class="fas fa-trash delete_all"></i></a></th>
                
            <th scope="col"class="box_td">#</th>
            <!-- <th scope="col"class="box_td">帳號（電子信箱）</th> -->
            <th scope="col"class="box_td">課程名稱</th>
            <!-- <th scope="col"class="box_td">課程類型</th> -->
            <th scope="col"class="box_td">課程開始時期</th>
            <th scope="col"class="box_td">課程結束時期</th>
            <th scope="col"class="box_td">課程時間</th>
            <th scope="col"class="box_td">課程人數</th>
            <th scope="col"class="box_td">上課地點</th>
            <th scope="col"class="box_td">課程價格</th>
            <th scope="col"class="box_td">課程優惠價格</th>
            <!-- <th scope="col"class="box_td">課程描述</th> -->
            <th scope="col"class="box_td">課程圖片</th>
            <th scope="col"class="box_td">編輯</th>
            <!-- <th scope="col"class="box_td"><i class="fas fa-trash-alt"></i></th> -->
        </tr>
        </thead>
        <tbody>
        <?php while($r=$stmt->fetch()){  ?>
            <tr>
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
                <td class="box_td"><?= $r['sid'] ?></td>
                <!-- <td class="box_td"><?= htmlentities($r['email'])?></td> -->
                <td class="box_td"><?= htmlentities($r['course_name']) ?></td>
                <!-- <td class="box_td"><?= htmlentities($r['course_sort']) ?></td> -->
                <td class="box_td"><?= htmlentities($r['course_begindate']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_enddate']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_time']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_person']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_address']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_price']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_bonus']) ?></td>
                <!-- <td class="box_td"><?= htmlentities($r['course_describe']) ?></td> -->
                <td><img src="uploads/<?=$r['course_pic']?>" alt=""  width="150"></td>
                <td><a href="admin_course_edit.php?sid=<?= $r['sid'] ?>">
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
    $('.list-link.active').css('color','var(--red)');

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
