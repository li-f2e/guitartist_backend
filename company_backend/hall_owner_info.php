<?php
require '__admin_required.php';
require 'init.php';
$sql = "SELECT * FROM member_list WHERE email = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();

// echo '<pre>',print_r($_SESSION),'</pre>';
// echo '<pre>',print_r($row),'</pre>';

?>

<?php require '__header.php' ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

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

    .table th{
    width: 20%;
    }

    .table td{
    vertical-align: middle;
    color : #6c757d;
    }

    .mainContent-css{
        background-color: #F9F9F9;
    }

    .card-css{
        width: 50rem;
        border: none;
        border-radius: 8px;
        box-shadow: 3px 8px 8px #ccc;
    }



</style>

<body>
<?php require '__nav_bar.php' ?>


<div class="wrapper d-flex">
    <?php require '__hall__left_menu.php' ?>
    <div class="mainContent mainContent-css">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10 p-0 m-5 ">
                <div class="container mt-4">
                    <div class="card animated fadeInDown card-css">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-title">廠商基本資料</h5>
                                <div class="ml-auto">
                                    <a href="hall_edit.php"><i class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <table class="table table-hover">
                                <tr>
                                    <th>廠商名稱</th>
                                    <td><?= $row['name'] ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>統一編號</th>
                                    <td><?= $row['tax_id'] ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>L O G O</th>
                                    <td>
                                        <img src="uploads/<?= $row['pic'] ?>" alt="" style="width:50%;">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>詳細地址</th>
                                    <td><?= $row['addr'] ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>官方網站</th>
                                    <td><a href="<?= $row['hall_web'] ?>"><?= $row['hall_web'] ?></a></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>聯絡電話</th>
                                <td>
                                    <?= $row['tel'] ?>
                                    <div><?= $row['alt_tel'] ?></div>
                                </td>
                                <td></td>
                                </tr>
                                <tr>
                                    <th>電子郵件</th>
                                    <td class="test">
                                    <?= $row['email'] ?>
                                    <div><?= $row['alt_email'] ?></div>
                                    <td></td>
                                </td>
                                </tr>
                                <tr>
                                    <th>銀行戶名</th>
                                    <td><?= $row['bank_acc'] ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>帳戶號碼</th>
                                    <td class="test"><?= $row['bank_num'] ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>場地介紹</th>
                                    <td><?= $row['hall_introduce'] ?></td>
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

</div>

<script>

$(window).on('load',function(){
    $('#myModal').modal('show');
});

</script>

<?php require '__footer.php' ?>

