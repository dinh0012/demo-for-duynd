<?php
include 'include.php';
$username = $_POST['username'];
$password = $_POST['password'];

$user = new User($username, $password);
if($user->login()) {
    header("Location: /index.php");
} else {
    header("Location: /login.php?error=true");
};
