<?php
/**
 * Created by PhpStorm.
 * User: guxueying
 * Date: 04/03/15
 * Time: 17:27
 */
require_once 'message_database.php';
//$sender=$_POST['sender'];
//$getter=$_POST['getter'];
$sender_id=$_POST['sender_id'];
$receiver_id=$_POST['receiver_id'];

$con=$_POST['con'];

file_put_contents("out.txt",$sender_id."-".$receiver_id."-".$con."\r\n", FILE_APPEND);

$messageService = new MessageService();
$messageService->addMessage($sender_id,$receiver_id,$con);

//file_put_contents("out.txt",$x."\r\n", FILE_APPEND);

?>
