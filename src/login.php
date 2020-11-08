<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DEMO</title>
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
        form  {
            max-width: 300px;
            margin: auto;
        }
        .container {

        }
    </style>
</head>
<body>
<div class="container">
    <form method="post" action="/do-login.php">
        <h3 class="text-center">Đăng nhập</h3>
        <div class="form-group">
            <label for="exampleInputEmail1">Tài khoản</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mật khẩu</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <?php
            if ($_GET['error']) {
                echo '<div class="alert alert-danger" role="alert">
                      Tài khoản hoặc mật khẩu không đúng.
                    </div>';
            }
        ?>
        <button type="submit" class="btn btn-primary">Đăng nhập</button>
    </form>
</div>

</body>
</html>
