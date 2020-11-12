<?php
$iouValue = $_POST['iouValue'];
$partyName = $_POST['partyName'];
$accNum = $_POST['accNum'];

$content = $_POST['content'];
$accNumSplit = explode(';',$accNum);
$source = $accNumSplit[0];
$destination = $accNumSplit[1];
include 'helpers/Db.php';
include 'User.php';
$user = new User();
if ($user->transferByAccount($source, $destination, $iouValue, $content)) {
    header("Status: 200");
} else {
    header("Status: 500 Error");
}
