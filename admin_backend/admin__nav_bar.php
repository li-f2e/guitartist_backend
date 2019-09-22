<?php
$sql_main = "SELECT * FROM `member_list` WHERE `email` = ?;";
$stmt_main = $pdo->prepare($sql_main);
$stmt_main->execute([$_SESSION['loginUser']['email']]);
$row_main = $stmt_main->fetch();
?>

<nav class="navbar navbar-expand-md navbar-light bg-light navBar">

<a  class="left-menu-toggle-btn d-flex flex-column justify-content-center align-items-center py-1" role="button">
    <div class="black-line up-line"></div>
    <div class="black-line"></div>
    <div class="black-line lower-line"></div>
</a>

<a href="#" class="navbar-brand d-flex justify-content-start align-items-center logo" href="#">
    <img src="images/logo-sample-01.png" alt="" style="width: 23%">
</a>

<!-- <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">

    </ul>

</div> -->



<form class="form-inline my-2 my-lg-0 mr-3 ml-auto">
    <!-- <button href id="logOut" type="button" class="btn my-2 my-sm-0" data-toggle="modal"
        data-target="#exampleModal"></button> -->
        <a href="#" id="profile">
            <div style="border: 1px solid lightgray; width:50px; height:50px; border-radius:50%; background-size:cover; background-position: center center; background-image: url(uploads/<?=empty($row_main['pic']) ? 'profile.png' : $row_main['pic']?>);" ></div>
        </a>
</form>
    <!-- <div
    class="card"
    id="logout"
    style="position: absolute; right: 20px; top: 82px;width: 300px; height:200px; z-index: 1000; display:none"
    >
    <div class="card-body">
        <div class="d-flex">

                <div
                    style="border: 1px solid lightgray; width:100px; height:100px; border-radius:50%; background-size:cover; background-image: url(uploads/<?=empty($row_main['pic']) ? 'profile.png' : $row_main['pic']?>);"
                ></div>
                <div style="width:160px; padding: 10px 15px">
                    <p class="card-text font-weight-bold"><?=$row_main['name']?></p>
                    <p class="card-text" style="color:#5f6368"><?=$row_main['email']?></p>
                </div>
        </div>
    </div>

    <div class="card-footer">
        <a class="btn btn-outline-secondary" style="display:inline-block; margin-left:200px" href="logout.php" role="button">登出</a>
    </div>
    </div> -->
<div class="card" id="logout" style="position: absolute; right: 20px; top: 82px;width: 300px; height:183px; z-index: 1000; display:none; box-shadow: 5px 5px 5px rgb(129, 129, 129)">
    <div class="d-flex" style="height:120px">
        <a href="#"><div style="margin: 10px 10px 10px 20px;border: 1px solid lightgray; width:100px; height:100px; border-radius:50%; background-size:cover; background-image: url(uploads/<?=empty($row_main['pic']) ? 'profile.png' : $row_main['pic']?>);"></div></a>
        <div style="flex:1; width:160px;margin:auto">
            <h6 class="card-text font-weight-bold"><?=$row_main['email']?></h6>
        </div>
    </div>
    <div class="card-footer">
        <a class="btn btn-outline-secondary" style="display:inline-block; margin-left:200px" href="logout.php" role="button">登出</a>
    </div>
</div>

</nav>
