<?php
$banks = ['bank_a' => 'Ngân Hàng A', 'bank_b' => 'Ngân hàng B'];
?>
<style>
    header {
        padding: 10px;
        background: #fff;
        color: #fff;
        position: sticky;
        top: 0;
    }
    .bank-name, .bank-text {
        display: inline-block;
    }
    .bank-a {
        color: #e30613;
    }
    .header-bankA .bank-text {
        color: #ffffff;
    }
    .header-bankB .bank-text {
        color: #008446;
    }
    .header-bankC .bank-text {
        color: #063f2c;
    }
    .bank-b {
        color: #005790;
    }
    .bank-c {
        color: #ae1c3f;
    }
    header h1 {
        color: #008446;
        font-size: 24px;
        padding: 10px 20px;
    }
    .content {

    }
    .content-login {
        background: url('https://online.vpbank.com.vn/cb/web/grafx/portalSelection/backgroundVPBank.jpg');
        display: flex;
        align-items: center;
        height: 100%;

    }
    .bankA h1 {
        color: #e30613;
    }
    .bankA a {
        color: #e30613;
    }
    .bankA button {
        background-color: #e30613 !important;
    }
    .bankB h1 {
        color: #005790;
    }
    .bankB button {
        background-color: #005790 !important;;
    }
    .bankB a {
        color: #005790;
    }
    .bankC h1 {
        color: #ae1c3f;
    }
    .bankC button {
        background-color: #ae1c3f !important;;
    }
    .bankC a {
        color: #ae1c3f;
    }
    .bankA header {
        background: #1a4e3d;
    }
    .bankB header {
        background: #1aad5c;
    }
    .bankC header {
        background: #03b0e6;
    }
    form#form {
        max-width: 400px;
        margin: auto;
        padding: 30px;
        border-radius: 5px;
        border: solid 1px #bdbdbd;
        margin-top: 25px;
        margin-bottom: 25px;
    }
</style>

<?php
$bankName = [
    'bank-a.local' => '<div class="bank-a bank-name">A</div><div class="bank-text">Bank</div>',
    'bank-b.local' =>'<div class="bank-b bank-name">B</div><div class="bank-text">Bank</div>',
    'bank-c.local' => '<div class="bank-c bank-name">C</div><div class="bank-text">Bank</div>',
];
$bankClassName = [
    'bank-a.local' => 'bankA',
    'bank-b.local' => 'bankB',
    'bank-c.local' => 'bankC',
]
?>
<header class="header-<?=$bankClassName[$_SERVER['HTTP_HOST']];?>">
    <h1>
        <?=$bankName[$_SERVER['HTTP_HOST']];?>
    </h1>
</header>
