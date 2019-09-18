<?php
require '__admin_required.php';
require 'init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `member_list` WHERE `sid`=$sid ";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();

?>

<?php require 'admin__header.php';?>
<!-- <link rel="stylesheet" href="css/index.css"> -->
<link rel="stylesheet" href="css/company_info.css">

<style>
.avatar {
  /* margin-left: auto; */
  padding: 0;
  width: 128px;
  height: 128px;
  overflow: hidden;
  border-radius: 50%;
  background-size: cover;
  background-position: center center;
}
.avatar img {
  width: 100%;
}
#semi-circle {
  width: 128px;
  height: 128px;
  line-height: 128px;
  text-align: center;
  margin: 100px;
  background-color: var(--text);
  border-radius: 0 0 100px 100px;
  height: 64px;
  position: absolute;
  z-index: 1000;
  left: -100px;
  bottom: -100px;
  opacity: 0.3;
  display:none;
  pointer-events:none;
  }
</style>
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
                        <div class="container">
                            <div style="margin-top: 2rem;">
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
                                    </div>
                                </div>
                                <div class="container mt-4">
                                    <div class="card" style="width: 50rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">廠商資料</h5>
                                            <form name="form1" onsubmit="return checkForm()">
                                                <input type="hidden" name="sid" value="<?=$row['sid']?>">
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th class="align-middle">照片</th>
                                                        <td>
                                                            <a href="#" onclick="selUpload()">
                                                              <figure id="profile_img" class="avatar" style="position: relative;">
                                                                  <img style= "object-fit:cover; width:128px; height:128px"src="uploads/<?=empty($row['pic']) ? 'profile.png' : $row['pic']?>" alt="">
                                                                  <div id="semi-circle"></div>
                                                                  <i class="fas fa-camera" id="update_img" style="position: absolute; top:80px; left:55px; color:white;display:none"></i>
                                                              </figure>
                                                            </a>
                                                            <div class="form-group">
                                                                <input type="file" class="form-control-file" id="my_file" name="my_file" style="display:none" onchange="previewFile()">
                                                            </div>

                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">名稱</th>
                                                        <td><?=htmlentities($row['name'])?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                    <tr>
                                                        <th class="align-middle">統一編號</th>
                                                        <td><?=htmlentities($row['tax_id'])?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">密碼</th>
                                                        <td>
                                                          <input type="password" name="password" id="password" value="<?=htmlentities($row['password'])?>">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">資本額</th>
                                                        <td>
                                                          <input type="text" name="capital" id="capital" value="<?=htmlentities($row['capital'])?>">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">員工人數</th>
                                                        <td>
                                                          <input type="text" name="ppl_num" id="ppl_num" value="<?=htmlentities($row['ppl_num'])?>">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                  </table>
                                                    <div class="ml-auto d-flex" style="width:130px">
                                                        <button type="submit" class="btn btn-primary" id="submit_btn" style="margin-right:5px">修改</button>
                                                        <a name="" id="" class="btn btn-primary" href="company_info.php" role="button">返回</a>
                                                    </div>
                                            </div>
                                        </form>
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

  let profile_img = document.querySelector('#profile_img');
  let semi_circle = document.querySelector('#semi-circle');
  let update_img = document.querySelector('#update_img');

  profile_img.addEventListener('mouseover', function(e){
    semi_circle.style.display = 'block';
    update_img.style.display = 'block';
  })

  profile_img.addEventListener('mouseout', function(e){
    semi_circle.style.display = 'none';
    update_img.style.display = 'none';
  })


  function selUpload(){
      document.querySelector('#my_file').click();
  }
  // 圖片顯示

  function previewFile() {
    var preview = document.querySelector("img");
    console.log(preview);
    var file = document.querySelector("input[type=file]").files[0];
    var reader = new FileReader();
    reader.addEventListener(
      "load",
      function() {
        preview.src = reader.result;
      },
      false
    );

    if (file) {
      reader.readAsDataURL(file);
    }
  }

  let info_bar = document.querySelector("#info-bar");
  function checkForm() {
    let fd = new FormData(document.form1);
    fetch("admin_hire_edit_api_1.php", {
      method: "POST",
      body: fd
    })
      .then(response => {
        return response.json();
      })
      .then(json => {
        console.log(json);
        submit_btn.style.display = "block"; // 接受到response後, 按鈕回來
        info_bar.style.display = "block";
        info_bar.innerHTML = json.info;
        if (json.success) {
          info_bar.className = "alert alert-success";
          setTimeout(function() {
            location.href = 'admin_hire_info.php?sid=' + <?=$sid?>;
          }, 1000);
        } else {
          info_bar.className = "alert alert-danger";
        }
      });
    return false;
  }
</script>

<?php require 'admin__footer.php'?>


