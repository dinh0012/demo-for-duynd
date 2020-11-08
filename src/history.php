<?php
include 'include.php';
$currentUser = $_SESSION['auth'];
$db = new DB();
$conn = $db->getConnection();
$history = $conn->prepare("select * from log where source='{$currentUser['id']}' or destination='{$currentUser['id']}' ORDER BY id DESC " );
$history->execute();
$history =  $history->fetchAll(PDO::FETCH_ASSOC);
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
        label {
            font-weight: 500;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<?php include 'header.php'?>
<body>
<div class="container">
    <div class="content">
        <div class="header">
            <h3>Lịch sử giao dịch</h3>
            <a href="/" class="back">Trở lại</a>
        </div>
        <table class="table mt-20">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ngày giao dịch</th>
                <th scope="col">Số tiền</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Hình thức</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($history as $item):?>
            <tr>
                <th scope="row"><?=$item['id']?></th>
                <td><?=$item['date']?></td>
                <td><?=number_format($item['amount'])?></td>
                <td><?=$item['content']?></td>
                <td><?=$item['source'] === $currentUser['id'] ? 'Chuyển tiền' : 'Nhận tiền'?></td>

            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
