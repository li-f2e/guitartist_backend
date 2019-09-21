<!-- 可以改成自己的連結黨 -->
<?php
require '__admin_required.php';
require 'init.php';

$page_name = 'admin-changePwd';

$sql = "SELECT * FROM member_list WHERE `email` = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();

?>

<?php require_once "admin__header.php";?>
<link rel="stylesheet" href="css/index.css">
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
  /* background: linear-gradient(80deg, rgba(66, 183, 245,0.8) 0%,rgba(66, 245, 189,0.4) 100%); */
}

.mainContent-css{
  /* background-color: #92bfd1; */
  background-color: #eee;
}

.card-css{
  border: none;
  border-radius: 8px;
  height: 530px;
  width: 410px;
  padding: 5px 5px;
  background-size: cover;
  box-shadow: 3px 5px 3px #bbb;
  padding: 15%;
}

.fa-eye-slash{
  color: gray;
  z-index:10;
}
.fa-eye{
  color:black;
}


#submit_btn{
  border: 0;
  background-color:var(--red);
  margin-top: 10px;
  color:#fff
}

.card-img{
  width:90%;
  margin:auto;
  margin-bottom:7%;
}

.input_css{
  outline: none;
  border: 0;
  background-color: #ccc;
  box-shadow: none;
  border-radius: 3px;
  line-height: 12px;
	padding: 8px 10px;
  width: 100%;
  color: black;
  opacity: 0.4;
  /* position: relative; */
}
.form-group{
  margin:5px;
  padding:5px;
}
.text-p{
  color: #555555;
  margin-bottom: 5px;
  margin-top:10px;
}

.pass-div{
  margin-top: 15px;
  margin-bottom: 3px;
}

.card-body{
  margin-left: 5%;
  padding: 5px;
}

.PAWS{
  font-size: 14px;
  color:#555555;
}

</style>


<body>
<?php require_once "admin__nav_bar.php";?>

    <div class="wrapper d-flex">

    <?php require_once "admin__left_menu.php";?>

        <div class="mainContent mainContent-css">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10 p-0 mt-5 ml-3">
                        <!-- html馬打這裡 -->
                        <div class="container">
                            <div style="margin-top: 0.5rem;">
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

                                <div class="row">
                                <div class="col-5 mx-auto">
                                    <div class="card card-css">
                                    <!-- <div class="card-header card-img">-->
                                        <!-- 預留 -->
                                    <!--</div>-->
                                    
                                    <!-- <div class="card-img"></div> -->
                                    <div class="card-body">
                                        <img class="card-img" src="images/logo.svg" alt="">
                                        <form name="form1" onsubmit="return checkForm()" style="margin-top:15px">
                                        <input type="hidden" name="sid" value="<?=$row['sid']?>" />
                                        <p class="text-p">請輸入舊密碼</p>
                                        <div class=" position-relative d-flex" >
                                            <input
                                            type="password"
                                            class="input_css"
                                            id="old_pwd"
                                            name="old_pwd"
                                            />
                                            <a href="" id="eye_1" style="position:absolute; top:20%; right:5%"><i class="far fa-eye-slash"></i></a>
                                            <small id="passwordHelp" class="form-text"></small>
                                        </div>
                                        <div class="d-flex pass-div mb-2 align-items-center">
                                            <div class="PAWS">密碼強度</div>
                                            <div class="progress" style="width:120px; height:15px; margin-left:8px;">
                                            <div
                                                class="progress-bar bg-dark"
                                                role="progressbar"
                                                style="width: 0%"
                                                id="strength"
                                            ></div>
                                            </div>
                                        </div>
                                        <p class="text-p">請輸入新密碼</p>
                                        <div class="d-flex position-relative" >
                                            <input
                                            type="password"
                                            class="input_css pwdVisibility"
                                            id="password"
                                            name="password"
                                            
                                            />
                                            <a href="" id="eye_2" style="position:absolute; top:20%; right:5%"><i class="far fa-eye-slash"></a></i>
                                        </div>
                                        <p class="text-p">確認密碼</p>
                                        <div class="" style="margin-left:0; padding:0">
                                            <input
                                            type="password"
                                            class="input_css pwdVisibility"
                                            id="confirm_pwd"
                                            name="confirm_pwd"
                                            
                                            />
                                        </div>
                                        <div class="row" style="margin-top:15px">
                                          <div class="col-12" style="text-align:right">
                                            <button type="submit" class="btn" id="submit_btn">
                                              修改
                                            </button>
                                            <button type="submit" class="btn btn-outline-dark" style="margin-top:10px">
                                                取消
                                            </button>
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
        </div>
    </div>
<script src="js/pwdChecker.js"></script>
<script src="js/pwdHidden_changePwd.js"></script>
<script>

  let info_bar = document.querySelector("#info-bar");
  function checkForm() {
    let fd = new FormData(document.form1);
    fetch("admin_changePwd_api.php", {
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
            location.href = "admin_company_list.php";
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

<?php require_once "admin__footer.php";?>


