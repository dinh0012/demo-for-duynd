<?php
$banks = ['bank_a' => 'Ngân Hàng A', 'bank_b' => 'Ngân hàng B'];
$user = new User();
$currentUser = $user->getCurrentUser();
?>
<style>
    header {
        padding: 10px;
        background: #333;
        color: #fff;
        position: sticky;
        top: 0;
    }
</style>
<header>
    <h1>
        <?=$banks[$currentUser['bank_id']]?>
    </h1>
</header>
