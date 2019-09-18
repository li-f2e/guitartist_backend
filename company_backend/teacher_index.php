<?php
require '__admin_required.php';
require 'init.php';
$page_name = 'Hall Index';
$sql = "SELECT * FROM member_list WHERE `email` = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();
// echo "<pre>", print_r($row), '</pre>'
?>

<?php require_once "__header.php";?>
<link rel="stylesheet" href="css/index.css">

<style>

.mainContent{
    background-color: rgb(226, 226, 226);
}

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

.card-show{
    border: none;
    border-radius: 8px;
    box-shadow: 3px 8px 8px #ccc;
}

.w20{
    width: 20%;
}

</style>

</head>
<body>
<?php require_once "teacher__nav_bar.php";?>


<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Welcome Back！</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?= $row['name'] ?>，今天新增了 5 筆訂單</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





    <div class="wrapper d-flex">

    <?php require_once "teacher__left_menu.php";?>

        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-start align-items-start">
                    
                    <div class="card card-show mt-5 ml-5" style="width: 25rem;">
                        <h4 class="card-title text-center py-3">Lorem, ipsum dolor.</h4>
                        <img src="fake-report/fake-report_02.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, nobis?</p>
                        </div>
                    </div>

                    <div class="card card-show mt-5 ml-5" style="width: 25rem">
                    <h4 class="card-title text-center py-3">Lorem, ipsum dolor.</h4>
                    <img src="fake-report/fake-report-06.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos deserunt, praesentium eveniet laudantium asperiores reiciendis voluptatum est quae unde voluptatibus.</p>
                    </div>
                    </div>

                    <div class="card card-show mt-5 ml-5" style="width: 18rem">
                    <h4 class="card-title text-center py-3">Lorem, ipsum dolor.</h4>
                    <img src="fake-report/fake-report-03.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, nobis?</p>
                    </div>
                    </div>

                    <div class="card card-show mt-5 ml-5" style="width: 25rem">
                    <h4 class="card-title text-center py-3">Lorem, ipsum dolor.</h4>
                    <img src="fake-report/fake-report-05.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, nobis?</p>
                    </div>
                    </div>

                        <!-- html馬打這裡 -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

$(window).on('load',function(){
    $('#myModal').modal('show');
});

</script>


<?php require_once "__footer.php";?>


