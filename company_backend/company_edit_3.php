
<?php
require '__admin_required.php';
require 'init.php';
$page_name = '修改收款資訊';
$sql = "SELECT * FROM member_list WHERE `email` = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();
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
                                            <th class="align-middle">銀行戶名</th>
                                            <td>
                                            <input
                                                type="text"
                                                name="bank_acc"
                                                id="bank_acc"
                                                value="<?=htmlentities($row['bank_acc'])?>"
                                            />
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">銀行帳戶</th>
                                            <td>
                                            <input
                                                type="text"
                                                name="bank_num"
                                                id="bank_num"
                                                value="<?=htmlentities($row['bank_num'])?>"
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
</div>

<script>
  let info_bar = document.querySelector("#info-bar");

  function checkForm() {
    let fd = new FormData(document.form1);
    fetch("company_edit_api_3.php", {
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
            location.href = "company_info.php";
          }, 1000);
        } else {
          info_bar.className = "alert alert-danger";
        }
      });
    return false;
  }
</script>


<?php require_once "__footer.php";?>


