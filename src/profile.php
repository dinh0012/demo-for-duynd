<?php
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
    <style>
        form {
            max-width: 300px;
            margin: auto;
        }

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
        .content {
            margin: auto;
            width: 500px;

        }
    </style>
</head>
<body>
<?php include 'header.php'?>
<div class="container">
    <div class="content">
        <h1>Thông tin tài khoản</h1>
        <?php

        foreach ($infoData as $key => $label) {
            ?>
            <div class="row">
                <div class="col-4 item-label">
                    <?=$label?>
                </div>
                <div class="col-4 item-content">
                    <?=$currentUser[$key]?>
                </div>
            </div>
            <?php

        }
        ?>
        <div class="row">
            <div class="col-4 item-label">
                Số dư TK
            </div>
            <div class="col-4 item-content">
                <?=number_format( $currentUser['balance'])?> VND
            </div>
        </div>
        <div class="row mt-20">
            <div class="col-3">
                <a href="history.php">Xem lịch sử</a>
            </div>
            <div class="col-3">
                <a href="transfer.php">Chuyển tiền</a>
            </div>
            <div class="col-3">
                <a href="logout.php">Đăng xuất</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
