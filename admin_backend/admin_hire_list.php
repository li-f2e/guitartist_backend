<?php
require '__admin_required.php';
require 'init.php';

// $stmt = $pdo->query("SELECT * FROM `member_list` WHERE `is_hall_owner`=1");

// $rows = $stmt->fetchAll();
//用戶選的頁面是第幾頁? 沒有選的話就是1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

//每一頁顯示幾筆
$perPage = 1;
$sql_total = "SELECT COUNT(1) FROM `member_list` WHERE is_hire=1";
//執行SQL語法並 拿到總比數
$totalRows = $pdo->query($sql_total)->fetch(PDO::FETCH_NUM)[0];
// 有幾頁 = 總比數/每一頁顯示幾筆
$totalPages = ceil($totalRows / $perPage);

if ($page < 1) {
    header("Location: admin_hire_list.php");
    exit();
}
;

if ($page > $totalPages) {
    header("Location: admin_hire_list.php?page={$totalPages}");
    exit();
}
;

$sql_page = sprintf("SELECT * FROM `member_list` WHERE `is_hire` =1 ORDER BY `sid` DESC LIMIT %s, %s",($page - 1) * $perPage, $perPage);
$stmt = $pdo->query($sql_page);
include 'admin__header.php';
include 'admin__nav_bar.php';

?>
<style>
*{
    font-family: 微軟正黑體;
}


.fa-ban{
    font-size: 20px;
    color: var(--red);
}

.table{
    font-size: 14px;
}

th{
    /* text-align:center; */
    vertical-align: middle;
}


.member-logo{
    width: 45px;
    height: 45px;
    border-radius: 50%;
    overflow: hidden;
    object-fit: cover;
}

</style>



<div class="wrapper d-flex">

    <?php require "admin__left_menu.php";?>

    <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-11 mt-5 mx-auto">
                       <div class="container">
                       <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_backend_insert.php" style="color: var(--dark);">新增使用者</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_backend_list.php" style="color: var(--dark);">後台使用者總表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_company_list.php" style="color: var(--dark);">代理商列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_teacher_list.php" style="color: var(--dark);">老師列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_hall_list.php" style="color: var(--dark);">場地廠商列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="admin_hire_list.php" style="color: var(--dark);">徵才廠商列表</a>
                                </li>
                            </ul>

                            <!-- //換頁按鈕 -->
                            <div class="d-flex justify-content-end my-4">
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

                        <div style="margin-top: 2rem;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="vertical-align:left;">
                                        <label class='checkbox-inline checkboxAll'>
                                            <input id='checkAll' type='checkbox' name='checkboxall' value='1' class="regular-checkbox"><label for="checkAll">
                                        </label>
                                    </th>
                                    <th scope="col"><a href="javascript:delete_all()" style="outline: none;"><i class="fas fa-trash delete_all"></i></a></th>
                                    <th>照片</th>
                                    <th scope="col">廠商名稱</th>
                                    <th scope="col">電子信箱</th>
                                    <th scope="col">密碼</th>
                                    <th scope="col">統一編號</th>
                                    <th scope="col">連絡電話</th>
                                    <th scope="col">地址</th>
                                    <th scope="col">編輯</th>
                                    <th scope="col">禁用</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($r = $stmt->fetch()) {?>
                                <tr>
                                    <td><?=$r['sid']?></td>
                                    <td>
                                        <label class=' checkbox-inline checkboxAll'>
                                        <!-- 單個刪除選sid -->
                                            <input id="<?='delete' . $r['sid']?>" type='checkbox' name=<?='delete' . $r['sid'] . '[]'?> value='<?=$r['sid']?>'>
                                        </label>
                                    </td>
                                    <td>
                                        <!-- 刪除單個sid -->
                                        <a style="outline: none;" href="javascript:delete_one(<?=$r['sid']?>)"><i class="fas fa-trash-alt"></i></a>
                                     </td>
                                    <td class="p-1"><img class="member-logo" src="uploads/<?=$r['pic']?>" alt=""></td>
                                    <td><?=$r['name']?></td>
                                    <td><?=$r['email']?></td>
                                    <td><?=$r['password']?></td>
                                    <td><?=$r['tax_id']?></td>
                                    <td><?=$r['tel']?></td>
                                    <td>
                                        <?=$r['addr_district']?>
                                        <?=$r['addr']?>
                                    </td>
                                    <td>
                                        <a href="admin_hire_info.php?sid=<?=$r['sid']?>"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <a class="ban" href="javascript:ban_one(<?=$r['sid']?>)" style="color: <?=$r['is_suspended'] == 1 ? 'red' : 'rgb(0, 123, 255)'?>"><i class="fas fa-ban"></i></a>
                                    </td>
                                </tr>
                                <?php }
;?>
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
        //被選取的頁簽文字顏色變紅
        $('.nav-link.active').css('color','var(--red)');

        function delete_one(sid) {
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'data_delete.php?sid=' + sid;
            }
        }

        function ban_one(sid) {
            let ban_btn = document.querySelector('.ban[href="javascript:ban_one(' + sid + ')"]');

            if(ban_btn.style.color == 'rgb(0, 123, 255)'){
                if(confirm(`確定要禁用編號為 ${sid} 的資料嗎?`)){
                    location.href = 'data_ban.php?sid=' + sid;
                }
            }else{
                if(confirm(`確定要解除編號為 ${sid} 的禁用嗎?`)){
                    location.href = 'remove_data_ban.php?sid=' + sid;
                }
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
                    location.href = 'delete_all.php?sid=' + sid.toString();
                }
            }
        }
    </script>

<?php include 'admin__footer.php';?>

