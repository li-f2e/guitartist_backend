<?php
require '__admin_required.php';
require 'init.php';
?>
<?php require 'admin__header.php' ?>

<link rel="stylesheet" href="css/index.css">
<style>
    small.form-text {
        color: red;
    }
    
</style>
</head>

<body>
    <?php require "admin__nav_bar.php"; ?>
    <div class="wrapper d-flex">

        <?php require "admin__left_menu.php"; ?>

        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10 p-0 mt-5 ml-3 ">
                        <div class="container">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active " href="admin_backend_insert.php">新增使用者</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="admin_backend_list.php">後台使用者總表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="admin_company_list.php">代理商列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="admin_teacher_list.php">老師列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="admin_hall_list.php">場地廠商列表</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="admin_hire_list.php">徵才廠商列表</a>
                                </li>
                            </ul>
                            <div style="margin-top: 2rem;">
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col">
                                        <div>
                                            <div>
                                                <h5 class="card-title">新增資料</h5>
                                                <!-- notice here -->
                                                <form name="form1" onsubmit="return checkForm()">
                                                    <div class="form-group" id="identity">
                                                        <input type="checkbox" id="is_company" name="is_company" value="1">
                                                        <label for="is_company" form-check>吉他代理商</label>
                                                        <input type="checkbox" id="is_teacher" name="is_teacher" value="1">
                                                        <label for="is_teacher" form-check>課程老師</label>
                                                        <input type="checkbox" id="is_hall_owner" name="is_hall_owner" value="1">
                                                        <label for="is_hall_owner" form-check>場地租借</label>
                                                        <input type="checkbox" id="is_hire" name="is_hire" value="1">
                                                        <label for="is_hire" form-check>徵才廠商</label>
                                                    </div>
                                                    <!--  -->
                                                    <div class="d-flex card">
                                                        <div class="card-body">
                                                            <div class="form-group ">
                                                                <label for="email">電子信箱</label>
                                                                <input type="text" class="form-control" id="email" name="email">
                                                                <small id="emailHelp" class="form-text"></small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">密碼</label>
                                                                <input type="text" class="form-control" id="password" name="password">
                                                                <small id="passwordHelp" class="form-text"></small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--  -->
                                                    <div id="company_common_info" style="display:none" class="card">
                                                        <div class="card-body ">

                                                            <div class="d-flex row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="name">廠商名稱 / 樂團名稱</label>
                                                                        <input type="text" class="form-control" id="name" name="name">
                                                                        <small id="nameHelp" class="form-text"></small>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tax_id">統一編號</label>
                                                                        <input type="text" class="form-control" id="tax_id" name="tax_id">
                                                                        <small id="tax_idHelp" class="form-text"></small>
                                                                    </div>
                                                                    <!-- <div class="form-group">
                                                                                <label for="bank_acc">帳戶名稱</label>
                                                                                <input type="text" class="form-control" id="bank_acc" name="bank_acc">
                                                                                <small id="picHelp" class="form-text"></small>
                                                                            </div> -->
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="d-flex">
                                                                        <div class="form-group">
                                                                            <label for="">資本額</label>
                                                                            <input type="text" class="form-control" id="capital" name="capital">
                                                                            <small id="capitalHelp" class="form-text"></small>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">員工人數 / 團員人數</label>
                                                                            <input type="text" class="form-control" id="ppl_num" name="ppl_num">
                                                                            <small id="ppl_numHelp" class="form-text"></small>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <label for="tel">聯絡電話</label>
                                                                            <input type="text" class="form-control" id="tel" name="tel">
                                                                            <small id="telHelp" class="form-text"></small>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="form-group">
                                                                                    <label for="bank_num">帳戶號碼</label>
                                                                                    <input type="text" class="form-control" id="bank_num" name="bank_num">
                                                                                    <small id="picHelp" class="form-text"></small>
                                                                                </div> -->
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">

                                                                    <div class="form-group">
                                                                        <label for="addr">地址</label>
                                                                        <div class="d-flex">
                                                                            <input type="text" class="form-control" id="addr_district" name="addr_district" style="width:30%">
                                                                            <input type="text" class="form-control" id="addr" name="addr">
                                                                            <small id="addrHelp" class="form-text"></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="fax">傳真號碼</label>
                                                                        <input type="text" class="form-control" id="fax" name="fax">
                                                                        <small id="faxHelp" class="form-text"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="acc_info">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="bank_acc">帳戶名稱</label>
                                                                        <input type="text" class="form-control" id="bank_acc" name="bank_acc">
                                                                        <small id="picHelp" class="form-text"></small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">

                                                                    <div class="form-group">
                                                                        <label for="bank_num">帳戶號碼</label>
                                                                        <input type="text" class="form-control" id="bank_num" name="bank_num">
                                                                        <small id="picHelp" class="form-text"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>


                                            <!-- company -->
                                            <div class="card" style="display: none" id="is_company_card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="brand_1">代理品牌1</label>
                                                        <input type="text" class="form-control" id="brand_1" name="brand_1">
                                                        <small id="addrHelp" class="form-text"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addr">代理品牌2</label>
                                                        <input type="text" class="form-control" id="brand_2" name="brand_2">
                                                        <small id="brand_2Help" class="form-text"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addr">代理品牌3</label>
                                                        <input type="text" class="form-control" id="brand_3" name="brand_3">
                                                        <small id="brand_3Help" class="form-text"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- teacher -->
                                            <div class="card" style="display: none" id="is_teacher_card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="teacher_name">老師姓名</label>
                                                        <input type="text" class="form-control" id="teacher_name" name="teacher_name">
                                                        <small id="teacher_nameHelp" class="form-text"></small>
                                                    </div>
                                                    <div>
                                                        <label for="teacher_gender">性別</label>
                                                        <div class="d-flex" style="width: 250px">
                                                            <input type="radio" class="" id="teacher_gender" name="teacher_gender" value="M">男
                                                            <input type="radio" class="" id="teacher_gender" name="teacher_gender" value="F">女
                                                            <small id="teacher_genderHelp" class="form-text"></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="teacher_birthday">生日</label>
                                                        <input type="text" class="form-control" id="teacher_birthday" name="teacher_birthday">
                                                        <small id="teacher_birthdayHelp" class="form-text"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="teacher_tel">聯絡電話</label>
                                                        <input type="text" class="form-control" id="teacher_tel" name="teacher_tel">
                                                        <small id="teacher_telHelp" class="form-text"></small>
                                                    </div>

                                                </div>
                                            </div>
                                            <!--  hall -->
                                            <!-- <div class="card" style="display: none" id="is_hall_owner_card">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="hall_web">官方網站</label>
                                                                    <input type="text" class="form-control" id="hall_web" name="hall_web">
                                                                    <small id="hall_webHelp" class="form-text"></small>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="hall_introduction">場地介紹</label>
                                                                    <textarea class="form-control" id="hall_introduction" name="hall_introduction"></textarea>
                                                                    <small id="hall_introductionHelp" class="form-text"></small>
                                                                </div>
                                                            </div>
                                                        </div> -->

                                            <button type="submit" id="submit_btn" class="btn btn-primary">新增</button>
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
    <script>
        const submit_btn = document.querySelector('#submit_btn');
        let info_bar = document.querySelector('#info-bar');
        let i, s, item;

        let checkbox = document.querySelector('#identity');
        let is_company = checkbox.querySelector('#is_company');
        let is_teacher = checkbox.querySelector('#is_teacher');
        let is_hall_owner = checkbox.querySelector('#is_hall_owner');
        let is_hire = checkbox.querySelector('#is_hire');
        let is_company_card = document.querySelector('#is_company_card');
        let is_teacher_card = document.querySelector('#is_teacher_card');
        let acc_info = document.querySelector('#acc_info');
        // let is_hall_owner_card = document.querySelector('#is_hall_owner_card');
        let company_common_info = document.querySelector('#company_common_info');
        is_company.addEventListener('click', function(e) {
            if (is_company.checked) {
                is_company_card.style.display = 'block';
                company_common_info.style.display = 'block';
                acc_info.style.display = 'flex';
            } else if (!is_company.checked && is_hall_owner.checked) {
                is_company_card.style.display = 'none';
                company_common_info.style.display = 'block';
                acc_info.style.display = 'flex';
            } else if (!is_company.checked && is_hire.checked) {
                is_company_card.style.display = 'none';
                company_common_info.style.display = 'block';
                acc_info.style.display = 'none';
            } else {
                is_company_card.style.display = 'none'
                company_common_info.style.display = 'none';
            }
        });

        is_teacher.addEventListener('click', function(e) {
            if (is_teacher.checked) {
                is_teacher_card.style.display = 'block'
            } else {
                is_teacher_card.style.display = 'none'
            }
        });

        is_hall_owner.addEventListener('click', function(e) {
            if (is_hall_owner.checked) {
                // is_hall_owner_card.style.display = 'block'
                company_common_info.style.display = 'block';
                acc_info.style.display = 'flex';
            } else if (is_company.checked && !is_hall_owner.checked) {
                // is_company_card.style.display = 'none';
                company_common_info.style.display = 'block';
                acc_info.style.display = 'flex';
            } else if (is_hire.checked && !is_hall_owner.checked) {
                // is_hall_owner_card.style.display = 'none'
                company_common_info.style.display = 'block';
                acc_info.style.display = 'none';
            } else {
                company_common_info.style.display = 'none';
            }
        });

        is_hire.addEventListener('click', function(e) {
            if (is_company.checked && is_hire.checked) {
                acc_info.style.display = 'flex';
                is_company_card.style.display = 'block';
                company_common_info.style.display = 'block';
            } else if (is_company.checked && !is_hire.checked) {
                // is_company_card.style.display = 'none';
                company_common_info.style.display = 'block';
                acc_info.style.display = 'flex';
                // acc_info.style.display = 'none';
            } else if (is_hall_owner.checked && !is_hire.checked) {
                company_common_info.style.display = 'block';
                // acc_info.style.display = 'none';
                acc_info.style.display = 'flex';
            } else if (is_hire.checked && is_hall_owner.checked) {
                // is_hall_owner_card.style.display = 'block'
                company_common_info.style.display = 'block';
                acc_info.style.display = 'flex';
            } else if (is_hire.checked) {
                // is_hall_owner_card.style.display = 'block'
                company_common_info.style.display = 'block';
                acc_info.style.display = 'none';
            } else {
                // is_hall_owner_card.style.display = 'none'
                company_common_info.style.display = 'none';
            }
        })

        // 設定必填選項條件
        const required_fields = [
            // {
            //         id: 'name',
            //         pattern: /^\S{2,}/,
            //         info: '請填寫正確的姓名'
            //     },
            {
                id: 'email',
                pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                info: '請填寫正確的 email 格式'
            },
            {
                id: 'password',
                pattern: /./,
                info: '必填'
            },
            //     {
            //         id: 'tel',
            //         pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
            //         info: '請填寫正確的手機號碼格式'
            //     },
        ];
        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for (s in required_fields) {
            // for in 回傳 index, which means s = index;
            item = required_fields[s]; // each object in required_fields array
            item.el = document.querySelector('#' + item.id); // 每個object增加新的屬性el, 並設定為input element
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }

        function checkForm() {


            // 先讓所有欄位外觀回復到原本的狀態
            for (s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            }
            info_bar.style.display = 'none';
            info_bar.innerHTML = '';

            submit_btn.style.display = 'none';
            // 檢查必填欄位, 欄位值的格式
            let isPass = true; // 預設表單格式無誤
            for (s in required_fields) {
                item = required_fields[s];
                if (!item.pattern.test(item.el.value)) { // 測試輸入得值是否符合設定格式
                    item.el.style.border = '1px solid red'; // 如果不符合, input element border 改變
                    item.infoEl.innerHTML = item.info; // 如不符合, 顯示訊息的small element 呈現設定的內容
                    isPass = false; // 並將表單格式轉為有誤
                }
            };
            // AJAX
            let fd = new FormData(document.form1);
            if (isPass) {
                fetch('admin_backend_insert_api.php', {
                        method: 'POST',
                        body: fd
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                        submit_btn.style.display = 'block';
                        // info_bar.style.display = 'block';
                        // info_bar.innerHTML = json.info;

                        if (json.success) {
                            // info_bar.className = 'alert alert-success'; // 如果json.success = true, info bar 轉為綠色
                            Swal.fire({
                            type: 'success',
                            title: json.info,
                            showConfirmButton: false,
                            timer: 1500
                            })
                            setTimeout(function() {
                                location.href = 'admin_backend_list.php';
                            }, 1000);
                        } else {
                            // info_bar.className = 'alert alert-danger';
                            Swal.fire({
                            type: 'error',
                            title: json.info,
                            showConfirmButton: false,
                            timer: 1500
                            })
                        }
                    })
            } else {
                submit_btn.style.display = 'block';
            }
            return false; // 表單不出用傳統的 post 方式送出
        }
    </script>
    <?php require 'admin__footer.php' ?>