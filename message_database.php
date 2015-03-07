<?php
/**
 * Created by PhpStorm.
 * User: guxueying
 * Date: 04/03/15
 * Time: 17:40
 */

require_once 'SqlHelper.php';
class MessageService{
    function addMessage($sender_id,$receiver_id,$con){
        $sql="insert into messages (sender_id,receiver_id,content,sendTime) value ('$sender_id', '$receiver_id', '$con',now())";
        file_put_contents("out.txt",$sql."\r\n", FILE_APPEND);
        $sqlHelper = new SqlHelper();
        $sqlHelper->excute_dml($sql);
    }

    function getMessage($receiver_id, $sender_id){
         $sql ="select * from messages where sender_id = '$sender_id' and receiver_id = '$receiver_id' and is_readed =0";
         $sqlHelper = new SqlHelper();
         $arr = $sqlHelper->excute_dql2($sql);

        //XML get data
         $message = "<message>";
         for($i=0; $i<count($arr);$i++){
             $row=$arr[$i];
             $message.="<mesid>{$row['id']}</mesid><send_id>{$row['sender_id']}</send_id><receiver_id>{$row['receiver_id']}</receiver_id><content>{$row['content']}</content><sendTime>{$row['sendTime']}</sendTime>";
         }
        $message.="</message>";
        $sqlu = "update messages set is_readed = 1 where sender_id = '$sender_id' and receiver_id = '$receiver_id'";
        $sqlHelper->excute_dml($sqlu);
        $sqlHelper->close_connect();
        //file_put_contents("out.txt",$message."\r\n", FILE_APPEND);
        // update
        //return?



        return $message;

    }


}