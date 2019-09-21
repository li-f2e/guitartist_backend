<?php 
require 'init.php';
// echo '<pre>',print_r($_SESSION['loginUser']),'<pre>';
 $num = $_SESSION['loginUser']['is_admin'] * 9 +
            $_SESSION['loginUser']['is_company'] * 7 +
            $_SESSION['loginUser']['is_teacher'] * 5 +
            $_SESSION['loginUser']['is_hall_owner'] * 3 +
            $_SESSION['loginUser']['is_hire'];

    switch($num){
        case 1:
            $result['href'] = '#';
            break;
        case 3:
            $result['href'] = 'hall_owner_index.php';
            break;
        case 5:
            $result['href'] = 'teacher_index.php';
            break;
        case 7:
            $result['href'] = 'company_index.php';
            break;
        case 9:
            $result['href'] = 'admin_company_list.php';
            break;
        default:
            $result['href'] = 'selection.php';
            break;
    }
    $href = json_encode($result, JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loading...</title>
</head>

<style>
    /* *{
        outline: 1px solid red;
    } */
    :root {
        --base: #ccc;
        --main: rgb(226, 24, 24, 1);
    }

    body{
        height: 100vh;
        background-color: var(--base);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction:column;
        margin: 0;
        padding: 0;

        /* 筆電另外裝的字體 */
        font-family: 'Helvetica';
    }

    /* 像是LOGO的圓形聲波圖 */
    .loading{
        height: 120px;
        width: 120px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        /* 如果要外框圓形的話 */
        border-radius: 50%;
        overflow: hidden;
        position: absolute;
    }

    .line{
        width: 10px;
        /* width: 20px; */
        height: 50px;
        border-radius: 50%;
        background-color: var(--base);
        margin: 4px;
        /* animation: loading 1.4s ease infinite; */
    }

    .ani-load{
        animation: loading 1.5s linear infinite;
        animation-timing-function: steps(6);
        
    }

    @keyframes loading{
        0%{
            height: 15px;
            transform: scaleY(0.6);
        }
        50%{
            /* 如果要外框圓形的話 */
            height: 80px;
            /* height: 50px; */
            border-radius: 0%;
            transform: scaleY(2);
            background-color: var(--main);;
        }

        100%{
            height: 15px;
            transform: scaleY(0.6);
        }
    }

    /* .title{
        letter-spacing: 5px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 40px;
        color: transparent;
        justify-content: center;
        align-items: center;
    }  */


    /* 原本是 .title:::before*/
    .title{
        /* content: 'Guitartist'; */
        /* top: 0; */
        /* left: 0; */
        /* width: 30%; */
        /* height: 30%; */
        /* background-color: #fff; */
        letter-spacing: 3px;
        border-right: 1px solid var(--base);
        font-size: 40px;
        font-weight: bold;
        position: relative;
        color: var(--main);;
        overflow: hidden;
        animation: type 1.5s steps(11);
        animation-fill-mode: forwards;
        white-space: nowrap;
        justify-content: center;
        align-items: center;
        top: 15%;
        text-align: center;
    }

    @keyframes type{
    0%{
        width: 0;
    }
    100%{
        width: 15%;
        border-right: 0px;
    }
}
</style>
<body>
    <div class="loading">
        <div class="line line_1"></div>
        <div class="line line_2"></div>
        <div class="line line_3"></div>
        <div class="line line_4"></div>
        <div class="line line_5"></div>
        <div class="line line_6"></div>
    </div>
    <div class="title">Guitartist</div>
    


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
 $(".line_1").addClass("ani-load")
 $(".line_2").addClass("ani-load").css("animation-delay","0.1s")
 $(".line_3").addClass("ani-load").css("animation-delay","0.2s")
 $(".line_4").addClass("ani-load").css("animation-delay","0.3s")
 $(".line_5").addClass("ani-load").css("animation-delay","0.4s")
 $(".line_6").addClass("ani-load").css("animation-delay","0.5s")
 
 $(".title").delay(1700).fadeOut();

 
// N秒之後跳轉頁面
// function delay_run(){
//     $(window).attr("location",<?php $result['href'] ?>)
//  }


 setTimeout(function() {
        location.href = <?= $href ?>.href; 
 }, 1500);

// $(function(){
//     setTimeout("delay_run()",1700)
// })

</script>
</body>
</html>