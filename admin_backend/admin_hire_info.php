<?php
require '__admin_required.php';
require 'init.php';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `member_list` WHERE `sid`=$sid";
$row = $pdo->query($sql)->fetch();// $row 取資料

?>

<?php require 'admin__header.php';?>

<link rel="stylesheet" href="css/company_info.css">
</head>
<body>
<?php require 'admin__nav_bar.php'?>

<div class="wrapper d-flex">

    <?php require "admin__left_menu.php";?>

        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10 p-0 mt-5 ml-3 ">

                        <div class="container mt-4">
                            <div class="card" style="width: 50rem;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title">廠商資料</h5>
                                        <div class="ml-auto">
                                            <a href="admin_hire_edit_1.php?sid=<?= $row['sid'] ?>"><i class="fas fa-edit"></i></a>
                                            <!-- <a href="changePwd.php">修改密碼用(暫放)</i></a> -->
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>照片</th>
                                            <td>
                                                <img style= "object-fit:cover; width:64px; height:64px"src="uploads/<?=empty($row['pic']) ? 'profile.png' : $row['pic']?>" alt="">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>名稱</th>
                                            <td><?=$row['name']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>統一編號</th>
                                            <td><?=$row['tax_id']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>密碼</th>
                                            <td>
                                                <?=$row['password']?>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>資本額</th>
                                            <td><?=$row['capital']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>員工人數</th>
                                            <td><?=$row['ppl_num']?></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="container mt-4">
                            <div class="card" style="width: 50rem;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title">聯絡資訊</h5>
                                        <div class="ml-auto">
                                            <a href="admin_hire_edit_2.php?sid=<?= $row['sid'] ?>"><i class="fas fa-edit "></i></a>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>電子郵件</th>
                                            <td class="test">
                                                <?=$row['email']?>
                                                <div><?=$row['alt_email']?></div>
                                            </td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <th>聯絡電話</th>
                                            <td>
                                                <?=$row['tel']?>
                                                <div><?=$row['alt_tel']?></div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>傳真號碼</th>
                                            <td><?=$row['fax']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>地址</th>
                                            <td><?=$row['addr']?></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
</div>

<?php require 'admin__footer.php';?>