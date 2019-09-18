<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GuitArist Sign In</title>
    <link rel="stylesheet" href="01_fontawesome-free-5.9.0-web\css\all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css">

</head>

<?php
require 'init.php';

?>

<style>

body{
    background-color: #ccc;
}

.wrap{
    width: 350px;
    height: 550px;
    border-radius: 15px;
    overflow: hidden;
    background-color: #ccc;
    margin: auto;
    /* background-image: url(https://images.unsplash.com/photo-1541689592655-f5f52825a3b8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1804&q=80); */
    background-image: url(https://images.unsplash.com/photo-1523325694921-78fb188df22f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=331&q=80);
    background-size: cover;
    opacity: 0.8;
    box-shadow:2px 8px 5px gray;
    margin-top: 5%;
    animation-duration:2s;
}


input{
    border: 0;
	outline: none;
	box-shadow: none;
	display: block;
	height: 40px;
	line-height: 30px;
	padding: 8px 15px;
	border-bottom: 1px solid #eee;
	width: 75%;
	font-size: 12px;
    margin: auto;
    margin-top: 10px;
    border-radius: 5px;
    color: #aaa;
}

.card_title{
    display: block;
    margin-top: 30%;
    margin-bottom: 5%;
    text-align: center;
    font-size: 40px;
    font-weight: bold;
    color: rgb(53, 52, 52);
}

.fa-eye-slash{
    color: rgb(53, 52, 52);
}

button{
    background-color: rgba(0,0,0,0.4);
	color: rgba(256,256,256,0.7);
	border:0;
	border-radius: 15px;
    display: block;
    margin: 15px auto 0px auto;
	padding: 8px 45px;
	width: 70%;
	font-size: 12px;
	font-weight: bold;
	cursor: pointer;
	opacity: 1;
}

button:hover{
    color: rgba(0,0,0,0.8);
}

.d-flex{
    display: flex;
    flex-direction: column;
}

#warn_text{
    display: none;
    color: #AA1F23;
    margin-left: 35%;
    margin-top: 5px;
    font-weight: bold;
}

.shakein{
    animation-name: shakein;
    animation-duration:0.6s;
}

@keyframes shakein {
  from,to {
    transform: translate3d(0, 0, 0);
  }

  10%, 30%, 50%, 70%, 90% {
    transform: translate3d(-10px, 0, 0);
  }

  20%, 40%, 60%, 80% {
    transform: translate3d(10px, 0, 0);
  }
}




</style>

<body>
    <div class="wrap animated flipInY" id="wrap">
    <div class="card_title">Sign In</div>
            <form name="form1" onsubmit="return checkForm()">
                <!-- <div class="form-group">
                    <label for="email"></label>
                </div> -->
                <div>
                    <input type="text" id="email" name="email" placeholder="EMAIL">
                    <div class="d-flex">
                        <label for="password"></label>
                        <input type="password" class="pwdVisibility" id="password" name="password" placeholder="PASSWORD">
                        <a href="" id="eye" style="position:absolute; top:250px; right:52px"><i class="far fa-eye-slash"></a></i>
                        <small id="info_bar" style="text-align: center; margin:10px"></small>
                    </div>
                </div>
                <button type="submit" id='submit_btn'>Log in</button>
            </form>
    </div>
    <script src="js/pwdHidden_login.js"></script>
    <script>
            let wrap = document.getElementById('wrap');
            let info_bar = document.querySelector('#info_bar');
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
                                // info_bar.className = 'alert alert-success';
                                wrap.classList.remove("flipInY");
                                wrap.classList.add("flipOutY");
                                setTimeout(function() {
                                    location.href = json.href;
                                }, 1500);
                            } else {
                                wrap.classList.remove("flipInY");
                                wrap.classList.add("shakein");
                                warn_text.style.display= "block";
                                // info_bar.className = 'alert alert-danger';
                            }
                        });
                return false; // 表單不出用傳統的 post 方式送出
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>