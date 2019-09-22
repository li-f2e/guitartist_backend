<?php
require '__admin_required.php';

require 'init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `member_list` WHERE `sid`=$sid ";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
?>

<?php require 'admin__header.php';?>

<link rel="stylesheet" href="css/index.css">

</head>
<style>
  .breadcrumb-item a{
        color: rgb(226, 24, 24);
    }
</style>
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
                    <li class="breadcrumb-item active font-weight-bold" aria-current="page">編輯收款資訊</li>
                  </ol>
                </nav>
                <div class="card edit_card">
                  <div class="card-body card-body-css">
                    <h5 class="card-title">收款資訊</h5>
                    <form name="form1" onsubmit="return checkForm()">
                      <input type="hidden" name="sid" value="<?=$row['sid']?>" />
                      <table class="table table-hover">
                        <tr>
                          <th class="align-middle">銀行戶名</th>
                          <td>
                            <input type="text" name="bank_acc" id="bank_acc"
                              value="<?=htmlentities($row['bank_acc'])?>" />
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <th class="align-middle">銀行帳戶</th>
                          <td>
                            <input type="text" name="bank_num" id="bank_num"
                              value="<?=htmlentities($row['bank_num'])?>" />
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
  let info_bar = document.querySelector("#info-bar");

  function checkForm() {
    let fd = new FormData(document.form1);
    fetch("admin_company_edit_api_3.php", {
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
    return false;
  }
</script>



<?php require "admin__footer.php";?>


