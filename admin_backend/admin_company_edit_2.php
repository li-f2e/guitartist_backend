<?php
require '__admin_required.php';

require 'init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `member_list` WHERE `sid`=$sid ";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();

?>

<?php require 'admin__header.php'?>

</head>
<body>
<?php require "admin__nav_bar.php";?>


    <div class="wrapper d-flex">
      <?php require "admin__left_menu.php";?>


      <div class="mainContent mainContent-css">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-11 mt-5 mx-auto">
            <!-- html碼打這裡 -->
            <div class="container">
              <div style="margin-top: 2rem;">
                <div class="row">
                  <div class="col">
                    <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
                  </div>
                </div>

                <!-- 麵包屑 -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-3 p-1">
                    <li class="breadcrumb-item"><a href="admin_company_list.php">代理商列表</a></li>
                    <li class="breadcrumb-item"><a href="admin_company_info.php">編輯代理商資訊</a></li>
                    <li class="breadcrumb-item active font-weight-bold" aria-current="page">編輯聯絡資訊</li>
                  </ol>
                </nav>
                <div class="card edit_card">
                  <div class="card-body">
                    <h5 class="card-title">聯絡資訊</h5>
                    <form name="form1" onsubmit="return checkForm()">
                      <input type="hidden" name="sid" value="<?=$row['sid']?>" />
                      <table class="table table-hover">
                        <tr>
                          <th class="align-middle">電子信箱</th>
                          <td>
                            <div>
                              <?=htmlentities($row['email'])?>
                              <a href="#" id="addBtn_1" style="margin-left:309px"><i class="fas fa-plus"></i></a>
                            </div>

                            <input type="<?=!empty($row['alt_email']) ? 'text' : 'hidden'?>" name="alt_email"
                              id="alt_email" class="mt-1" value="<?=htmlentities($row['alt_email'])?>" />
                            <a href="" style="<?=!empty($row['alt_email']) ? 'display:inline-block' : 'display: none'?>"
                              id="removeBtn_1"><i class="fas fa-minus"></i></a>
                            <small id="alt_emailHelp" class="form-text"></small>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <th class="align-middle">聯絡電話</th>
                          <td>
                            <div>
                              <input type="text" name="tel" id="tel" value="<?=htmlentities($row['tel'])?>" />
                              <a href="" id="addBtn_2"><i class="fas fa-plus"></i></a>
                            </div>
                            <div>
                              <input type="<?=!empty($row['alt_tel']) ? 'text' : 'hidden'?>" name="alt_tel" id="alt_tel" class="mt-1"
                                value="<?=htmlentities($row['alt_tel'])?>" />
                              <a href="" style="<?=!empty($row['alt_tel']) ? 'display:inline-block' : 'display: none'?>"
                                id="removeBtn_2"><i class="fas fa-minus"></i></a>
                            </div>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <th class="align-middle">傳真號碼</th>
                          <td>
                            <input type="text" name="fax" id="fax" value="<?=htmlentities($row['fax'])?>" />
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <th class="align-middle">聯絡地址</th>
                          <td>
                            <input type="text" name="addr" id="addr" value="<?=htmlentities($row['addr'])?>" />
                          </td>
                          <td></td>
                        </tr>
                      </table>

                      <div class="mr-auto mt-4 d-flex" style="width:130px">
                        <button type="submit" class="btn btn-dark" id="submit_btn" style="margin-right:5px">修改</button>
                        <a name="" id="" class="btn btn-light" href="admin_company_info.php" role="button">返回</a>
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
  </div>

