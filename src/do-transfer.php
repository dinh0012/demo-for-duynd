<?php
include 'include.php';
$user = new User();
if ($user->transfer($_POST['destination'], $_POST['amount'], $_POST['content'])) {
    header("Status: 200");
} else {
    header("Status: 500 Error");
}
