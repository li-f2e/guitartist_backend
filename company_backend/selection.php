<?php
require '__admin_required.php';
require 'init.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <title>GuitArtist management system</title>
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
    <link rel="stylesheet" href="backside_input.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">

</head>

<style>

body{
    font-weight: bolder;
    background-image: url(https://images.unsplash.com/photo-1445375011782-2384686778a0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
}


/* 登入打招呼文字 */
.input_introduction{
    margin-top: 3em;
    margin-bottom: 5em;
}

.identity_introduction{
    font-size: 1.5em;
    margin-top:20px;
}

.identity_choose{
    margin-top: 10px;
    color: #b1803F;
    
}

/* 身分選擇 */
.identity_icon{
    position: relative; 
}

.icon{
    /* 鐵灰色 background-color: rgb(129, 129, 129); */ 
    background-color: #c62828;
    width: 150px;
    height: 150px;
    border-radius: 50%;
}

.icon:hover i{
    text-shadow: 3px 3px 5px black;
}

.icon i{
    color: #fff;
    font-size: 5em;
}

.icon p{
    position: absolute;
    top:180px;
    color:#555555;
}

.icon:hover p{
    color:#c62828;
}

/* .page1{
    top:0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #ccc;
    animation-name: cover;
    animation-duration: 4s;
    animation-fill-mode: forwards;
} */
/* 
@keyframes cover{
    from{
        left:0;
    }
    to{
        left:-190%;
        opacity: 0;
        display: none;
    }
} */

</style>


  <body>
        
    

    
    <div class="container d-flex flex-column justify-content-center" >
        <!-- 登入打招呼文字 -->
            <div class="position-relative" style="top:110px">
                <div class="card position-absolute" style="height:500px; margin-top:100px; background-color:white; width:100%; opacity:0.7; "></div> 
                <!-- 身分選擇 -->
                <div class="card-body" style=" margin-top:100px">
                    <div class="input_introduction d-flex flex-column align-items-center ">
                        <h3 class="animated fadeInDown" style="color:#555555">請選擇您的身份</h3>
                        <!-- <p class="identity_choose animated fadeInDown " style="color:#555555">Please choose your identity</p> -->
                    </div>

                    <div class="identity_icon">
                        <ul class="d-flex justify-content-around list-unstyled">
                            <li style="display: <?= $_SESSION['loginUser']['is_company'] == 1 ? 'block' : 'none' ?>">
                                <a href="company_index.php" class="text-decoration-none">
                                <div class="animated flipInY icon d-flex justify-content-center align-items-center">
                                <i class="fas fa-guitar"></i>
                                <p>代理商</p>
                                </div>
                                </a>
                            </li>
                            <li style="display: <?= $_SESSION['loginUser']['is_teacher'] == 1 ? 'block' : 'none' ?>">
                                <a href="teacher_index.php" class="text-decoration-none">
                                <div class="animated flipInY icon d-flex justify-content-center align-items-center">
                                <i class="fas fa-book-reader"></i>
                                <p>老師</p>
                                </div>

                                </a>
                            </li>
                            <li style="display: <?= $_SESSION['loginUser']['is_hall_owner'] == 1 ? 'block' : 'none' ?>" >
                                <a href="hall_index.php" class="text-decoration-none">
                                <div class="animated flipInY icon d-flex justify-content-center align-items-center">
                                <i class="fas fa-map-marked-alt"></i>
                                <p>場地租借</p>
                                </div>
                                </a>
                            </li>
                            <li style="display: <?= $_SESSION['loginUser']['is_hire'] == 1 ? 'block' : 'none' ?>" >
                                <a href="#" class="text-decoration-none">
                                <div class="animated flipInY icon d-flex justify-content-center align-items-center">
                                <i class="fas fa-user"></i>
                                <p>徵才廠商</p>
                                </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        
    </div>
    <!-- <div class="page1" style="position: absolute;"></div> -->
  </body>
</html>
