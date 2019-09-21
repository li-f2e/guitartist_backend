<?php
require '__admin_required.php';
require 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <style>
      .all {
        height: 100vh;
        background: linear-gradient(
          30deg,
          rgb(241, 205, 205),
          rgb(253, 252, 252)
        );
      }
      img {
        width: 100px;
        margin: auto;
      }
      .container {
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .box {
        width: 1000px;
        height: 500px;
        background: rgb(253, 253, 253);
        margin: auto;
        margin-top: 150px;
        box-shadow: 1px 1px 40px rgba(0, 0, 0, 0.3);
      }
      h2 {
        text-align: center;
        color: rgb(61, 58, 58);
        height: 150px;
        line-height: 150px;
      }
      .cardbox {
        display: flex;
        justify-content: space-evenly;
        align-items: flex-start;
      }
      .card {
        width: 220px;
        height: 250px;
        box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        border: 4px solid transparent;
      }
      .circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #e43f3f;
        position: relative;
        margin: auto;
      }
      img {
        position: absolute;
        right: 55px;
        top: 46px;
      }
      .card p {
        font-size: 25px;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="all">
      <div class="container">
        <div class="box">
          <h2>選擇您的身份</h2>
          <!-- <h5>guitartist歡迎您</h5> -->
          <div class="cardbox">
            <div class="card animated"  style="display: <?= $_SESSION['loginUser']['is_company'] == 1 ? 'block' : 'none' ?>">
                <div class="circle"></div>
                <img src="images/guitar.svg" alt="" />
                <p>廠商</p>
            </div>
            <div class="card" style="display: <?= $_SESSION['loginUser']['is_teacher'] == 1 ? 'block' : 'none' ?>">
              <div class="circle"></div>
              <img src="images/book.svg" alt="" />
              <p>老師</p>
            </div>
            <div class="card" style="display: <?= $_SESSION['loginUser']['is_hall_owner'] == 1 ? 'block' : 'none' ?>">
              <div class="circle"></div>
              <img src="images/address.svg" alt="" />
              <p>場地</p>
            </div>
            <div class="card" style="display: <?= $_SESSION['loginUser']['is_hire'] == 1 ? 'block' : 'none' ?>">
              <div class="circle"></div>
              <img src="images/user.svg" alt="" />
              <p>徵才</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <script>
      $(".card").click(function() {
        $(this)
          .css("border", "4px solid #c62828")
          .siblings()
          .css("border", "4px solid transparent");
        $(this)
          .addClass("animated infinite bounce ")
          .siblings()
          .removeClass("animated infinite bounce ");
      });
    </script>
  </body>
</html>
