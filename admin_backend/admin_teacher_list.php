<?php
require '__admin_required.php';
require 'init.php';

$asc_sql = "";



//以上輩分

//用戶選的頁面是第幾頁? 沒有選的話就是1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
 isset($_GET['select_one'])? $selection = $_GET['select_one'] : $selection ='';
//每一頁顯示幾筆
$perPage = 10;


$sql_page = 'SELECT * FROM `member_list` WHERE `is_teacher`= 1 ';
$sql_count = 'SELECT COUNT(1) FROM `member_list` WHERE is_teacher= 1 ';

// .$asc_sql. "LIMIT ". ($page - 1) * $perPage . "," . $perPage;
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $select = $selection;

    
    $search_selection = " AND `$select` LIKE '%$search%' " ;
    $sql_page = $sql_page . $search_selection;
    $sql_count = $sql_count . $search_selection;
    // echo $sql_count;
} 

if (isset($_GET['asc_value'])) {
    echo $_GET['asc_value'];
    if ($_GET['asc_value'] == "▾") {
        $asc_sql = "ORDER BY `sid` ";
        $triangle = "▴";
    } 
    else {
        $triangle = "▾";
        $asc_sql = "ORDER BY `sid` DESC";
    }
} 
else {
    $triangle = "▾";
    $asc_sql = "ORDER BY `sid` DESC";
}


// $sql_total = "SELECT COUNT(1) FROM `member_list` WHERE is_teacher=1 ";
$sql_total = $sql_count;
// echo $sql_total;
//執行SQL語法並 拿到總比數
$totalRows = $pdo->query($sql_total)->fetch(PDO::FETCH_NUM)[0];
// 有幾頁 = 總比數/每一頁顯示幾筆
$totalPages = ceil($totalRows / $perPage);
if ($page < 1) {
    header("Location: admin_teacher_list.php");
    exit();
}
;

if ($page > $totalPages) {
    header("Location: admin_teacher_list.php?page={$totalPages}");
    exit();
}
;


$sql_final = $sql_page . $asc_sql." LIMIT ". ($page - 1) * $perPage . "," . $perPage;



echo '$sql_final = '.$sql_final;
$stmt = $pdo->query($sql_final);

include 'admin__header.php';
include 'admin__nav_bar.php';

?>



