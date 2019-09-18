<?php
require '__admin_required.php';
require 'init.php';
$page_name = '新增場地資訊';;
$page_title = '新增資料';

$people = [
    '0-5人' => '0-5人',
    '6-10人' => '6-10人',
    '10人以上' => '10人以上',
];


$time = [
    '9-12' => '9點到12點',
    '13-17' => '13點到17點',
    '18-21' => '18點到21點',
];

$fruit_c = empty($_POST['fruitc']) ? 0 : intval($_POST['fruitc']);
$fruit_a = empty($_POST['fruita']) ? [] : $_POST['fruita'];

// echo '<pre>',print_r($_SESSION),'</pre>';



?>
<?php include __DIR__ . '/__header.php' ?>

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

    .mainContent-css{
        background-color: #F9F9F9;
    }

    .card-css{
        border: none;
        border-radius: 8px;
        box-shadow: 3px 8px 8px #ccc;
    }

</style>

<body>

<?php include __DIR__ . '/__hall__nav_bar.php' ?>





<style>
    small.form-text {
        color: red;
    }


    .custom-date-style {
	background-color: red !important;
}



</style>

<div class="wrapper d-flex">
    <?php include '__hall__left_menu.php' ?>
    <div class="mainContent mainContent-css">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10 p-0 m-5 ">
                    <div class="container mt-4">
                    <div class="alert alert-primary" role="alert" id="info-bar" style="display: none;width: 50rem;"></div>
                        <div class="card card-css" style="width: 50rem;">
                            <div class="card-body">
                            <h2 class="card-title" style="text-align:center;">新增場地</h2>
                                <!-- <div class="d-flex"></div> -->
                               <form name="form1" onsubmit="return checkForm()">
                                    <div class="form-group">
                                        <label for="email">電子信箱</label>
                                        <input type="" disabled="disabled" class="form-control" id="email" name="email" value="<?= $_SESSION['loginUser']['email'] ?>">
                                        <small id="email-nameHelp" class="form-text"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-name">場地名稱</label>
                                        <input type="text" class="form-control" id="location-name" name="location-name">
                                        <small id="location-nameHelp" class="form-text"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-address">場地地址</label>
                                        <input type="text" class="form-control" id="location-address" name="location-address">
                                        <small id="location-addressHelp" class="form-text"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-phone">場地電話</label>
                                        <input type="text" class="form-control" id="location-phone" name="location-phone">
                                        <small id="location-phoneHelp" class="form-text"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-information">場地資訊</label>
                                        <input type="text" class="form-control" id="location-information" name="location-information">
                                        <small id="location-informationHelp" class="form-text"></small>
                                    </div>
                                    <!--<div class="form-group">
                                        <label for="location-people">可納人數</label>
                                        <input type="text" class="form-control" id="location-people" name="location-people">
                                        <small id="location-peopleHelp" class="form-text"></small>
                                    </div> -->

                                    <div class="form-group">
                                        <label for="location-people">可納人數</label>
                                        <select class="form-control" id="location-people" name="location-people">
                                        <!-- <option value="">--請選擇--</option>  -->
                                            <?php foreach ($people as $k => $v) : ?>
                                            <option value="<?= $k ?>" <?= $fruit_c == $k ? 'selected' : '' ?>><?= $v ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="location-price">場地價錢</label>
                                        <input type="text" class="form-control" id="location-price" name="location-price">
                                        <small id="location-priceHelp" class="form-text"></small>
                                    </div>    

                                    <div class="form-group">
                                        <label for="my_file" display="none">圖片</label>
                                        <img src="" alt="" style="width:70%;">
                                        <input type="file" class="form-control-file" id="my_file" name="my_file"  onchange="previewFile()">
                                        <small id="location-informationHelp" class="form-text"></small>
                                    </div>
            


                                    <!-- <div class="form-group">
                                        <label for="location-price">開始日期</label>
                                        <input type="text" class="form-control " id="date_timepicker_start" name="location-price">
                                        <small id="location-priceHelp" class="form-text"></small>
                                    </div> -->

                                    <!-- <div class="form-group">
                                        <label for="location-price">結束日期</label>
                                        <input type="text" class="form-control " id="date_timepicker_end" name="location-price">
                                        <small id="location-priceHelp" class="form-text"></small>
                                    </div>  -->


                                    <div class="form-group ">
                                        <label for="location-price form-check">開放時間</label> <br>
                                        <input type="checkbox" name="open-day[]" value="9點到12點" />9點到12點<br />
                                        <input type="checkbox" name="open-day[]" value="13點到17點" />13點到17點<br />
                                        <input type="checkbox" name="open-day[]" value="18點到21點" />18點到21點<br />
                                    </div> 

                                        <!-- <div class="form-group">
                                            <?php foreach($time as $k=>$v): ?>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="open-time[]"
                                                        id="fruit-a-<?= $k ?>" value="<?= $k ?>"
                                                        <?= in_array($k, $fruit_a) ? 'checked' : '' ?>
                                                            >
                                                        <label class="form-check-label" for="open-time<?= $k ?>"><?= $v ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                         </div> -->

                                    <button type="submit" class="btn btn-primary" id="submit_btn">新增</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
               let info_bar = document.querySelector('#info-bar');

                // 圖片顯示
            function previewFile() {
            var preview = document.querySelector('img');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.addEventListener("load", function () {
             preview.src = reader.result;
            }, false);

            if (file) {
             reader.readAsDataURL(file);
            }
            }




               function checkForm() {
                // TODO: 檢查必填欄位, 欄位值的格式

                let fd = new FormData(document.form1);

                fetch('location_insert_api.php', {
                method: 'POST',
                body: fd,
                 })
                .then(response => {
                return response.json();
                })
                .then(json => {
                console.log(json);
                info_bar.style.display = 'block';
                info_bar.innerHTML = json.info;
                if (json.success) {
                info_bar.className = 'alert alert-success';
                setTimeout(function() {
                    document.location.href = 'location_list.php'
                }, 1000);
                } else {
                info_bar.className = 'alert alert-danger';
                }
                 });

                return false; // 表單不出用傳統的 post 方式送出
                }
            </script>
        
        
        
        </div>
    </div>
</div>








<?php include __DIR__ . '/__footer.php' ?>