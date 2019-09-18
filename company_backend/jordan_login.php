<?php require 'init.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="01_fontawesome-free-5.9.0-web\css\all.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
    <div style="margin-top: 2rem;">
        <div class="row">
            <div class="col">
                <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">會員登入</h5>
                        <form name="form1" onsubmit="return checkForm()">
                            <div class="form-group">
                                <label for="email">帳號(電子郵箱)</label>
                                <input type="text" class="form-control" style="width:50%" id="email" name="email">
                                <small id="emailHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="password">密碼</label>
                                  <div class="d-flex">
                                    <input type="password" class="form-control pwdVisibility" style="width:50%" name="password">
                                    <a href="" id="eye"><i class="far fa-eye-slash"></a></i>
                                </div>
                                <small id="passwordHelp" class="form-text"></small>
                            </div>
                            <button type="submit" class="btn btn-primary" id='submit_btn'>登入</button>
                        </form>
                    </div>
                </div>

            </div>
            <script src="js/pwdHidden_login.js"></script>
            <script>

                let info_bar = document.querySelector('#info-bar');
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
                                info_bar.style.display = 'block';
                                info_bar.innerHTML = json.info;
                                if (json.success) {
                                    info_bar.className = 'alert alert-success';
                                    setTimeout(function() {
                                        location.href = json.href;
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
