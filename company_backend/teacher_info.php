<?php
require_once '__admin_required.php';
require 'init.php';

$sql = "SELECT * FROM `member_list` WHERE  `email` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute( [ $_SESSION['loginUser']['email'] ]);
$row = $stmt->fetch();
//  echo '<pre>',print_r($_SESSION),'</pre>'


?>
<?php 
require '__header.php'; 
require_once __DIR__ . "/teacher__nav_bar.php";
?>

<link rel="stylesheet" href="css/edit.css">
<!-- <div class="row"> -->

<!-------左方欄位--------->
<style>
    .table th {
        width: 20%;
    }

    .table td {
        vertical-align: middle;
        color: #6c757d;
    }
</style>
<?php require_once __DIR__ . "/teacher__nav_bar.php"; ?>

    <div class="wrapper d-flex">
        
    <?php require_once __DIR__ . "/teacher__left_menu.php"; ?>
    
    <div class="mainContent mainContent-css">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-11 mt-5 mx-auto">
                        <!-- html碼打這裡 -->
                        <div class="container mt-4">

                            <div class="card edit_card">
                                <div class="card-body card-body-css">
                                    <div class="d-flex">
                                        <h5 class="card-title">基本資料</h5>
                                        <div class="ml-auto">
                                            <a href="teacher_edit_1.php?sid=<?=$row['sid']?>"><i
                                                    class="fas fa-edit"></i></a>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>照片</th>
                                            <td> <img src="uploads/<?=$row['teacher_pic']?>" class="member-logo" alt="">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>名字</th>
                                            <td><?=$row['teacher_name']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>密碼</th>
                                            <td><?=$row['password']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>生日</th>
                                            <td><?=$row['teacher_birthday']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>專長</th>
                                            <td><?=$row['teacher_specialty']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>自我介紹</th>
                                            <td><?=$row['teacher_introduction']?></td>
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
                                            <a href="teacher_edit_2.php?sid=<?=$row['sid']?>"><i
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
                                                <?=$row['teacher_tel']?>
                                                <div><?=$row['alt_tel']?></div>
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
                                        <h5 class="card-title">吉他生涯</h5>
                                        <div class="ml-auto">
                                            <a href="teacher_edit_3.php?sid=<?=$row['sid']?>"><i
                                                    class="fas fa-edit "></i></a>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>教學經歷</th>
                                            <td><?=$row['teacher_experience']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>表演經歷</th>
                                            <td><?=$row['teacher_perform']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>得獎紀錄</th>
                                            <td><?=$row['teacher_award']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>作品影音</th>
                                            <td><?=$row['teacher_music']?></td>
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

<script>
// js打這裡
</script>
                        


                    









<br>

<?php require '__footer.php'; ?>