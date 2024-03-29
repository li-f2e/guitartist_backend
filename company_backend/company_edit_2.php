<?php
require '__admin_required.php';
require 'init.php';
$page_name = '修改聯絡資訊';

$sql = "SELECT * FROM member_list WHERE `email` = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();

// echo '<pre>', print_r($row['alt_email']), '</pre>';
?>

<?php require_once "__header.php";?>

<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/company_info.css">
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
                                    <div
                                    class="alert alert-primary"
                                    role="alert"
                                    id="info-bar"
                                    style="display: none"
                                    ></div>
                                </div>
                                </div>
                                <div class="container mt-4">
                                <div class="card" style="width: 50rem;">
                                    <div class="card-body">
                                    <h5 class="card-title">廠商資料</h5>
                                    <form name="form1" onsubmit="return checkForm()">
                                        <input type="hidden" name="sid" value="<?=$row['sid']?>" />
                                        <table class="table table-hover">
                                        <tr>
                                            <th class="align-middle">電子信箱</th>
                                            <td>
                                            <div>
                                                <?=htmlentities($row['email'])?>
                                                <a href="#" id="addBtn_1" style="margin-left: 250px"><i class="fas fa-plus"></i></a>
                                            </div>

                                            <input
                                                type="<?=!empty($row['alt_email']) ? 'text' : 'hidden'?>"
                                                name="alt_email"
                                                id="alt_email"
                                                value="<?=htmlentities($row['alt_email'])?>"
                                            />
                                            <a
                                                href=""
                                                style="<?=!empty($row['alt_email']) ? 'display:inline-block' : 'display: none'?>"
                                                id="removeBtn_1"
                                                ><i class="fas fa-minus"></i
                                            ></a>
                                            <small id="alt_emailHelp" class="form-text"></small>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">聯絡電話</th>
                                            <td>
                                            <div>
                                              <input
                                                  type="text"
                                                  name="tel"
                                                  id="tel"
                                                  value="<?=htmlentities($row['tel'])?>"
                                              />
                                              <a href="" id="addBtn_2"><i class="fas fa-plus"></i></a>
                                            </div>
                                            <div>
                                              <input
                                                  type="<?=!empty($row['alt_tel']) ? 'text' : 'hidden'?>"
                                                  name="alt_tel"
                                                  id="alt_tel"
                                                  value="<?=htmlentities($row['alt_tel'])?>"
                                              />
                                              <a
                                                  href=""
                                                  style="<?=!empty($row['alt_tel']) ? 'display:inline-block' : 'display: none'?>"
                                                  id="removeBtn_2"
                                                  ><i class="fas fa-minus"></i
                                              ></a>
                                            </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">傳真號碼</th>
                                            <td>
                                            <input
                                                type="text"
                                                name="fax"
                                                id="fax"
                                                value="<?=htmlentities($row['fax'])?>"
                                            />
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">聯絡地址</th>
                                            <td>
                                            <input
                                                type="text"
                                                name="addr"
                                                id="addr"
                                                value="<?=htmlentities($row['addr'])?>"
                                            />
                                            </td>
                                            <td></td>
                                        </tr>
                                        </table>

                                        <div class="ml-auto d-flex" style="width:130px">
                                            <button type="submit" class="btn btn-primary" id="submit_btn" style="margin-right:5px">修改</button>
                                            <a name="" id="" class="btn btn-primary" href="company_info.php" role="button">返回</a>
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
  let addBtn_1 = document.querySelector("#addBtn_1");
  let removeBtn_1 = document.querySelector("#removeBtn_1");
  let input_1 = document.querySelector("#alt_email");
  addBtn_1.addEventListener("click", function(e) {
    e.preventDefault();
    input_1.setAttribute("type", "text");
    removeBtn_1.style.display = "inline-block";
  });
  removeBtn_1.addEventListener("click", function(e) {
    if (confirm("確定要刪除這筆資料嗎?")) {
      let alt_emailHelp = document.querySelector("#alt_emailHelp");
      e.preventDefault();
      input_1.setAttribute("type", "hidden");
      removeBtn_1.style.display = "none";
      input_1.value = "<?=$row['alt_email'] = ''?>";
      // input_1.style.display = "none";
      alt_emailHelp.style.display = "none";
    }
  });
  // tel + -
  let addBtn_2 = document.querySelector("#addBtn_2");
  let removeBtn_2 = document.querySelector("#removeBtn_2");
  let input_2 = document.querySelector("#alt_tel");
  addBtn_2.addEventListener("click", function(e) {
    e.preventDefault();
    input_2.setAttribute("type", "text");
    removeBtn_2.style.display = "inline-block";
  });

  removeBtn_2.addEventListener("click", function(e) {
    if (confirm("確定要刪除這筆資料嗎?")) {
      e.preventDefault();
      input_2.setAttribute("type", "hidden");
      removeBtn_2.style.display = "none";
      input_2.value = "<?=$row['alt_tel'] = ''?>";
    }
  });
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
      fetch("company_edit_api_2.php", {
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
    }
    return false;
  }
</script>

<?php require_once "__footer.php";?>


