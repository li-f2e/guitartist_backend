
<!-- 可以改成自己的連結黨 -->
<?php require '__admin_required.php'; ?>
<?php require_once __DIR__ . "/__connect_db.php"; ?>    
<?php
    $page_name = 'course_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 5; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(1) FROM `course_tb` ";

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows/$per_page); // 取得總頁數

if($page < 1){
    header('Location: course_list.php');
    exit;
}
if($page > $totalPages){
    header('Location: course_list.php?page='. $totalPages);
    exit;
}

$sql = sprintf("SELECT * FROM course_tb WHERE `email`=? ORDER BY `sid` DESC LIMIT %s, %s",
        ($page-1)*$per_page,
            $per_page
);
// $sql = "SELECT * FROM course_tb  WHERE `email`=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_SESSION['loginUser']['email']
]);

// $stmt = $pdo->query($sql);

//$rows = $stmt->fetchAll() 
// echo '<pre>',print_r($_SESSION),'</pre>';

$check=[];
?>   
<?php require_once __DIR__ . "/__header.php"; ?>
<link rel="stylesheet" href="css/index.css">

    <style>
     .table td{
        vertical-align: middle;
        color : #6c757d;
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
                    <div class="col-10 p-0 mt-5 ml-3 ">
                        <!-- html馬打這裡 -->
                        <div class="container ">
<div style="margin-top: 2rem;">
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


    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col" style="vertical-align:left;">
                    <label class='checkbox-inline checkboxeach'>
                        <!-- 選取全部 -->全選
                        <input id='checkAll' type='checkbox' name='checkboxall' value='1' class="regular-checkbox"><label for="checkAll"></label></label></label>
            </th>
            <!--刪除全部 -->
            <th scope="col"><a href="javascript:delete_all()" style="outline: none;"><i class="fas fa-trash delete_all"></i></a></th>
                
            <th scope="col"class="box_td">#</th>
            <!-- <th scope="col"class="box_td">帳號（電子信箱）</th> -->
            <th scope="col"class="box_td">課程名稱</th>
            <th scope="col"class="box_td">課程類型</th>
            <th scope="col"class="box_td">課程開始時期</th>
            <th scope="col"class="box_td">課程結束時期</th>
            <th scope="col"class="box_td">課程時間</th>
            <th scope="col"class="box_td">課程人數</th>
            <th scope="col"class="box_td">上課地點</th>
            <th scope="col"class="box_td">課程價格</th>
            <th scope="col"class="box_td">課程優惠價格</th>
            <th scope="col"class="box_td">課程描述</th>
            <th scope="col"class="box_td">課程圖片</th>
            <th scope="col"class="box_td"><i class="fas fa-edit"></i></th>
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
                <td class="box_td"><?= htmlentities($r['course_sort']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_begindate']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_enddate']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_time']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_person']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_address']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_price']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_bonus']) ?></td>
                <td class="box_td"><?= htmlentities($r['course_describe']) ?></td>
                <td><img src="uploads/<?=$r['course_pic']?>" alt=""  width="150"></td>
                <td><a href="course_edit.php?sid=<?= $r['sid'] ?>">
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

// 單筆刪除
function delete_one(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = 'course_delete.php?sid=' + sid;
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
                location.href = 'course_delete_all.php?sid=' + sid.toString();
            }
        }
    }
    </script>

<?php require_once __DIR__ . "/__footer.php"; ?>
