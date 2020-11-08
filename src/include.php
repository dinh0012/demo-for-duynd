<?php
session_start();

include 'helpers/Db.php';
include 'User.php';
include 'App.php';
$user = new User();
if (!$user->isLogin()) {
    header("Location: /login.php");
    return;
}