<div class="wrapper d-flex">

        <?php require "admin__left_menu.php";?>

            <div class="mainContent">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-10 p-0 mt-5 ml-3 ">
                        <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_backend_insert.php">新增使用者</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_backend_list.php">後台使用者總表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_company_list.php">代理商列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="admin_teacher_list.php">老師列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_hall_list.php">場地廠商列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_hire_list.php">徵才廠商列表</a>
                                </li>
                            </ul>
                            <!-- //換頁按鈕 -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination d-flex justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?=$page - 1?>">
                                            <i class="fas fa-caret-left"></i>
                                        </a>
                                    </li>

                                    <?php $pageStart = $page - 2; $pageEnd = $page + 2;?>
                                    <?php if ($page <= 3): ?>
                                    <?php $pageStart = 0;?>
                                    <?php $pageEnd = $page + 5;?>
                                    <?php
                                    for ($i = $pageStart; $i <= $pageEnd - $page; $i++):
                                    if ($i < 1 or $i > $totalPages) {
                                        continue;
                                    }?>
									<li class="page-item  <?=$i == $page ? 'active' : ''?>">
										<a class="page-link" href="?page=<?=$i?>" > <?=$i?> </a>
									</li>
									<?php endfor;?>
                                    <?php elseif ($page > $totalPages - 2): ?>
                                    <?php $pageStart = $totalPages - 4?>
                                        <?php for ($i = $pageStart; $i <= $totalPages; $i++): 
                                    if ($i < 1 or $i > $totalPages) {
                                        continue;
                                    }?>        
                                                <li class="page-item  <?=$i == $page ? 'active' : ''?>">
                                                    <a class="page-link" href="?page=<?=$i?>" > <?=$i?> </a>
                                                </li>
                                        <?php endfor;?>
                                    <?php else: ?>
                                        <?php for ($i = $pageStart; $i <= $pageEnd; $i++): ?>
                                            <li class="page-item  <?=$i == $page ? 'active' : ''?>">
                                                <a class="page-link" href="?page=<?=$i?>" > <?=$i?> </a>
                                            </li>
                                        <?php endfor;?>
                                    <?php endif;?>


                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?=$page + 1?>">
                                            <i class="fas fa-caret-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>

                             <div style="margin-top: 2rem;">
                            <!-- 搜尋功能 -->
                            <form name="form2"  method="post" action="">

                            <select  name="select_one" id="select_one">
                              <option value="" <?= isset($_GET['select_one']) ? '': 'selected'; ?>  >--請選擇--</option>
                            　<option value="name" <?= $selection == 'name'? 'selected': ''; ?>  >名稱</option>
                            　<option value="email" <?= $selection == 'email'? 'selected': ''; ?> >電子郵件</option>
                            　<option value="teacher_tel" <?= $selection == 'teacher_tel'? 'selected': ''; ?> >連絡電話</option>
                            </select>

                            <input type="text" name="search" id="search" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            <input onclick="classification2()" type="button" value="提交">


                            </form>


                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <!-- ▴ ▾ -->
                                    <th scope="col">
                                        <form name="form3"  method="post"> 排列
                                            <input type="hidden" name="asc_value" id="asc_value" value="<?=$triangle?>">
                                            <input id="sortBtn" onclick="classification()"  type="button"  class="arrange" value="<?=$triangle?>">
                                            <!-- <input id="sortBtn" onclick="classification()" name="submit2" type="submit" name="submit2" method="get" class="arrange" value="<?=$triangle?>"> -->
                                        </form>
                                    </th>
                                    <th scope="col" style="vertical-align:left;">
                                        <label class='checkbox-inline checkboxAll'>
                                            <input id='checkAll' type='checkbox' name='checkboxall' value='1' class="regular-checkbox"><label for="checkAll">
                                        </label>
                                    </th>
                                    <th scope="col"><a href="javascript:delete_all()" style="outline: none;"><i class="fas fa-trash delete_all"></i></a></th>
                                    <th scope="col">照片</th>
                                    <th scope="col">姓名</th>
                                    <th scope="col">電子信箱</th>
                                    <th scope="col">密碼</th>
                                    <th scope="col">生日</th>
                                    <th scope="col">聯絡電話</th>
                                    <th scope="col">專長</th>
                                    <!-- <th scope="col">作品影音</th> -->
                                    <th scope="col"><i class="fas fa-edit"></i></th>
                                    <th scope="col"><i class="fas fa-ban"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php while ($r = $stmt->fetch()) {?>
                                   <!-- <form name="form1" onsubmit="return checkForm()">                                     -->
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
                                    <td> <img src="uploads/<?=$r['teacher_pic']?>" class="pic" alt=""></td>
                                    <td><?=$r['teacher_name']?></td>
                                    <td><?=$r['email']?></td>
                                    <td><?=$r['password']?></td>
                                    <td><?=$r['teacher_birthday']?></td>
                                    <td><?=$r['teacher_tel']?></td>
                                    <td><?=$r['teacher_specialty']?></td>
                                    <!-- <td><?php // echo $r['teacher_music'] ?></td> -->

                                    <td>
                                        <a href="admin_teacher_edit.php?sid=<?=$r['sid']?>"><i class="fas fa-edit"></i></a>
                                        <!-- <a href="javascript:loadData(<%=%>)"><i class="fas fa-edit"></i></a> -->
                                    </td>
                                    <td>
                                        <a class="ban" href="javascript:ban_one(<?=$r['sid']?>)" style="color: <?=$r['is_suspended'] == 1 ? 'red' : 'rgb(0, 123, 255)'?>"><i class="fas fa-ban"></i></a>
                                    </td>
                                </tr>
                                    <?php }?>
                            <!-- </form> -->
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    <script>

    function classification(){
        let gets = [];
        let finalLocation = 'admin_teacher_list.php?';
        let sortDir = $('#sortBtn').val();
        let abc = $('#select_one').find(":selected").val();
        let txt = $('#search').val();


        if(sortDir){
            // finalLocation += `asc_value=${sortDir}`;
            gets.push(`asc_value=${sortDir}`);
        }

        if(txt){
            // finalLocation += `&search=${txt}`;
            gets.push(`search=${txt}`);
        }

        if(abc){
            // finalLocation += `&select_one=${abc}`;
            gets.push(`select_one=${abc}`);
        }

        finalLocation += gets.join('&');
        location.href = finalLocation;
        // console.log(finalLocation);
        // console.log( gets.join('&') );
        // console.log(txt);
        // console.log(abc);
        // console.log(sortDir);
        
    }

    function classification2(){
        let gets = [];
        let finalLocation = 'admin_teacher_list.php?';

        let abc = $('#select_one').find(":selected").val();
        let txt = $('#search').val();


        if(txt){
            // finalLocation += `&search=${txt}`;
            gets.push(`search=${txt}`);
        }

        if(abc){
            // finalLocation += `&select_one=${abc}`;
            gets.push(`select_one=${abc}`);
        }

        finalLocation += gets.join('&');
        location.href = finalLocation;
        
        
    }
        //刪除資料提示
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

    //傳送
    // function Search() {
    //             let fd = new FormData(document.form2);
    //             fetch('admin_teacher_list.php', {
    //                     method: 'POST',
    //                     body: fd,
    //                 })
    //                 .then(response => {
    //                     return response.json();
    //                 })
    //                 .then(json => {
    //                     console.log(json);
    //                 });
    //             return false;
    //         }
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




<?php require 'admin__footer.php';?>
