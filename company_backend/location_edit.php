<?php
require '__admin_required.php';
require 'init.php';
$page_title = '編輯資料';

$page_name = '編輯場地資訊';

$location_sid = isset($_GET['location_sid']) ? intval($_GET['location_sid']) : 0;
if (empty($location_sid)) {
    header('Location: location_list.php');
    exit;
}

$sql = "SELECT * FROM `location` WHERE `location_sid`=$location_sid";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: location_list.php');
    exit;
}

$people = [
    '0-5人' => '0-5人',
    '6-10人' => '6-10人',
    '10人以上' => '10人以上',
];


$people_a = empty($row['location-people']) ? 0 : intval($row['location-people']);




?>
<?php include __DIR__ . '/__header.php' ?>
<?php include __DIR__ . '/__hall__nav_bar.php' ?>
<style>
    small.form-text {
        color: red;
    }

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

    .table td{
        vertical-align: middle;
        color : #6c757d;
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
                            <h2 class="card-title" style="text-align:center;">修改場地資訊</h2>
                                <div class="d-flex">
                                    <!-- <div class="alert alert-primary" role="alert" id="info-bar" style="display: none;width: 50rem;"></div>    -->
                               </div>
                               <form name="form1" onsubmit="return checkForm()">
                                        <input type="hidden" name="location_sid" value="<?= $row['location_sid'] ?>">
                                    <div class="form-group">
                                        <label for="location-name">場地名稱</label>
                                        <input type="text" class="form-control" id="location-name" name="location-name" value="<?= htmlentities($row['location-name']) ?>">
                                        <small id="location-nameHelp" class="form-text"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-address">場地地址</label>
                                        <input type="text" class="form-control" id="location-address" name="location-address" value="<?= htmlentities($row['location-address']) ?>">
                                        <small id="location-addressHelp" class="form-text"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-phone">場地電話</label>
                                        <input type="text" class="form-control" id="location-phone" name="location-phone" value="<?= htmlentities($row['location-phone']) ?>">
                                        <small id="location-phoneHelp" class="form-text"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="location-information">場地資訊</label>
                                        <input type="text" class="form-control" id="location-information" name="location-information" value="<?= htmlentities($row['location-information']) ?>">
                                        <small id="location-informationHelp" class="form-text"></small>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="location-people">可納人數</label>
                                        <input type="text" class="form-control" id="location-people" name="location-people" value="<?= htmlentities($row['location-people']) ?>">
                                        <small id="location-peopleHelp" class="form-text"></small>
                                    </div> -->

                                    <div class="form-group">
                                    <label for="location-people">可納人數</label>
                                    <select class="form-control" id="location-people" name="location-people" value="<?= htmlentities($row['location-people']) ?>">
                                    <!--    <option value="">--請選擇--</option>  -->
                                        <?php foreach ($people as $k => $v) : ?>
                                        <option value="<?= $k ?>" <?= $people_a == $k ? 'selected' : '' ?>><?= $v ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                            

                                    <div class="form-group">
                                        <label for="location-price">場地價錢</label>
                                        <input type="text" class="form-control" id="location-price" name="location-price" value="<?= htmlentities($row['location-price']) ?>">
                                        <small id="location-priceHelp" class="form-text"></small>
                                    </div>


                                    <div class="form-group">                                                                                                
                                        <label for="open-day">開放時間</label><br>                     
                                        <input type="checkbox" name="open-day[]" value="9點-12點"   <?= strpos($row['open-day'],"9點-12點")>0? 'checked': ''?>/>9點-12點<br />
                                        <input type="checkbox" name="open-day[]" value="13點-17點"   <?= strpos($row['open-day'],"13點-17點")>0? 'checked': ''?>/>13點-17點<br />
                                        <input type="checkbox" name="open-day[]" value="18點-21點"   <?= strpos($row['open-day'],"18點-21點")>0? 'checked': ''?>/>18點-21點<br />
                                        <small id="location-priceHelp" class="form-text"></small>
                                    </div>




                                    <div class="form-group">
                                        <label for="my_file" display="none">圖片</label><br>
                                        <img class="pic" src="uploads/<?=$row['pic']?>" alt="" style="width:70%;">
                                        <input type="file" class="form-control-file" id="my_file" name="my_file"  onchange="previewFile()">
                                        <small id="location-informationHelp" class="form-text"></small>
                                    </div>    

                                    


                                    <button type="submit" class="btn btn-primary justify-content-end" id="submit_btn">修改</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
        let info_bar = document.querySelector('#info-bar');
        const submit_btn = document.querySelector('#submit_btn');

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

            fetch('location_edit_api.php', {
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