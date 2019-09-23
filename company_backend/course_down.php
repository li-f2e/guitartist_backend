<?php require "__admin_required.php";
require_once __DIR__ . "/init.php"; 
?>    
<?php

$page_name = 'data_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 5; // 每一頁要顯示幾筆

$email = $_SESSION['loginUser']['email'];
// echo  $email;
$t_sql = "SELECT COUNT(1) FROM `course_tb` WHERE `course_down`='1' & `email`='$email'";

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows/$per_page); // 取得總頁數

if($page < 1){
    header('Location: course_list.php');
    exit;
}
if($page > $totalPages){
    header('Location: course_list.php?page='. $totalPages);
    exit;
}

$sql = "SELECT * FROM course_tb WHERE `email`='$email' AND `course_down`='1'";

$stmt = $pdo->query($sql);

$check=[];
?>   
<?php require_once __DIR__ . "/__header.php"; ?>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <style>

    /* 頁數
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
    } */


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
   
    .fa-times, .fa-edit, .fa-trash-alt{
        font-size: 1.5rem;
        color: var(--dark);
    }

    .fa-check{
        font-size: 1.5rem;
        color: var(--success);
    }

    .fa-ban{
        font-size: 1.5rem;
        color: var(--red);
    }

    .condition a{
        font-size: 20px;
        text-decoration: none;
        color: grey;
    }
    .condition span{
        font-size:20px;
        color:grey;
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
    
    </style>
</head>
<body>
<?php require_once __DIR__ . "/teacher__nav_bar.php"; ?>

    <div class="wrapper d-flex">
        
    <?php require_once __DIR__ . "/teacher__left_menu.php"; ?>
    
        <div class="mainContent ">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-11 p-0 mt-5 ml-3 ">
                    
                        <!-- html馬打這裡 -->
                        <div class="container ">
                        

                        <div style="margin-top: 1.25rem;">
                            <!-- <h2 class="card-title" style="text-align:center;">我的課程</h2> -->
                            <div class="condition my-3">
                                <a class="condition" href="course_list.php">全部</a>
                                <span>|</span>
                                <a class="condition" href="course_up.php">上架中</a>
                                <span>|</span>
                                <a class="condition" href="course_down.php">下架中</a>
                            </div> 

                            <div class="d-flex justify-content-start mb-4">
                                <table class="table table-hover course_table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 60px">編號</th>
                                            <th scope="col" style="">
                                                <label class='checkbox-inline checkboxeach'>
                                                    <!-- 選取全部 -->
                                                    選取
                                                </label>
                                                <input id='checkAll' type='checkbox' name='checkboxall' value='1'>
                                            </th>
                                            <!--刪除全部 -->
                                            <th scope="col" style="">
                                                <a href="javascript:delete_all()" style="outline: none;">
                                                    <i class="fas fa-trash delete_all"></i>
                                                </a>
                                            </th>
                                            <!-- <th scope="col"class="box_td">帳號（電子信箱）</th> -->
                                            <th scope="col"class="box_td" style="width: 60px">名稱</th>
                                            
                                            <th scope="col"class="box_td" style="width: 60px">開始日期</th>
                                            <th scope="col"class="box_td" style="width: 60px">結束日期</th>
                                            <th scope="col"class="box_td" style="width: 60px">時間</th>
                                            <th scope="col"class="box_td" style="width: 60px">人數</th>
                                            <th scope="col"class="box_td" style="width: 60px">地點</th>
                                            <th scope="col"class="box_td" style="width: 60px">價格</th>
                                            <th scope="col"class="box_td" style="width: 60px">優惠</th>
                                            <!-- <th scope="col"class="box_td" style="width: 60px">課程描述</th> -->
                                            <th scope="col"class="box_td" style="width: 150px">課程圖片</th>
                                            <th scope="col"class="box_td" style="width: 60px">編輯</th>
                                            <th scope="col" >狀態</th>
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
                                            
                                            <td class="box_td"><?= htmlentities($r['course_begindate']) ?></td>
                                            <td class="box_td"><?= htmlentities($r['course_enddate']) ?></td>
                                            <td class="box_td"><?= htmlentities($r['course_time']) ?></td>
                                            <td class="box_td"><?= htmlentities($r['course_person']) ?></td>
                                            <td class="box_td"><?= htmlentities($r['course_address']) ?></td>
                                            <td class="box_td"><?= htmlentities($r['course_price']) ?></td>
                                            <td class="box_td"><?= htmlentities($r['course_bonus']) ?></td>
                                            <!-- <td class="box_td"><?= htmlentities($r['course_describe']) ?></td> -->
                                            <td><img src="uploads/<?=$r['course_pic']?>" alt="" style="width:80px;" ></td>
                                            <td><a href="course_edit.php?sid=<?= $r['sid'] ?>">
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>


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
            { "orderable": false, "targets": 5},
            { "orderable": false, "targets": 8},
            { "orderable": false, "targets": 11},
            { "orderable": false, "targets": 12},
            { "orderable": false, "targets": 13},

        ]
    });

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





    let checkAll = $('#checkAll'); //控制所有勾選的欄位
    let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位
    // 以長度來判斷
    checkAll.click(function() {
        for (let i = 0; i < checkBoxes.length; i++) {
            checkBoxes[i].checked = this.checked;
        }
    })


    $('.list-link.active').css('color','var(--red)');

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
