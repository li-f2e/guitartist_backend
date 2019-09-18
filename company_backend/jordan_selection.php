<?php
    require '__admin_required.php';
    require 'init.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <title>選擇您的身份</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!--fontawesome-->

    <link rel="stylesheet" href="01_fontawesome-free-5.9.0-web\css\all.css">

    <!--backside_input_style-->
    <link rel="stylesheet" href="css/selection.css">



</head>
  <body>
      <div class="container d-flex flex-column justify-content-center ">
        <!-- 登入打招呼文字 -->

        <div class="input_introduction d-flex flex-column align-items-center ">
        <h2>歡迎使用guimall管理中心</h2>
        <p class="identity_introduction"> 替您量身打造的大型吉他平台，讓您輕鬆管理商品、課程、場地等各種資訊!</p>
        <p class="identity_choose">請選擇您想編輯的內容</p>
        </div>

        <!-- 身分選擇 -->
        <div class="identity_icon">
        <ul class="d-flex justify-content-around list-unstyled">
            <li style="display: <?=$_SESSION['loginUser']['is_company'] == 1 ? 'block' : 'none'?>">
                <a href="company_info.php" class="text-decoration-none">
                <div class="icon icon d-flex justify-content-center align-items-center">
                <i class="fas fa-guitar "></i>
                <p>吉他廠商</p>
                </div>
                <!-- <div class="identity d-flex justify-content-center">
                    吉他廠商
                </div> -->
                </a>
            </li>
            <li style="display: <?=$_SESSION['loginUser']['is_teacher'] == 1 ? 'block' : 'none'?>">
                <a href="teacher_info" class="text-decoration-none">
                <div class="icon d-flex justify-content-center align-items-center">
                <i class="fas fa-book-reader"></i>
                <p>吉他老師</p>
                </div>

                </a>
            </li>
            <li style="display: <?=$_SESSION['loginUser']['is_hall_owner'] == 1 ? 'block' : 'none'?>" >
                <a href="hall_owner_info" class="text-decoration-none">
                <div class="icon d-flex justify-content-center align-items-center">
                <i class="fas fa-map-marked-alt"></i>
                <p>場地廠商</p>
                </div>
                </a>
            </li>
        </ul>
        </div>
    </div>



  </body>
</html>
