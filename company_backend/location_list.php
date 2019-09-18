<?php
require '__admin_required.php';
require 'init.php';
$page_name = 'HALL LIST';
$page_title = '資料列表';

// $sql_location = "SELECT * FROM `location` WHERE `email`=?";
// $stmt = $pdo->prepare($sql_location);
// $stmt->execute([
//     $_SESSION['loginUser']['email'],
// ]);


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10; // 每一頁要顯示幾筆
$e_mail=$_SESSION['loginUser']['email'];
$t_sql = "SELECT COUNT(1) FROM location  WHERE `email`='$e_mail'";

// $t_sql = "SELECT COUNT(1) FROM `location` WHERE`location_sid`";
// $t_sql = "SELECT COUNT(1) FROM `location` JOIN `member_list` ON `location`.`email` = `member_list`.`email`";
// $t_sql = "SELECT COUNT(1) FROM `member_list`";


$t_stmt = $pdo->query($t_sql);

$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows / $per_page); // 取得總頁數

if ($page < 1) {
    header('Location: location_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: location_list.php?page=' . $totalPages);
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


$sql = sprintf("SELECT * FROM `location` WHERE `email`=? ORDER BY `location_sid` LIMIT %s, %s",
($page - 1) * $per_page,
$per_page
);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_SESSION['loginUser']['email']
    ]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>',print_r($rows),'</pre>'


?>
<?php include __DIR__ . '/__header.php' ?>

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

    .table td{
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


<?php include __DIR__ . '/__hall__nav_bar.php' ?>

<div class="wrapper d-flex">
    <?php include '__hall__left_menu.php' ?>
    <div class="mainContent mainContent-css">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 p-0 mt-5 mr-0 ml-0">
                        <div class="card card-css">
                            <div class="card-body">
                                <h2 class="card-title" style="text-align:center;">場地列表 </h2>
                                <div class="d-flex">
                                    <!-- <h5 class="card-title">場地列表</h5> -->
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?= $page - 1 ?>">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                                <?php
                                                $p_start = $page - 5;
                                                $p_end = $page + 5;
                                                for ($i = $p_start; $i <= $p_end; $i++) :
                                                if ($i < 1 or $i > $totalPages) {
                                                continue;
                                                }?>
                                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                                <?php endfor; ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?= $page + 1 ?>">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                               </div>
                               <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><i class="fas fa-trash-alt"></i></th>
                                            <th scope="col" >#</th>
                                            <th scope="col" style="width:11%;">場地名稱</th>
                                            <th scope="col" style="width:11%;">場地地址</th>
                                            <th scope="col" style="width:11%;">場地電話</th>
                                            <th scope="col" style="width:20%;">場地資訊</th>
                                            <th scope="col" style="width:11%;">可納人數</th>
                                            <th scope="col" style="width:11%;">場地價錢</th>
                                            <th scope="col" style="width:11%;">開放時間</th>
                                            <!-- <th scope="col">圖片</th> -->
                                            <th scope="col"><i class="fas fa-edit"></i></th>
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
                                                <a href="location_edit.php?location_sid=<?= $r['location_sid'] ?>"><i class="fas fa-edit"></i></a>
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
                function delete_one(location_sid) {
                    if (confirm(`確定要刪除編號為 ${location_sid} 的資料嗎?`)) {
                        location.href = 'location_delete.php?location_sid=' + location_sid;
                    }
                }
            </script>
        
        
        
        </div>
    </div>
</div>

<?php include __DIR__ . '/__footer.php' ?>