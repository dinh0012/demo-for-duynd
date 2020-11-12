<?php
include 'include.php';
$user = new User();
$currentUser = $user->getCurrentUser();
$infoData = [
    'full_name' => 'Họ tên',
    'account_number' => 'Số tài khoản',
    'email' => 'Email',
    'phone' => 'Số điện thoại',
];
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DEMO</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>


        .col-4.item-label {
            max-width: 105px;
            font-weight: 500;
            padding: 0;
            position: relative;
        }
        .item-content {
            padding-left: 5px;
        }

        .col-4.item-label:after {content: ":";position: absolute;right: 0;}
        .row {
            margin: 0;
        }
        .mt-20 {
            margin-top: 20px;
        }

        label {
            font-weight: 500;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
    <script>
        $(document).ready( function () {
            $('#selectBank').on('change', function () {
                const value = this.value;
                $('.other').hide()
                if (value) {
                    $('.account-number').show()
                    $('.account-number input').val('')

                } else {
                    $('.account-number').show()
                }

            })

            $('#accountNumber').on('blur', function () {
                const value = this.value;
                $.ajax({
                    type: "POST",
                    url: 'get-account-by-number.php',
                    data : {
                        bank_id : $('#selectBank').val(),
                        account_number :value,
                    },
                    success : function (result){
                        $('.person-des').html(result.full_name);
                        $('.other').show();
                        $('#userID').val(result.id);
                    },
                    error: () => {
                        alert('Tài khoản nhận không đúng!')
                    },
                    dataType: 'json'
                });

            })
            $('#amount').on('change', function () {
                const value = this.value
                if (+value > +<?=$currentUser['balance']?>) {
                    alert("Số tiền chuyển phải nhỏ hơn hoặc bằng số dư hiện tại.")
                    return
                }
                if (value) {
                    $('#send').prop('disabled', false)
                }
            })

            $('#form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'do-transfer.php',
                    data : {
                        source : <?=$currentUser['id']?>,
                        destination :$('#userID').val(),
                        amount :$('#amount').val(),
                        content :$('#content').val(),
                    },
                    success : function (result) {
                        alert('Đã chuyển tiền thành công')
                        window.location = '/'
                    },
                    error: () => {
                        alert('Lỗi!')
                    },
                });
            })
        })


    </script>
</head>
<?php include 'header.php'?>
<body class="<?=$bankClassName[$_SERVER['HTTP_HOST']];?>">
<div class="content">
<div class="container">
    <form method="post" id="form">
        <div class="header">
            <h3>Chuyển tiền</h3>
            <a href="/" class="back">Trở lại</a>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Chuyển từ</label>
            <div><?=$currentUser['full_name']?></div>
            <div><?=$currentUser['account_number']?></div>
            <div><?=number_format($currentUser['balance'])?> VND</div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Chuyển đến</label>
            <select class="form-control" id="selectBank">
                <option value="">Chọn ngân hàng</option>
                <option value="bank_a">Bank A</option>
                <option value="bank_b">Bank B</option>
                <option value="bank_c">Bank C</option>
            </select>
        </div>
        <div class="form-group account-number " style="display: none" >
            <label for="exampleInputPassword1">Số tài khoản</label>
            <input class="form-control" id="accountNumber"  type="text" name="account_number">
        </div>
        <div class="form-group other" style="display: none">
            <label for="exampleInputPassword1">Người thụ hưởng</label>
            <div class="person-des"></div>
        </div>
        <div class="form-group other" style="display: none">
            <label for="exampleInputPassword1">Số tiền</label>
            <input class="form-control" id="amount" type="number" name="username">
        </div>
        <div class="form-group other" style="display: none">
            <label for="exampleInputPassword1">Nội dung</label>
            <textarea class="form-control" id="content" type="text" name="username"></textarea>
        </div>
        <?php
        if ($_GET['error']) {
            echo '<div class="alert alert-danger" role="alert">
                      Tài khoản hoặc mật khẩu không đúng.
                    </div>';
        }
        ?>
        <input class="form-control" id="userID"  type="text" name="user_id" hidden>
        <button type="submit" class="btn btn-primary" id="send" disabled>Thực hiện</button>
    </form>

</div>
</div>

</body>
</html>
