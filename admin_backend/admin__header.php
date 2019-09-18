<!DOCTYPE html>
<html lang="en">

<head>
    <title>admin 後台</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="01_fontawesome-free-5.9.0-web/css/all.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/index.css"> -->

    <style>
        *{
            font-family: '微軟正黑體';
        }

        .form-group {
            position: relative;
            padding-top: 1.5rem;
            width: 90%;
            margin: auto;
            margin-top: 20px;
            /* border: 3px solid black; */
        }

        /* 表單輸入欄位裡 div偽裝的placeHolder */
        .placeHolder {
            position: absolute;
            top: 50%;
            left: 0;
            display: block;
            width: 100%;
            padding-left: 12px;
            color: #cfcfcf;
            transition: .5s;
            pointer-events: none;
        }

        .placeHolder.move {
            padding-left: 0;
            top: 0;
            color: #252121;
        }

        /* 表單輸入欄位 */
        .form-control {
            /* position: relative; */
            border: none;
            border-radius: 0;
            background: none;
            color: #252121;
            border-bottom: 1px solid #eae5de;
        }


        .form-control:focus {
            outline: none;
            box-shadow: none;
            border-color: #eae5de;
        }

        /* 表單輸入欄位的底線 */
        .line {
            position: absolute;
            display: block;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #252121;
            transition: .5s;
        }

        .line.long {
            width: 100%;
        }

        .was-validated .form-control:invalid:focus {
            border-color: #dc3545;
            box-shadow: none;
        }

        .invalid-feedback {
            position: absolute;
            text-align: end;
        }

        #resetBtn{
            float: right;
        }

        /* 註冊表單確定按鈕 */
        #signUpBtn{
        transition: .3s;
        background-color: var(--secondary);
        display: inline-block;
        float: right;
        }

        #signUpBtn:hover{
        background-color: var(--gold);
        }

        #signUpBtn:focus{
        outline: none;
        box-shadow: none;
        }

        #signUpBtn a{
            color: whitesmoke;
            text-decoration: none;
        }

        /* 圖片大小 */

        .pic{
            width:200px;
            height:150px;
        }
        /* edit 紅色外框 */
        small.form-text {
        color: red;
        }

        /* left menu icons */
        .fa-user-friends, .fa-hotel{
            font-size: 25px;
        }
        .fa-guitar,.fa-cog{
            font-size: 29px;
        }

        .fa-user-tie{
            font-size: 29px;
            padding-right: 5px;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css?family=Lobster|Noto+Sans+TC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Prata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="01_fontawesome-free-5.9.0-web\css\all.css">


    <link rel="stylesheet" type="text/css" href="css/flatpickr.dark.min.css">
    <!-- <link rel="stylesheet" href="css/admin_list.css"> -->
    <!-- 不確定這隻css還要不要 -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