<script>
    // email + -
    // let addBtn_1 = document.querySelector("#addBtn_1");
    // let removeBtn_1 = document.querySelector("#removeBtn_1");
    // let input_1 = document.querySelector("#alt_email");
    // addBtn_1.addEventListener("click", function (e) {
    //   e.preventDefault();
    //   input_1.setAttribute("type", "text");
    //   removeBtn_1.style.display = "inline-block";
    // });
    // removeBtn_1.addEventListener("click", function (e) {
    //   if (confirm("確定要刪除這筆資料嗎?")) {
    //     let alt_emailHelp = document.querySelector("#alt_emailHelp");
    //     e.preventDefault();
    //     input_1.setAttribute("type", "hidden");
    //     removeBtn_1.style.display = "none";
    //     input_1.value = "<?=$row['alt_email'] = ''?>";
    //     // input_1.style.display = "none";
    //     alt_emailHelp.style.display = "none";
    //   }
    // });

    //--------
    // email + -　用jQuery寫＆加動畫
    $("#addBtn_1").click(function (e) {
      e.preventDefault()
      $("#alt_email").removeClass("animated fadeOutUp").addClass("animated fadeInDown mt-1").attr("type", "text")
      $("#removeBtn_1").show()
    })

    $("#removeBtn_1").click(function (e) {
      e.preventDefault()
      confirm("確定要刪除這筆電子信箱資料嗎？")
      $("#alt_email").removeClass("animated fadeInDown").addClass("animated fadeOutUp").attr("type", "hidden").attr("value","<?=$row['alt_email'] = ''?>")
      $(this).hide()
    })

    // tel + -
    // let addBtn_2 = document.querySelector("#addBtn_2");
    // let removeBtn_2 = document.querySelector("#removeBtn_2");
    // let input_2 = document.querySelector("#alt_tel");
    // addBtn_2.addEventListener("click", function (e) {
    //   e.preventDefault();
    //   input_2.setAttribute("type", "text");
    //   removeBtn_2.style.display = "inline-block";
    // });

    // removeBtn_2.addEventListener("click", function (e) {
    //   if (confirm("確定要刪除這筆資料嗎?")) {
    //     e.preventDefault();
    //     input_2.setAttribute("type", "hidden");
    //     removeBtn_2.style.display = "none";
    //     input_2.value = "<?=$row['alt_tel'] = ''?>";
    //   }
    // });
    
    //--------
    // tel + -　用jQuery寫＆加動畫
    $("#addBtn_2").click(function (e) {
      e.preventDefault()
      $("#alt_tel").removeClass("animated fadeOutUp").addClass("animated fadeInDown mt-1").attr("type", "text")
      $("#removeBtn_2").show()
    })

    $("#removeBtn_2").click(function (e) {
      e.preventDefault()
      confirm("確定要刪除這筆電話資料嗎？")
      $("#alt_tel").removeClass("animated fadeInDown").addClass("animated fadeOutUp").attr("type", "hidden").attr("value","<?=$row['alt_tel'] = ''?>")
      $(this).hide()
    })


  //pattern
  const required_fields = [
    {
      id: "alt_email",
      pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
      info: "請填寫正確的 email 格式"
    }
  ];
  // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
  for (let s in required_fields) {
    // for in 回傳 index, which means s = index;
    item = required_fields[s]; // each object in required_fields array
    item.el = document.querySelector("#" + item.id); // 每個object增加新的屬性el, 並設定為input element
    item.infoEl = document.querySelector("#" + item.id + "Help");
  }

  let info_bar = document.querySelector("#info-bar");
  function checkForm() {
    // 先讓所有欄位外觀回復到原本的狀態
    for (s in required_fields) {
      item = required_fields[s];
      item.el.style.border = "1px solid #CCCCCC";
      item.infoEl.innerHTML = "";
    }

    // 檢查必填欄位, 欄位值的格式
    let isPass = true; // 預設表單格式無誤
    for (let s in required_fields) {
      item = required_fields[s];
      if (input_1.value == "") {
        isPass = true;
      } else if (!item.pattern.test(item.el.value)) {
        // 測試輸入得值是否符合設定格式
        item.el.style.border = "1px solid red"; // 如果不符合, input element border 改變
        item.infoEl.innerHTML = item.info; // 如不符合, 顯示訊息的small element 呈現設定的內容
        isPass = false; // 並將表單格式轉為有誤
      }
    }

    let fd = new FormData(document.form1);
    if (isPass) {
      fetch("admin_company_edit_api_2.php", {
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
              location.href = 'admin_company_info.php?sid=' + <?=$sid?>;
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
    }
    return false;
  }
</script>

<?php require "admin__footer.php";?>


