<?php
include 'include.php';
$user = new User();
$findUser = $user->getUserByBankIdAccount($_POST['bank_id'], $_POST['account_number']);

if ($findUser) {
    header('Content-type: application/json');
    echo json_encode( $findUser );
} else {
    header("Status: 404 Not Found");
}
