<?php

class User
{
    private $username;
    private $password;

    public function __construct($username = '', $password = '')
    {
        if ($username && $password) {
            $this->username = $username;
            $this->password = md5($password);
        }

    }

    public function login()
    {
        $db = new DB();
        $stmt = $db->getConnection()->prepare("select * from user where username='{$this->username}' and password='{$this->password}' limit 1");
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $_SESSION["auth"] = $user;
            return true;
        }
        return false;
    }

    public function isLogin()
    {
        return $_SESSION['auth'];
    }

    public function getCurrentUser()
    {
        $user = $_SESSION['auth'];
        $db = new DB();
        $stmt = $db->getConnection()->prepare("select * from user where id='{$user['id']}' limit 1");
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function getUserByBankIdAccount($bankId, $accountNumber)
    {
        $db = new DB();
        $stmt = $db->getConnection()->prepare("select * from user where bank_id='{$bankId}' and account_number='{$accountNumber}' limit 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function transfer($destination, $amount, $content)
    {

        $db = new DB();
        $conn = $db->getConnection();
        $currentUser = $_SESSION['auth'];
        $currentUser = $conn->prepare("select * from user where id='{$currentUser['id']}'");
        $currentUser->execute();
        $currentUser =  $currentUser->fetch(PDO::FETCH_ASSOC);
        $date = date_create();
        $date = date_format($date,"d/m/Y H:i:s");
        try {
            $conn->beginTransaction();
            $destUser = $conn->prepare("select * from user where id='{$destination}'");
            $destUser->execute();
            $destUser =  $destUser->fetch(PDO::FETCH_ASSOC);
            $sqlInsert = "INSERT INTO log (source, destination, amount, content, date)
  VALUES ('{$currentUser['id']}', '{$destination}', '{$amount}', '{$content}', '{$date}')";
            $conn->exec($sqlInsert);
            $currentBalance = $currentUser['balance'] - $amount;
            $desBalance = $destUser['balance'] + $amount;
            $sqlUpdate = "UPDATE user SET balance='{$currentBalance}'
 WHERE id='{$currentUser['id']}'";
            $sqlUpdateDestUser = "UPDATE user SET balance='{$desBalance}'
 WHERE id='{$destination}'";
            $stmt = $conn->prepare($sqlUpdate);
            $stmt->execute();

            $stmt = $conn->prepare($sqlUpdateDestUser);
            $stmt->execute();
            $conn->commit();
            return true;
        } catch (Exception $e) {
            //An exception has occured, which means that one of our database queries
            //failed.
            //Print out the error message.
            echo $e->getMessage();
            //Rollback the transaction.
            $conn->rollBack();
            return false;
        }
       // return $stmt->fetch(PDO::FETCH_ASSOC);

    }
}
