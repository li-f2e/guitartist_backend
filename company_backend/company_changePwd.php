<!-- 可以改成自己的連結黨 -->
<?php
require '__admin_required.php';
require 'init.php';

$page_name = 'HALL Change PWD';

$sql = "SELECT * FROM member_list WHERE `email` = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();

?>

<?php require_once "__header.php";?>
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

.fa-eye-slash, .fa-eye{
  color: var(--gold);
  z-index:10;
}

.form-group{
  position: relative;
}

#submit_btn{
  border: 0;
  background-color:var(--gold);
}

.card-img{
  width:35%;
  margin-left: 30%;
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

.text-p{
  color: #dc3545;
  margin-bottom: 3px;
}

.pass-div{
  margin-top: 30px;
  margin-bottom: 3px;
}

.card-body{
  margin-left: 5%;
  padding: 5px;
}

.PAWS{
  font-size: 14px;
}

</style>


<body>
<?php require_once "__nav_bar.php";?>

    <div class="wrapper d-flex">

    <?php require_once "__left_menu.php";?>

        <div class="mainContent mainContent-css">
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-10 p-0 mt-5 ml-3">
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

                                <div class="row">
                                <div class="col-5 mx-auto">
                                    <div class="card card-css">
                                    <!-- <div class="card-header card-img">-->
                                        <!-- 預留 -->
                                    <!--</div>-->
                                    
                                    <!-- <div class="card-img"></div> -->
                                    <div class="card-body">
                                        <img class="card-img" src="uploads/ef73d.jpg" alt="">
                                        <form name="form1" onsubmit="return checkForm()">
                                        <input type="hidden" name="sid" value="<?=$row['sid']?>" />
                                        <p class="text-p">Enter the old password</p>
                                        <div class="form-group d-flex">
                                            <input
                                            type="password"
                                            class="input_css"
                                            id="old_pwd"
                                            name="old_pwd"
                                            placeholder="Enter the old password"
                                            style=""/>
                                            <a href="" id="eye_1" style="position:absolute; top:20%; right:5%"><i class="far fa-eye-slash"></i></a>
                                            <small id="passwordHelp" class="form-text"></small>
                                        </div>
                                        <div class="d-flex pass-div mb-2 align-items-center">
                                            <div class="PAWS">Password Strength</div>
                                            <div class="progress" style="width:120px; height:15px; margin-left:8px;">
                                            <div
                                                class="progress-bar bg-dark"
                                                role="progressbar"
                                                style="width: 0%"
                                                id="strength"
                                            ></div>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex">
                                            <input
                                            type="password"
                                            class="input_css pwdVisibility"
                                            id="password"
                                            name="password"
                                            placeholder="Enter the new password"
                                            />
                                            <a href="" id="eye_2" style="position:absolute; top:20%; right:5%"><i class="far fa-eye-slash"></a></i>
                                        </div>
                                        <div class="form-group">
                                            <input
                                            type="password"
                                            class="input_css pwdVisibility"
                                            id="confirm_pwd"
                                            name="confirm_pwd"
                                            placeholder="Confirm the new password"
                                            />
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="submit_btn">
                                            EDIT
                                        </button>
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
    fetch("changePwd_api.php", {
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
            location.href = "company_index.php";
          }, 1000);
        } else {
          info_bar.className = "alert alert-danger";
        }
      });
    return false;
  }
</script>

<?php require_once "__footer.php";?>


