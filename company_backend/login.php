<?php
require 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Guitartist</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="01_fontawesome-free-5.9.0-web\css\all.css">
	<link rel="stylesheet" href="01_fontawesome-free-5.9.0-web/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="images/icons/logo-sample-pic.png"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				
				<form name="form1" onsubmit="return checkForm()" class="login100-form validate-form">
					
					
						<div class ="login100-rwd" style="text-align:center; padding-bottom: 40px" >
							<img src="images/logo.svg" alt="" style="width: 200px;">
						</div>
					
					
					<span class="login100-form-title p-b-43">
						廠商登入
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "請填寫正確的email格式">
						<input class="input100" type="text" name="email" id="email">
						<span class="focus-input100"></span>
                        <span class="label-input100">電子信箱</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" style="position:relative" data-validate="密碼為必填欄位">
						<input class="input100 pwdVisibility" type="password" name="password" id="password">
						<span class="focus-input100"></span>
                        <span class="label-input100">密碼</span>
                        <a href="" id="eye" style="position:absolute; top:50%; right:5%; transform:translate(-50%, -40%)"><i class="far fa-eye-slash" style="font-size: 1rem; "></a></i>  
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								記住我
							</label>
						</div>
                        <small id="warn_text"></small>
						<div>
							<a href="#" class="txt1">
								忘記密碼?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button type="submit" id='submit_btn' class="login100-form-btn">
							登入
						</button>
					</div>
				</form>
				
				<div class="login100-more" style="background-image: url('images/bg03.jpg')">
					<div style="padding: 3% 0 0 4%" >
						<img src="images/logo.svg" alt="" style="width: 200px;">
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script src="js/login.js"></script>
	<script src="js/pwdHidden_login.js"></script>
    <script>
          function checkForm() {
                submit_btn.style.display = 'none'; // 執行時按鈕先消失
                let fd = new FormData(document.form1);
                    // AJAX
                    fetch('login_api.php', {
                            method: 'POST',
                            body: fd,
                        })
                        .then(response => {
                            return response.json();
                        })
                        .then(json => {
                            console.log(json);
                            submit_btn.style.display = 'block'; // 接受到response後, 按鈕回來
                            // info_bar.style.display = 'block';
                            warn_text.innerHTML = json.info;

                            if (json.success) {
                                // info_bar.className = 'alert alert-success';
                                // wrap.classList.remove("flipInY");
								// wrap.classList.add("flipOutY");
								warn_text.style.display= "block";
                                setTimeout(function() {
                                    location.href = json.href; 
                                }, 1500);
                            } else {
                                // wrap.classList.remove("flipInY");
                                // wrap.classList.add("shakein");
                                
                                warn_text.style.display= "block";
                                // info_bar.className = 'alert alert-danger';
                            }
                        });
                return false; // 表單不出用傳統的 post 方式送出
            }
    </script>
</body>
</html>