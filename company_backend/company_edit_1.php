<?php
require '__admin_required.php';
require 'init.php';
$page_name = '修改基本資料';
$sql = "SELECT * FROM member_list WHERE `email` = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();
// echo '<pre>', print_r($row),'</pre>';
?>

<?php require_once "__header.php";?>
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
<?php require_once "__nav_bar.php";?>

    <div class="wrapper d-flex">

    <?php require_once "__left_menu.php";?>

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

                                                            <!-- <div class="form-group">
                                                                <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
                                                                <button type="button" class="btn btn-danger" id="delImg">刪除圖片</button>
                                                            </div> -->
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">名稱</th>
                                                        <td><?=htmlentities($row['name'])?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">統一編號</th>
                                                        <td><?=htmlentities($row['tax_id'])?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">代理品牌</th>
                                                        <td>
                                                          <div>
                                                            <input type="text" name="brand_1" id="brand_1" value="<?=htmlentities($row['brand_1'])?>">
                                                            <a href="" id="addBtn_1"><i class="fas fa-plus"></i></a>
                                                          </div>
                                                          <div>
                                                            <input type="<?=!empty($row['brand_2']) ? 'text' : 'hidden'?>" name="brand_2" id="brand_2" value="<?=htmlentities($row['brand_2'])?>">
                                                            <a href="" style="<?=!empty($row['brand_2']) ? 'display:inline-block' : 'display: none'?>" id="removeBtn_1"><i class="fas fa-minus"></i></a>
                                                          </div>
                                                          <div>
                                                            <input type="<?=!empty($row['brand_3']) ? 'text' : 'hidden'?>" name="brand_3" id="brand_3" value="<?=htmlentities($row['brand_3'])?>">
                                                            <a href="" style="<?=!empty($row['brand_3']) ? 'display:inline-block' : 'display: none'?>" id="removeBtn_2"><i class="fas fa-minus"></i></a>
                                                          </div>
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

  let addBtn_1 = document.querySelector("#addBtn_1");
  let removeBtn_1 = document.querySelector("#removeBtn_1");
  let input_1 = document.querySelector("#brand_2");
  let input_2 = document.querySelector("#brand_3");

  addBtn_1.addEventListener("click", function(e) {
    e.preventDefault();
    input_1.setAttribute("type", "text");
    removeBtn_1.style = "block";
    if (input_1.value != "" && input_2.value == "") {
      input_2.setAttribute("type", "text");
      removeBtn_2.style = "block";
    }
  });

  removeBtn_1.addEventListener("click", function(e) {
    if (confirm("確定要刪除這筆資料嗎?")) {
      e.preventDefault();
      input_1.setAttribute("type", "hidden");
      removeBtn_1.style.display = "none";
      input_1.value = "<?=$row['brand_2'] = ''?>";
    }
  });

  removeBtn_2.addEventListener("click", function(e) {
    if (confirm("確定要刪除這筆資料嗎?")) {
      e.preventDefault();
      input_2.setAttribute("type", "hidden");
      removeBtn_2.style.display = "none";
      input_2.value = "<?=$row['brand_3'] = ''?>";
    }
  });

  let info_bar = document.querySelector("#info-bar");
  function checkForm() {
    let fd = new FormData(document.form1);
    fetch("company_edit_api_1.php", {
      method: "POST",
      body: fd
    })
      .then(response => {
        return response.json();
      })
      .then(json => {
        console.log(json);
        submit_btn.style.display = "block"; // 接受到response後, 按鈕回來
        // info_bar.style.display = "block";
        // info_bar.innerHTML = json.info;
        if (json.success) {
          // info_bar.className = "alert alert-success";
          Swal.fire({
          type: 'success',
          title: json.info,
          showConfirmButton: false,
          timer: 1500
          }) 
          setTimeout(function() {
            location.href = "company_info.php";
          }, 1000);
        } else {
          // info_bar.className = "alert alert-danger";
          Swal.fire({
          type: 'error',
          title: json.info,
          showConfirmButton: false,
          timer: 1500
          })
        }
      });
    return false;
  }
</script>

<?php require_once "__footer.php";?>


