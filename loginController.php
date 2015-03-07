<?php
/**
 * Created by PhpStorm.
 * User: guxueying
 * Date: 03/03/15
 * Time: 14:44
 */
    require_once 'SqlHelper.php';
    $sqlHelper = new SqlHelper();


    $loginUser=$_POST['username'];
    $pwd=$_POST['password'];
    $sql = "select * from user where user_name = '$loginUser' and password = $pwd ";
    $number = $sqlHelper->excute_dml($sql);
    $arr = $sqlHelper->excute_dql2($sql);
    $sqlHelper->close_connect();
    $user_id = $arr[0]['user_id'];
    file_put_contents('out.txt',"user_id: ".$user_id."\r\n", FILE_APPEND);





    if($number == 1){
        session_start();
        $_SESSION['login'] = $loginUser;
        $_SESSION['sender_id'] = $user_id;
        header("Location: friendlist.php");
    }else{
        header("Location: login.php");
    }
?>