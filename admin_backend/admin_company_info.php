<?php
require '__admin_required.php';
require 'init.php';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `member_list` WHERE `sid`=$sid";
$row = $pdo->query($sql)->fetch();// $row 取資料

?>

<?php require 'admin__header.php';?>

</head>
<style>
    .table th{
        width: 20%;
    }

    .table td{
        vertical-align: middle;
        color : #6c757d;
    }

    .breadcrumb-item a{
        color: rgb(226, 24, 24);
    }
</style>
<body>
<?php require 'admin__nav_bar.php'?>

<div class="wrapper d-flex">

    <?php require "admin__left_menu.php";?>

    <div class="mainContent mainContent-css">
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-11 mt-5 mx-auto">
                        <div class="container mt-4">
                            <!-- 麵包屑 -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-3 p-1">
                                    <li class="breadcrumb-item"><a href="admin_company_list.php">代理商列表</a></li>
                                    <li class="breadcrumb-item active font-weight-bold" aria-current="page">編輯代理商資訊</li>
                                </ol>
                            </nav>
                            <div class="card edit_card">
                                <div class="card-body card-body-css">
                                    <div class="d-flex">
                                        <h5 class="card-title">基本資訊</h5>
                                        <div class="ml-auto">
                                            <a href="admin_company_edit_1.php?sid=<?= $row['sid'] ?>"><i
                                                    class="fas fa-edit"></i></a>
                                            <!-- <a href="changePwd.php">修改密碼用(暫放)</i></a> -->
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>L O G O</th>
                                            <td>

                                                <img style="object-fit:cover; width:64px; height:64px"
                                                    src="uploads/<?=empty($row['pic']) ? 'profile.png' : $row['pic']?>"
                                                    alt="">


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
                                            <th>代理品牌</th>
                                            <td>
                                                <?=$row['brand_1']?>
                                                <div><?=$row['brand_2']?></div>
                                                <div><?=$row['brand_3']?></div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="container mt-4">
                            <div class="card edit_card">
                                <div class="card-body card-body-css">
                                    <div class="d-flex">
                                        <h5 class="card-title">聯絡資訊</h5>
                                        <div class="ml-auto">
                                            <a href="admin_company_edit_2.php?sid=<?= $row['sid'] ?>"><i
                                                    class="fas fa-edit "></i></a>
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
                        <div class="container mt-4">
                            <div class="card edit_card">
                                <div class="card-body card-body-css">
                                    <div class="d-flex">
                                        <h5 class="card-title">收款資訊</h5>
                                        <div class="ml-auto">
                                            <a href="admin_company_edit_3.php?sid=<?= $row['sid'] ?>"><i
                                                    class="fas fa-edit "></i></a>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>帳戶名稱</th>
                                            <td><?=$row['bank_acc']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>帳戶號碼</th>
                                            <td><?=$row['bank_num']?></td>
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