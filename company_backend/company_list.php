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
<link rel="stylesheet" href="css/company_info.css">
<style>


</style>

</head>
<body>
<?php require_once "__nav_bar.php";?>

    <div class="wrapper d-flex">

    <?php require_once "__left_menu.php";?>




        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10 p-0 mt-5 ml-3 ">
                        <!-- html馬打這裡 -->
                        <div class="container mt-4">
                            <div class="card" style="width: 50rem;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title align-middle">廠商資料</h5>
                                        <div class="ml-auto">
                                            <a href="company_edit_1.php"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th class="align-middle">照片</th>
                                                <td class="d-flex">
                                                    <figure class="pic my-auto" style="border: 1px solid lightgray;background-image: url(uploads/<?=empty($row['pic']) ? 'profile.png' : $row['pic']?>);">
                                                        <a href="company_edit_1.php">
                                                            <!-- <img src="uploads/<?=empty($row['pic']) ? 'profile.png' : $row['pic']?>"> -->
                                                        </a>
                                                    </figure>
                                                </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">名稱</th>
                                            <td><?=htmlentities($row['name'])?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">統一編號</th>
                                            <td><?=htmlentities($row['tax_id'])?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <!-- <tr>
                                            <th class="align-middle">密碼</th>
                                            <td >
                                                <?=htmlentities($row['password'])?>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr> -->
                                        <tr>
                                            <th class="align-middle">代理品牌</th>
                                            <td>
                                                <?=htmlentities($row['brand_1'])?>
                                                <div><?=htmlentities($row['brand_2'])?></div>
                                                <div><?=htmlentities($row['brand_3'])?></div>
                                            </td>
                                            <td></td>
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
                                        <h5 class="card-title align-middle">聯絡資訊</h5>
                                        <div class="ml-auto">
                                            <a href="company_edit_2.php"><i class="fas fa-edit "></i></a>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th class="align-middle">電子郵件</th>
                                            <td class="test">
                                                <?=htmlentities($row['email'])?>
                                                <div><?=htmlentities($row['alt_email'])?></div>
                                            </td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <th class="align-middle">聯絡電話</th>
                                            <td>
                                                <?=htmlentities($row['tel'])?>
                                                <div><?=htmlentities($row['alt_tel'])?></div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">傳真號碼</th>
                                            <td><?=htmlentities($row['fax'])?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">地址</th>
                                            <td><?=htmlentities($row['addr'])?></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-4">
                            <div class="card mb-5" style="width: 50rem;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title">收款資訊</h5>
                                        <div class="ml-auto">
                                            <a href="company_edit_3.php"><i class="fas fa-edit "></i></a>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th class="align-middle">帳戶名稱</th>
                                            <td><?=htmlentities($row['bank_acc'])?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">帳戶號碼</th>
                                            <td><?=htmlentities($row['bank_num'])?></td>
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


