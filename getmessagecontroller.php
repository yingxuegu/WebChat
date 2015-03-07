<?php
/**
 * Created by PhpStorm.
 * User: guxueying
 * Date: 05/03/15
 * Time: 11:07
 */

header("content-type: text/xml; charset=utf-8");
header("Cache-Control: no-cache");

require_once 'message_database.php';
//$sender=$_POST['sender'];
//$getter=$_POST['getter'];

$receiver_id=$_POST['sender_id'];
$sender_id=$_POST['receiver_id'];

//file_put_contents('out.txt',$sender."+".$getter."\r\n", FILE_APPEND);

$messageService = new MessageService();
$message = $messageService->getMessage($receiver_id,$sender_id);

echo $message;

//file_put_contents('out.txt',$message."\r\n", FILE_APPEND);

?>