<?php
require '__admin_required.php';
require 'init.php';
$page_name = '基本資料';
$sql = "SELECT * FROM member_list WHERE `email` = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();
// echo "<pre>", print_r($_SESSION), '</pre>'
?>

<?php require_once "__header.php";?>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/edit.css">


<style>
.table th{
    width: 20%;
}

.table td{
    vertical-align: middle;
    color : #6c757d;
}
</style>

</head>
<body>
<?php require_once "__nav_bar.php";?>

    <div class="wrapper d-flex">

    <?php require_once "__left_menu.php";?>

    <div class="mainContent mainContent-css">
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-11 mt-5 mx-auto">
                        <div class="container mt-4">
                            <div class="card edit_card">
                                <div class="card-body card-body-css">
                                    <div class="d-flex">
                                        <h5 class="card-title">基本資訊</h5>
                                        <div class="ml-auto">
                                            <a href="company_edit_1.php?sid=<?= $row['sid'] ?>"><i
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
                                            <a href="company_edit_2.php?sid=<?= $row['sid'] ?>"><i
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
                                            <a href="company_edit_3.php?sid=<?= $row['sid'] ?>"><i
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

<!-- <script src="js/logout_box.js"></script> -->

<?php require_once "__footer.php";?>


