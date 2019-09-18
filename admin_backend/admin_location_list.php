<?php
// require '__admin_required.php';
require 'init.php';
$page_name = 'data_list';
$page_title = '資料列表';

// $sql_location = "SELECT * FROM `location` WHERE `email`=?";
// $stmt = $pdo->prepare($sql_location);
// $stmt->execute([
//     $_SESSION['loginUser']['email'],
// ]);


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 5; // 每一頁要顯示幾筆
// $e_mail=$_SESSION['loginUser']['email'];
$t_sql = "SELECT COUNT(1) FROM `location` ";

// $t_sql = "SELECT COUNT(1) FROM `location` WHERE`location_sid`";
// $t_sql = "SELECT COUNT(1) FROM `location` JOIN `member_list` ON `location`.`email` = `member_list`.`email`";
// $t_sql = "SELECT COUNT(1) FROM `member_list`";


$t_stmt = $pdo->query($t_sql);

$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows / $per_page); // 取得總頁數

if ($page < 1) {
    header('Location: admin_location_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: admin_location_list.php?page=' . $totalPages);
    exit;
}

// $total_sql = sprintf(
//     "SELECT * FROM `location` ORDER BY `location_sid` LIMIT %s, %s",
//     ($page - 1) * $per_page,
//     $per_page
// );

// $sql = "SELECT * FROM `location`";
// $stmt_list = prepare($sql);
// $rows = $stmt_list->fetchAll();


$sql = sprintf("SELECT * FROM `location`  ORDER BY `location_sid` LIMIT %s, %s",
($page - 1) * $per_page,
$per_page
);
    $stmt = $pdo->query($sql);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>',print_r($rows),'</pre>'


?>
<?php include __DIR__ . '/admin__header.php' ?>

</head>

<style>
    .fa-user-alt{
        font-size: 25px;
    }

    .fa-hotel{
        font-size: 22px;
    }

    .fa-list-alt{
        font-size: 25px;
    }

    .fa-piggy-bank{
        font-size: 23px;
    }

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

    .mainContent-css{
        background-color: #F9F9F9;
    }

    .card-css{
        border: none;
        border-radius: 8px;
        box-shadow: 3px 8px 8px #ccc;
    }

</style>

<body>


<?php include __DIR__ . '/admin__nav_bar.php' ?>

<div class="wrapper d-flex">
    <?php include 'admin__left_menu.php' ?>
    <div class="mainContent mainContent-css">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 p-0 mt-5 mr-0 ml-0">

                        <!-- 頁籤 -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item ">
                                <a class="nav-link list-link " href="admin_product_list.php" style="color: var(--dark);">商品列表</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link list-link" href="admin_course_list.php" style="color: var(--dark);" >課程列表</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link list-link active" href="admin_location_list.php" style="color: var(--dark);" >場地列表</a>
                            </li>
                        </ul>

                        <div class="card card-css">
                            <div class="card-body">
                                <h2 class="card-title" style="text-align:center;">場地列表 </h2>
                                <div class="d-flex justify-content-end mb-4">
                                
                                    <ul class="pageNavigation d-flex justify-content-end m-0">
                                            <li class="pageDir"">
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
                                            <th scope="col">刪除</th>
                                            <th scope="col" >#</th>
                                            <th scope="col" style="width:11%;">場地名稱</th>
                                            <th scope="col" style="width:11%;">場地地址</th>
                                            <th scope="col" style="width:11%;">場地電話</th>
                                            <th scope="col" style="width:20%;">場地資訊</th>
                                            <th scope="col" style="width:11%;">可納人數</th>
                                            <th scope="col" style="width:11%;">場地價錢</th>
                                            <th scope="col" style="width:11%;">開放時間</th>
                                            <!-- <th scope="col">圖片</th> -->
                                            <th scope="col">編輯</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php foreach ($rows as $r ) {  ?>
                                        <tr>
                                            <td>
                                                <a href="javascript:delete_one(<?= $r['location_sid'] ?>)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                            <td><?= $r['location_sid'] ?></td>
                                            <td><?= htmlentities($r['location-name']) ?></td>
                                            <td><?= htmlentities($r['location-address']) ?></td>
                                            <td><?= htmlentities($r['location-phone']) ?></td>
                                            <td><?= htmlentities($r['location-information']) ?></td>
                                            <td><?= htmlentities($r['location-people']) ?></td>
                                            <td><?= htmlentities($r['location-price']) ?>元</td> 
                                            <td>
                                                <?= 
                                                    htmlentities(
                                                    implode(',', json_decode($r['open-day']) )
                                                    ) 
                                                ?>
                                            </td> 
                                            <!-- <td><img src="upload/<?= $r['pic'] ?>" alt=""></td> -->
                                            <td>
                                                <a href="admin_location_edit.php?location_sid=<?= $r['location_sid'] ?>"><i class="fas fa-edit"></i></a>
                                                <!-- <i class="fas fa-edit" href="location_edit.php?location_sid=<?= $r['location_sid'] ?>"></<i> -->
                                            </td>
                                        </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   
                </div>
            </div>

            <script>
                $('.list-link.active').css('color','var(--red)');

                function delete_one(location_sid) {
                    if (confirm(`確定要刪除編號為 ${location_sid} 的資料嗎?`)) {
                        location.href = 'location_delete.php?location_sid=' + location_sid;
                    }
                }
            </script>
        
        
        
        </div>
    </div>
</div>

<?php include __DIR__ . '/admin__footer.php' ?>