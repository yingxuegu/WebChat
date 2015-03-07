<?php
session_start();
//echo "a".$_SESSION['login'];
echo "sender_id  ".$_SESSION['sender_id'];
require_once 'SqlHelper.php';
$sqlHelper = new SqlHelper();
$sql = "select * from messages";
//echo $sqlHelper->excute_dml($sql);
?>