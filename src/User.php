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
        $destUser = $conn->prepare("select * from user where id='{$destination}'");
        $destUser->execute();
        $destUser =  $destUser->fetch(PDO::FETCH_ASSOC);
        $currentUser = $_SESSION['auth'];
        $currentUser = $conn->prepare("select * from user where id='{$currentUser['id']}'");
        $currentUser->execute();
        $currentUser =  $currentUser->fetch(PDO::FETCH_ASSOC);
        $date = date_create();
        $date = date_format($date,"d/m/Y H:i:s");

        $data = array(
            'iouValue' => $amount,
            'partyName' => 'BankName',
            'content' => $content,
            'accNum' => "{$destUser['account_number']}:{$currentUser['account_number']}"
        );
        $curl = curl_init();
        $options =array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://localhost:50005/api/example/create-iou/',
            CURLOPT_POST => true,
            CURLOPT_USERAGENT => "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)",
            CURLOPT_POSTFIELDS => $data
        );
        curl_setopt_array($curl, $options);
        $result = curl_exec($curl);
        if ($result === FALSE) {
            try {
                $conn->beginTransaction();

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
        } else {
            return  false;
        }

       // return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    public function transferByAccount($source, $destination, $amount, $content)
    {
        $db = new DB();
        $conn = $db->getConnection();

        $sourceUser = $conn->prepare("select * from user where account_number='{$source}'");
        $sourceUser->execute();
        $sourceUser =  $sourceUser->fetch(PDO::FETCH_ASSOC);
        $date = date_create();
        $date = date_format($date,"d/m/Y H:i:s");
        try {
            $conn->beginTransaction();
            $destUser = $conn->prepare("select * from user where account_number='{$destination}'");
            $destUser->execute();
            $destUser =  $destUser->fetch(PDO::FETCH_ASSOC);
            $sqlInsert = "INSERT INTO log (source, destination, amount, content, date)
  VALUES ('{$sourceUser['id']}', '{$destUser['id']}', '{$amount}', '{$content}', '{$date}')";
            $conn->exec($sqlInsert);
            $currentBalance = $sourceUser['balance'] - $amount;
            $desBalance = $destUser['balance'] + $amount;
            $sqlUpdate = "UPDATE user SET balance='{$currentBalance}'
 WHERE account_number='{$source}'";
            $sqlUpdateDestUser = "UPDATE user SET balance='{$desBalance}'
 WHERE account_number='{$destination}'";
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
