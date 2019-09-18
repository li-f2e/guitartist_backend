<?php
require '__admin_required.php';
require 'init.php';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

// if(isset($_GET['sid'])){
//     echo 'yes';
// }else{
//     echo 'no';
// }

$sql = "SELECT * FROM `member_list` WHERE `sid`=$sid";
$row = $pdo->query($sql)->fetch(); // $row 取資料

// `sid`,`name`,`pic`,`email`,`tel`,`teacher_birthday`,`teacher_experience`,`teacher_perform`,`teacher_award`,`teacher_introduction`,`teacher_specialty`,`teacher_music`

// $rows = $stmt->fetchAll();

?>
<!-- 可以改成自己的連結黨 -->

<?php require "admin__header.php";?>
<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php require "admin__nav_bar.php";?>

    <div class="wrapper d-flex">

    <?php require "admin__left_menu.php";?>

        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10 p-0 mt-5 ml-3 ">
                        <!-- html馬打這裡 -->
                        <div class="container mt-4">
                            <div class="card" style="width: 50rem;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title">基本資料</h5>
                                        <div class="ml-auto">
                                            <a href="admin_teacher_edit_1.php?sid=<?=$row['sid']?>"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>照片</th>
                                            <td> <img src="uploads/<?=$row['teacher_pic']?>" class="teacher_pic" alt=""> </td>
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
                            <div class="card" style="width: 50rem;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title">聯絡資訊</h5>
                                        <div class="ml-auto">
                                            <a href="admin_teacher_edit_2.php?sid=<?=$row['sid']?>"><i class="fas fa-edit "></i></a>
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
                            <div class="card" style="width: 50rem;">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title">吉他生涯</h5>
                                        <div class="ml-auto">
                                            <a href="admin_teacher_edit_3.php?sid=<?=$row['sid']?>"><i class="fas fa-edit "></i></a>
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

<?php require "admin__footer.php";?>


